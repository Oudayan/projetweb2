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

		public function lireNomTable() {
			return "photo_jeux";
		}


		public function toutesImages() {
            $sql = "SELECT chemin_photo FROM " . $this->lireNomTable();
			$resultat = $this->requete($sql);
			return $resultat->fetchAll(\PDO::FETCH_ASSOC);
		}


        
    }

?>