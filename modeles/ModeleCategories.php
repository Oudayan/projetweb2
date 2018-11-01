<?php
/**
 * @file     ModeleCategories.php
 * @author   Guilherme Tosin, Marcelo Guzmán
 * @version  1.0
 * @date     
 * @brief    Modèle Categorie
 *
 * @details  Fonctions "CRUD" pour la table  
 */

	class ModeleCategories extends BaseDAO {

        // Déclaration du nom de la table (fonction abstraite)
		public function lireNomTable() {
			return "`categorie`";
        }

        public function lireCategoriesParId($id) {
            $resultat = $this->lire($id);
            $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Categories');
            return $resultat->fetch();
        }

        public function lireToutesCategories($ordre = 1, $champ = NULL, $limit = "0, 9999999999999999") {
            if (isset($champ)) {
                $resultat = $this->lireTous($this->lireClePrimaire() . " > 0", ($ordre == 1 ? "ASC" : "DESC"), $champ, $limit);
            }
            else {
                $resultat = $this->lireTous($this->lireClePrimaire() . " > 0", ($ordre == 1 ? "ASC" : "DESC"), $this->lireClePrimaire(), $limit);
            }
            return $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Categories");
        }

        public function lireToutesCategoriesActives() {
            $sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE categorie_active = 1 ORDER BY categorie ASC";
            $resultat = $this->requete($sql);
            return $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Categories");
        }

        public function obtenirNbCategories($filtre = "categorie_id > 0") {
            $sql = "SELECT COUNT(categorie_id) AS nb_categories FROM " . $this->lireNomTable() . " WHERE " . $filtre;
            $resultat = $this->requete($sql);
            return $resultat->fetch();
        }		

        public function sauvegarder(Categories $categorie) {
            $donnees = array(
                $categorie->getCategorie(),
                $categorie->getCategorieActive(),
                $categorie->getCategorieId()
            );

            if ($categorie->getCategorieId() && $this->lire($categorie->getCategorieId())->fetch()) {
                $sql = "UPDATE " . $this->lireNomTable() . " SET categorie=?, categorie_active=? WHERE categorie_id=?";
            }
            else {
                $id = array_pop($donnees);
                $sql = "INSERT INTO " . $this->lireNomTable() . " (categorie, categorie_active) VALUES (?, ?)";
            }
            $this->requete($sql, $donnees);
        }

        public function effacerCategorie($id) {
            return $this->effacer($id);
        }

        public function desactiverCategorie($id) {
            return $this->modifierChamp($id, "categorie_active", 0);
        }

        public function activerCategorie($id) {
            return $this->modifierChamp($id, "categorie_active", 1);
        }

    }