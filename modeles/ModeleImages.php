<?php
/**
 * @file     ModeleImages.php
 * @author   Guilherme Tosin, Marcelo Guzmán
 * @version  1.0
 * @date     
 * @brief    Modèle Images
 *
 * @details  Fonctions "CRUD" pour la table  
 */

	class ModeleImages extends BaseDAO {

        // Déclaration du nom de la table (fonction abstraite)
		public function lireNomTable() {
			return "photo_jeux";
        }

        public function toutesImages() {
            $resultat = $this->lireTous();
            return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Images');
        }
        
        public function lireImageParId($idImage) {
            $resultat = $this->lire($idImage);
            $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Images');
            return $resultat->fetch();
        }

        public function lireImagesParJeuxId($id) {
            $resultat = $this->lire($id, "jeux_id");
            return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Images');
        }

        public function lireImageParJeuxId($id) {
            $resultat = $this->lire($id, "jeux_id");
            $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Images');
            return $resultat->fetch();
        }

    }