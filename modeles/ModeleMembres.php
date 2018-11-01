<?php
/**
 * @file      ModeleMembres.php
 * @author    Marcelo Guzmán, Chunliang
 * @date      Septembre 2018
 * @brief     Définit la classe ModeleMembres
 *
 * @details   Cette classe définit les attributs qu'on a besion pour tout ce qui corcerne aux membres inscrits sur le site
 */

    class ModeleMembres extends BaseDAO {
        /**
         * @brief   Méthode pour aller chercher le nom d'une table
         * @details Cette méthode va chercher le nom de d'une table dans la BD
         * @return  [string]
         */

        public function lireNomTable() {
            return "`membre`";
        }

        /**
         * @brief   Méthode pour aller chercher un membre
         * @details Méthode que permets aller chercher l'information de un membre en utilisant son id
         * @param   [numeric] $membre_id
         * @return  [array]
         */
        public function obtenirParId($membre_id) {
            $resultat = $this->lire($membre_id);
            $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Membres');
            return $resultat->fetch();
        }


        /**
         * @brief   Méthode pour aller chercher un membre
         * @details Méthode que permets aller chercher l'information de un membre en utilisant son courriel
         * @param   [string] $courriel
         * @return  [array]
         */
        public function obtenirParCourriel($courriel) {
            $resultat = $this->lire($courriel,'courriel');
            $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Membres');
            return $resultat->fetch();
        }

        /**
         * @brief   Méthode pour obtenir tous les memebres dans la BD
         * @details Méthode qui obtiens tous les informations enregistrées dans la BD de tous les membres
         * @return  [array]
         */
        public function obtenirTous($ordre = 1, $champ = NULL, $limit = "0, 9999999999999999") {
            if (isset($champ)) {
                $resultat = $this->lireTous($this->lireClePrimaire() . " > 0", ($ordre == 1 ? "ASC" : "DESC"), $champ, $limit);
            }
            else {
                $resultat = $this->lireTous($this->lireClePrimaire() . " > 0", ($ordre == 1 ? "ASC" : "DESC"), $this->lireClePrimaire(), $limit);
            }
            return $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Membres");
        }

        public function obtenirNbMembres($filtre = "membre_id > 0") {
            $sql = "SELECT COUNT(membre_id) AS nb_membres FROM " . $this->lireNomTable() . " WHERE " . $filtre;
            $resultat = $this->requete($sql);
            return $resultat->fetch();
        }

        /**
         * @brief   Méthode pour enregistrer un nouveau membre dans la bd
         * @details Recueillir les informations insérées et les enregistrer dans la BD
         * @param   [numeric] $membre_id
         * @param   [numeric] $type_utilisateur_id
         * @param   [string] $nom
         * @param   [string] $prenom
         * @param   [string] $mot_de_passe
         * @param   [string] $adresse
         * @param   [string] $telephone
         * @param   [string] $courriel
         * @param   [string] $date_ajout
         * @param   [numeric] $evaluation_globale
         * @param   [boolean] $alerte_email
         * @param   [boolean] $newsletter
         * @param   [boolean] $membre_valide
         * @param   [boolean] $membre_actif
         * @return  [numeric] Dernier membre_id inséré
         */
        public function sauvegarde(Membres $membre) {
            $donnees = array(
                $membre->getTypeUtilisateur(),
                $membre->getNom(),
                $membre->getPrenom(),
                $membre->getMotDePasse(),
                $membre->getAdresse(),
                $membre->getTelephone(), 
                $membre->getCourriel(),
                $membre->getDateAjout(),
                $membre->getEvaluationGlobale(),
                $membre->getAlerteEmail(),
                $membre->getNewsletter(),
                $membre->getMembreValide(),
                $membre->getMembreActif(),
                $membre->getMembreId()
            );
            if ($membre->getMembreId() && $this->lire($membre->getMembreId())->fetch()) {
                if ($membre->getMotDePasse() == "45b548e2ca3315e39abfa852a4d814ef") {
                    array_splice($donnees, 3, 1);
                    $sql = "UPDATE " . $this->lireNomTable() . " SET type_utilisateur_id=?, nom=?, prenom=?, adresse=?, telephone=?, courriel=?, date_ajout=?, evaluation_globale=?, alerte_email=?, newsletter=?, membre_valide=?, membre_actif=? WHERE membre_id=?";
                }
                else {
                    $sql = "UPDATE " . $this->lireNomTable() . " SET type_utilisateur_id=?, nom=?, prenom=?, mot_de_passe=?, adresse=?, telephone=?, courriel=?, date_ajout=?, evaluation_globale=?, alerte_email=?, newsletter=?, membre_valide=?, membre_actif=? WHERE membre_id=?";
                }
            } else {
                $id = array_pop($donnees);
                $sql = "INSERT INTO " . $this->lireNomTable() . " (type_utilisateur_id, nom, prenom, mot_de_passe, adresse, telephone, courriel, date_ajout, evaluation_globale, alerte_email, newsletter, membre_valide, membre_actif) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            }
            $this->requete($sql, $donnees);
            return $membre->getMembreId() > 0 ? $membre->getMembreId() : $this->bd->lastInsertId();
        }

        /**
         * @brief   Méthode pour valider un membre inscrit dans la bd
         * @details Méthode modifie la valeur par défaut dans la bd de chaque nouveau membre
         * @param   [string] $courriel
         * @return  [array]
         */
        public function validerMembre($id) {
            return $this->modifierChamp($id, 'membre_valide', 1);
        }

        /**
         * @brief   Méthode pour valider un membre inscrit dans la bd
         * @details Méthode modifie la valeur par défaut dans la bd de chaque nouveau membre
         * @param   [string] $courriel
         * @return  [array]
         */
        public function bannirMembre($id) {
            return $this->modifierChamp($id, 'membre_actif', 0);
        }

        /**
         * @brief   Méthode pour valider un membre inscrit dans la bd
         * @details Méthode modifie la valeur par défaut dans la bd de chaque nouveau membre
         * @param   [string] $courriel
         * @return  [array]
         */
        public function reactiverMembre($id) {
            return $this->modifierChamp($id, 'membre_actif', 1);
        }


        /**
         * @brief   Méthode pour valider un membre inscrit dans la bd
         * @details Méthode modifie la valeur par défaut dans la bd de chaque nouveau membre
         * @param   [string] $courriel
         * @return  [array]
         */
        public function promouvoirMembre($id) {
            return $this->modifierChamp($id, 'type_utilisateur_id', 2);
        }

        /**
         * @brief   Méthode pour valider un membre inscrit dans la bd
         * @details Méthode modifie la valeur par défaut dans la bd de chaque nouveau membre
         * @param   [string] $courriel
         * @return  [array]
         */
        public function retrograderMembre($id) {
            return $this->modifierChamp($id, 'type_utilisateur_id', 1);
        }

        /**
         * @brief   Méthode pour obtenir le rôle de utilisateur
         * @details Méthode qui obtiens un nom pour tous les type de l'utilisateur
         * @return  [string/boolean]
         */
        public function obtenirRole($role) {
            switch ($role) {
                case '1':
                    return 'Membre';
                case '2':
                    return 'Administrateur';
                case '3':
                    return 'Super administrateur';
                default:
                    return false;
            }
        }

        public function updateEvaluationMembre($id, $eval) {
            return $this->modifierChamp($id, "evaluation_globale", $eval);
        }

    }

?>