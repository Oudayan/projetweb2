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
               
        public function lireCategorieJEuxParId($id) {
            $resultat = $this->lire($id);
            $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'CategoriesJeux');
            return $resultat->fetch();
        }

        public function lireToutesCategoriesJeux() {
            $resultat = $this->lireTous();
            return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'CategoriesJeux');
        }


        
    }