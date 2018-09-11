<?php
/**
 * @file     BaseDao.php
 * @author   
 * @version  1.0
 * @date     9 février 2018
 * @brief    Modèle parent 
 * @details  Fonctions "CRUD" commumnes à toutes les classes et modèles
 */

	abstract class BaseDAO {
		protected $bd;
		public function __construct(PDO $bdPDO) {			
			$this->bd = $bdPDO;
		}

		/**
		 * @brief      Effacer une rangée de la table
		 * @param      [string]  $clePrimaire     ID de la clé primaire
		 * @return     [object]
		 */
		protected function effacer($clePrimaire) {
			$sql = "DELETE FROM " . $this->lireNomTable() . " WHERE " . $this->lireClePrimaire() ."=?";
			$donnees = array($clePrimaire);
			return $this->requete($sql, $donnees);
		}

        /**
		 * @brief      Lire le contenu d'une rangée de la table
		 * @param      [string]   $valeur       Valeur de la clé primaire OU de la colonne spécifée
		 * @param      [string]   $clePrimaire  Nom de la clé primaire OU de la colonne spécifée
		 * @return     [object]                 Tous les champs d'une entrée de la table
		 */
		protected function lire($valeur, $clePrimaire = NULL) {
			if (!isset($clePrimaire)) {
				$sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE " . $this->lireClePrimaire() ."=?";
			}
			else {
				$sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE " . $clePrimaire ."=?";
			}
			$donnees = array($valeur);
			return $this->requete($sql, $donnees);
		}

        /**
		 * @brief      Lire le contenu de toutes les rangées de la table
		 * @return     [object]  Tous les champs de toutes les entrées la table
		 */
		protected function lireTous() {
			$sql = "SELECT * FROM " . $this->lireNomTable();
			return $this->requete($sql);
		}

        /**
		 * @brief      Modifie la valeur d'un champ dans une table
		 * @param      [string] $id     Valeur de la clé primaire OU de la colonne spécifée
		 * @param      [string] $champ  Nom de la colonne à modifier
         * @param      [string] $valeur Valeur de la colonne à modifier
         * @return     [object] L'exécution de la requête
		 */
		protected function modifierChamp($id, $champ, $valeur) {
            $sql = "UPDATE " . $this->lireNomTable() . " SET " . $champ . "=? WHERE " . $this->lireClePrimaire() . "=?";
            $donnees = array($valeur, $id);
            return $this->requete($sql, $donnees);
        }

		/**
		 * @brief      Exécute une requête avec les paramètres voulus
		 * @details    Prépare les données en les protégeant des injections SQL et exécute la requête via l'object PDOStatement
		 * @param      [string]   $sql        La requete SQL
		 * @param      [array]    $donnees    La valeur des données à insérer dans la requête
		 * @return     [object]   $stmt       L'exécution de la requête 
		 */
		final protected function requete($sql, $donnees = array()) {
			try {
				$stmt = $this->bd->prepare($sql);
				$stmt->execute($donnees);
			}
			catch (PDOException $e) {
				trigger_error("<p>La requête suivante a donné une erreur : $sql</p><p>Exception : " . $e->getMessage() . "</p>");
			}
			return $stmt;
		}

		/**
		 * @brief      Va chercher le nom de la clé primaire d'une table
		 * @return     [string]  Nom de la clé primaire
		 */
		final protected function lireClePrimaire() {
			// Copyright Salim Bourihane
			$sql = "SHOW columns FROM " . $this->lireNomTable();
			$colonnes = $this->requete($sql);
			foreach ($colonnes as $champ) {
				if ($champ["Key"]=="PRI") {
					return $champ["Field"];
				}
			}
		}

		/**
		 * @brief     Méthode abstraite pour déclarer le nom de la table dans le modèle enfant.
		 */
		abstract function lireNomTable();

	}
?>
