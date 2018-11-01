<?php
/**
 * @file     ModeleEvaluation.php
 * @author   Oudayan Dutta
 * @version  1.0
 * @date     Octobre 2018
 * @brief    Modèle Evaluation
 * @details  Fonctions "CRUD" pour la table evaluation
 */

	class ModeleEvaluation extends BaseDAO {

        // Déclaration du nom de la table (fonction abstraite)
		public function lireNomTable() {
			return "`evaluation`";
        }

        public function lireEvaluationParId($id) {
            $resultat = $this->lire($id);
            $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Evaluation');
            return $resultat->fetch();
        }

        public function lireEvaluationParJeton($jeton) {
            $resultat = $this->lire($jeton, "jeton");
            $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Evaluation');
            return $resultat->fetch();
        }

        public function lireToutesEvaluationsParJeu($ordre = 1, $champ = NULL, $limit = "0, 9999999999999999") {
            if (isset($champ)) {
                $resultat = $this->lireTous($this->lireClePrimaire() . " > 0", ($ordre == 1 ? "ASC" : "DESC"), $champ, $limit);
            }
            else {
                $resultat = $this->lireTous($this->lireClePrimaire() . " > 0", ($ordre == 1 ? "ASC" : "DESC"), $this->lireClePrimaire(), $limit);
            }
            return $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Evaluation");
        }

        public function lireEvaluationsParJeu($jeu_id) {
            $sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE jeux_id = '" . $jeu_id . "' AND evaluation_jeu_active = 1 ORDER BY date_evaluation DESC";
            $resultat = $this->requete($sql);
            return $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Evaluation");
        }

        public function lireNbEvaluationsParJeu($jeu_id) {
            $sql = "SELECT COUNT(evaluation_id) AS nb_evaluations FROM " . $this->lireNomTable() . " WHERE jeux_id = '" . $jeu_id . "' AND evaluation_jeu_active = 1 ORDER BY date_evaluation DESC";
            $resultat = $this->requete($sql);
            return $resultat->fetch();
        }

        public function lireEvaluationsParMembre($membre_id) {
            $sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE membre_id = '" . $membre_id . "' AND evaluation_membre_active = 1 ORDER BY date_evaluation DESC";
            $resultat = $this->requete($sql);
            return $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Evaluation");
        }

        public function lireNbEvaluationsParMembre($membre_id) {
            $sql = "SELECT COUNT(evaluation_id) AS nb_evaluations_membres FROM " . $this->lireNomTable() . " WHERE membre_id = '" . $membre_id . "' AND evaluation_membre_active = 1 ORDER BY date_evaluation DESC";
            $resultat = $this->requete($sql);
            return $resultat->fetch();
        }

        public function sauvegarde(Evaluation $evaluation) {
            if ($evaluation->getEvaluationId() && $this->lire($evaluation->getEvaluationId())->fetch()) {
                $donnees = array(
                    $evaluation->getCommentaireJeu(),
                    $evaluation->getCommentaireMembre(),
                    $evaluation->getEvaluationJeu(), 
                    $evaluation->getEvaluationMembre(), 
                    $evaluation->getDateEvaluation(),
                    $evaluation->getEvaluationId(),
                );
                $sql = "UPDATE " . $this->lireNomTable() . " SET commentaire_jeu=?, commentaire_membre=?, evaluation_jeu=?, evaluation_membre=?, date_evaluation=? WHERE evaluation_id=?"; 
            } else {
                $donnees = array(
                    $evaluation->getJeton(),
                    $evaluation->getJeuxId(),
                    $evaluation->getMembreId(),
                    $evaluation->getAchatId(),
                    $evaluation->getLocationId(),
                    $evaluation->getCommentaireJeu(),
                    $evaluation->getCommentaireMembre(),
                    $evaluation->getEvaluationJeu(), 
                    $evaluation->getEvaluationMembre(), 
                    $evaluation->getDateEvaluation(),
                    $evaluation->getEvaluationJeuActive(),
                    $evaluation->getEvaluationMembreActive(),
                );
                $sql = "INSERT INTO " . $this->lireNomTable() . " (jeton, jeux_id, membre_id, achat_id, location_id, commentaire_jeu, commentaire_membre, evaluation_jeu, evaluation_membre, date_evaluation, evaluation_jeu_active, evaluation_membre_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            }
            $this->requete($sql, $donnees);
            return $evaluation->getEvaluationId() > 0 ? $evaluation->getEvaluationId() : $this->bd->lastInsertId();
        }

    }