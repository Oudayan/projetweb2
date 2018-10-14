<?php
/**
 * @file     ModeleCommentaireJeux.php
 * @author   Guilherme Tosin, Marcelo Guzmán
 * @version  1.0
 * @date     
 * @brief    Modèle Commentaire
 *
 * @details  Fonctions "CRUD" pour la table  
 */

	class ModeleCommentaireJeux extends BaseDAO {

        // Déclaration du nom de la table (fonction abstraite)
		public function lireNomTable() {
			return "commentaire_jeux";
        }

        public function lireCommentaireParJeuxId($id) {
            $resultat = $this->lire($id, "jeux_id");
            return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'CommentaireJeux');
        }

        public function toutObtenirParIdJeuxId($id){
            $sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE jeux_id = " . $id . " ORDER BY date_commentaire DESC";
            $resultat = $this->requete($sql);
            return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "CommentaireJeux");
        }
        
        public function nbEvaluationsParJeu($id){
            $sql = "SELECT COUNT(jeux_id) FROM " . $this->lireNomTable() . " WHERE jeux_id = " . $id;
            $resultat = $this->requete($sql);
            return $resultat->fetch();
        }

        public function sauvegarde(CommentaireJeux $commentaire) {
        $donnees = array(
            $commentaire->getJeuxId(),
            $commentaire->getMembreId(),
            $commentaire->getJeton(),
            $commentaire->getCommentaire(),
            $commentaire->getEvaluation(), 
            $commentaire->getDateCommentaire(),
            $commentaire->getCommentaireJeuxId(),
        );
        if ($commentaire->getCommentaireJeuxId() && $this->lire($commentaire->getCommentaireJeuxId())->fetch()) {
            $sql = "UPDATE " . $this->lireNomTable() . " SET jeux_id=?, membre_id=?, jeton=?, commentaire=?, evaluation=?, date_commentaire=? WHERE membre_id=?"; 
        } else {
            $id = array_pop($donnees);
            $sql = "INSERT INTO " . $this->lireNomTable() . " (jeux_id, membre_id, jeton, commentaire, evaluation, date_commentaire) VALUES (?, ?, ?, ?, ?, ?)";
        }
        $this->requete($sql, $donnees);
        return $commentaire->getCommentaireJeuxId() > 0 ? $commentaire->getCommentaireJeuxId() : $this->bd->lastInsertId();
    }

    }