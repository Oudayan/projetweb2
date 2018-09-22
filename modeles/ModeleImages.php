<?php
/**
 * @file     ModeleImages.php
 * @author   
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


        public function lireImageJeuParId($idImage) {
            $resultat = $this->lire($idImage);
            $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Images');
            return $resultat->fetch();
        }


        
    }