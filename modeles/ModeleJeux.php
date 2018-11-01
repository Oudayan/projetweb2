<?php

/**
 * @file     ModeleJeux.php
 * @author   
 * @version  1.0
 * @date     
 * @brief    Modèle Jeux
 *
 * @details  Fonctions "CRUD" pour la table  
 */
    class ModeleJeux extends BaseDAO {

        public function lireNomTable() {
            return "`jeux`";
        }

        public function lireJeuParId($id) {
            $resultat = $this->lire($id);
            $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Jeux');
            return $resultat->fetch();
        }

        public function lireJeuxParMembre($membre_id) {
            $sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE membre_id = '" . $membre_id . "' ORDER BY date_ajout DESC";
            $resultat = $this->requete($sql);
            return $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Jeux");
        }

        public function lireNbJeuxParMembre($membre_id) {
            $sql = "SELECT COUNT(jeux_id) AS nb_jeux FROM " . $this->lireNomTable() . " WHERE membre_id = '" . $membre_id . "' ORDER BY date_ajout DESC";
            $resultat = $this->requete($sql);
            return $resultat->fetch();
        }

        public function lireDerniersJeux($nombreJeux = 9) {
            $sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE vendu = 0 AND jeux_actif = 1 AND jeux_valide = 1 AND jeux_banni = 0 ORDER BY jeux_id DESC LIMIT " . $nombreJeux;
            $resultat = $this->requete($sql);
            return $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Jeux");
        }

        public function lireTousLesJeux($ordre = 1, $champ = NULL, $limit = "0, 9999999999999999") {
            if (isset($champ)) {
                $resultat = $this->lireTous($this->lireClePrimaire() . " > 0", ($ordre == 1 ? "ASC" : "DESC"), $champ, $limit);
            }
            else {
                $resultat = $this->lireTous($this->lireClePrimaire() . " > 0", ($ordre == 1 ? "ASC" : "DESC"), $this->lireClePrimaire(), $limit);
            }
            return $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Jeux");
        }

        public function filtreJeux($filtre = 'vendu = 0 AND jeux_actif = 1 AND jeux_valide = 1 AND jeux_banni = 0', $ordre = 'DESC', $champ = "prix ", $limit = "0, 9999999999999999") {
            $sql = "SELECT DISTINCT j.jeux_id, j.plateforme_id,j.membre_id, j.titre, j.prix, j.date_ajout, j.concepteur, j.location, j.vendu, j.jeux_valide, j.jeux_actif, j.description, j.evaluation_globale" . " FROM " . $this->lireNomTable() . " j LEFT JOIN categorie_jeux cj ON j.jeux_id = cj.jeux_id LEFT JOIN categorie c ON c.categorie_id = cj.categorie_id LEFT JOIN location l ON l.jeux_id = j.jeux_id WHERE " . $filtre . " ORDER BY " . $champ . " " . $ordre . " LIMIT " . $limit;
            $resultat = $this->requete($sql);
            return $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Jeux");
        }

        public function obtenirNbJeux($filtre = "jeux_id > 0") {
            $sql = "SELECT COUNT(jeux_id) AS nb_jeux FROM " . $this->lireNomTable() . " WHERE " . $filtre;
            $resultat = $this->requete($sql);
            return $resultat->fetch();
        }

        public function sauvegarderJeux(Jeux $jeu) {
            $donnees = array(
                $jeu->getPlateformeId(),
                $jeu->getMembreId(),
                $jeu->getTitre(),
                $jeu->getPrix(),
                $jeu->getDateAjout(),
                $jeu->getConcepteur(),
                $jeu->getDescription(),
                $jeu->getEvaluationGlobale(),
                $jeu->getLocation(),
                $jeu->getVendu(),
                $jeu->getJeuxValide(),
                $jeu->getJeuxActif(),
                $jeu->getJeuxBanni(),
                $jeu->getJeuxId()
            );
            if ($jeu->getJeuxId() && $this->lire($jeu->getJeuxId())->fetch()) {
                $sql = "UPDATE " . $this->lireNomTable() . " SET plateforme_id=?, membre_id=?, titre=?, prix=?, date_ajout=?, concepteur=?, description=?, evaluation_globale=?, location=?, vendu=?, jeux_valide=?, jeux_actif=?, jeux_banni=? WHERE jeux_id=?";
            } else {
                $id = array_pop($donnees);
                $sql = "INSERT INTO " . $this->lireNomTable() . "(plateforme_id, membre_id, titre, prix, date_ajout, concepteur, description, evaluation_globale, location, vendu, jeux_valide, jeux_actif, jeux_banni) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            }
            $this->requete($sql, $donnees);
            return $jeu->getJeuxId() > 0 ? $jeu->getJeuxId() : $this->bd->lastInsertId();
        }

        public function effacerJeu($id) {
            return $this->effacer($id);
        }

        public function annulerVente($id) {
            return $this->modifierChamp($id, "vendu", 0);
        }

        public function activerVente($id) {
            return $this->modifierChamp($id, "vendu", 1);
        }

        public function validerJeu($id) {
            return $this->modifierChamp($id, "jeux_valide", 1);
        }

        public function desactiverJeu($id) {
            return $this->modifierChamp($id, "jeux_actif", 0);
        }

        public function activerJeu($id) {
            return $this->modifierChamp($id, "jeux_actif", 1);
        }

        public function bannirJeu($id) {
            return $this->modifierChamp($id, "jeux_banni", 1);
        }

        public function debannirJeu($id) {
            return $this->modifierChamp($id, "jeux_banni", 0);
        }

        public function updateEvaluationJeu($id, $eval) {
            return $this->modifierChamp($id, "evaluation_globale", $eval);
        }

    }

?>