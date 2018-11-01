<?php
/**
 * @file     ModeleLocation.php
 * @author   Chunliang He, Oudayan Dutta
 * @version  1.0
 * @date     Septembre 2018
 * @brief    Modèle Location 
 * @details  Fonctions "CRUD" pour la table  
 */

	class ModeleLocation extends BaseDAO {

		public function lireNomTable() {
			return "`location`";
		}

		public function lireToutesLesLocations($ordre = 1, $champ = NULL, $limit = "0, 9999999999999999") {
			if (isset($champ)) {
				$resultat = $this->lireTous($this->lireClePrimaire() . " > 0", ($ordre == 1 ? "ASC" : "DESC"), $champ, $limit);
			}
			else {
				$resultat = $this->lireTous($this->lireClePrimaire() . " > 0", ($ordre == 1 ? "ASC" : "DESC"), $this->lireClePrimaire(), $limit);
			}
			return $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Location");
		}

		public function lireLocationParId($id) {
            $resultat = $this->lire($id);
			$resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Location');
			return $resultat->fetch();
		}

        public function lireLocationsParJeuxId($id) {
            $sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE jeux_id = " . $id . " AND date_retour > NOW() AND location_active = 1 ORDER BY date_debut ASC" ;
			$resultat = $this->requete($sql);
			return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Location");
        }

		public function obtenirNbLocations($filtre = "location_id > 0") {
			$sql = "SELECT COUNT(location_id) AS nb_locations FROM " . $this->lireNomTable() . " WHERE " . $filtre;
			$resultat = $this->requete($sql);
			return $resultat->fetch();
		}		

		public function sauvegarde(Location $location) {
			$donnees = array(
				$location->getTypePaiementId(),
				$location->getMembreId(),
				$location->getJeuxId(),
				$location->getDateLocation(),
				$location->getDateDebut(),
				$location->getDateRetour(),
				$location->getTransactionId(),
				$location->getLocationActive(),
				$location->getLocationId()
			);
			if ($location->getLocationId() && $this->lire($location->getLocationId())->fetch()) {
				$sql = "UPDATE " . $this->lireNomTable() . " SET type_paiement_id=?, membre_id=?, jeux_id=?, date_location=?, date_debut=?, date_retour=?, transaction_id=?, location_active=? WHERE location_id=?"; 
			} else {
				$id = array_pop($donnees);
				$sql = "INSERT INTO " . $this->lireNomTable() . " (type_paiement_id, membre_id, jeux_id, date_location, date_debut, date_retour, transaction_id, location_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
			}
			$this->requete($sql, $donnees);
			return $location->getLocationId() > 0 ? $location->getLocationId() : $this->bd->lastInsertId();
		}

		public function effacerLocation($id) {
			return $this->effacer($id);
		}

		public function desactiverLocation($id) {
			return $this->modifierChamp($id, "location_active", 0);
		}

		public function activerLocation($id) {
			return $this->modifierChamp($id, "location_active", 1);
		}

	}

?>