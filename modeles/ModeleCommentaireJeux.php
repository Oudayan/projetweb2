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

    }