<?php
/**
 * @file     ModeleCategoriesJeux.php
 * @author   Guilherme Tosin, Marcelo Guzmán
 * @version  1.0
 * @date     
 * @brief    Modèle Categorie
 *
 * @details  Fonctions "CRUD" pour la table  
 */

	class ModeleCategoriesJeux extends BaseDAO {

        // Déclaration du nom de la table (fonction abstraite)
		public function lireNomTable() {
			return "categorie_jeux";
        }

        public function lireCategoriesParJeuxId($id) {
            $sql = "SELECT cj.jeux_id, cj.categorie_id, c.categorie FROM " . $this->lireNomTable() . " cj JOIN categorie c ON cj.categorie_id = c.categorie_id WHERE jeux_id = " . $id;
            $resultat = $this->requete($sql);
            return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "CategoriesJeux");
        }
        
    }