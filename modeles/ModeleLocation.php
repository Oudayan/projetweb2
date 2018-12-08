<?php
/**
 * @file     ModeleLocation.php
 * @author   Chunliang He, Oudayan Dutta
 * @version  1.0
 * @date     Septembre 2018
 * @brief    Modèle Location 
 * @details  Méthodes "CRUD" pour la table location 
 */

	class ModeleLocation extends BaseDAO {

        /**
         * @brief   Méthode qui déclare le nom de la table dans la BD
         * @return  [string]
         */
		public function lireNomTable() {
			return "`location`";
		}

        /**
         * @brief   Méthode pour aller chercher toutes les locations
         * @param   [numeric] $ordre, l'ordre des données : ASC ou DESC
         * @param   [string] $champ, le champ à trier dans la BD table location
         * @param   [string] $limit, l'index et le nombre d'entrées à extraire
         * @return  [array of Location objects]
         */
		public function lireToutesLesLocations($ordre = 1, $champ = NULL, $limit = "0, 9999999999999999") {
			if (isset($champ)) {
				$resultat = $this->lireTous($this->lireClePrimaire() . " > 0", ($ordre == 1 ? "ASC" : "DESC"), $champ, $limit);
			}
			else {
				$resultat = $this->lireTous($this->lireClePrimaire() . " > 0", ($ordre == 1 ? "ASC" : "DESC"), $this->lireClePrimaire(), $limit);
			}
			return $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Location");
		}

        /**
         * @brief   Méthode pour aller chercher le nombre de locations
         * @param   [string] $filtre, le filtre à passer dans le WHERE de la requête
         * @return  [array]
         */
		public function obtenirNbLocations($filtre = "location_id > 0") {
			$sql = "SELECT COUNT(location_id) AS nb_locations FROM " . $this->lireNomTable() . " WHERE " . $filtre;
			$resultat = $this->requete($sql);
			return $resultat->fetch();
		}		

        /**
         * @brief   Méthode pour aller chercher une location par son id
         * @param   [numeric] $location_id, l'id de la location
         * @return  [object]
         */
		public function lireLocationParId($location_id) {
            $resultat = $this->lire($location_id);
			$resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Location');
			return $resultat->fetch();
		}

        /**
         * @brief   Méthode pour aller chercher toutes les locations d'un jeu
         * @param   [numeric] $jeux_id, l'id du jeu
         * @return  [array of location objects]
         */
        public function lireLocationsParJeuxId($jeux_id) {
            // $resultat = $this->lire($jeux_id,'jeux_id');
			$sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE jeux_id = " . $jeux_id . " ORDER BY date_debut DESC";
			$resultat = $this->requete($sql);
			return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Location");
        }

        /**
         * @brief   Méthode pour aller chercher toutes les locations d'un jeu avant aujourd'hui
         * @param   [numeric] $jeux_id, l'id du jeu
         * @return  [array of location objects]
         */
        public function lireLocationsActivesParJeuxId($jeux_id) {
			$sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE jeux_id = " . $jeux_id . " AND location_active = 1 ORDER BY date_debut ASC";
			$resultat = $this->requete($sql);
			return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Location");
        }

        /**
         * @brief   Méthode pour aller chercher toutes les locations d'un jeu avant aujourd'hui
         * @param   [numeric] $jeux_id, l'id du jeu
         * @return  [array of location objects]
         */
        public function lireHistoriqueLocationsParJeuxId($jeux_id) {
			$sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE jeux_id = " . $jeux_id . " AND date_retour < NOW() ORDER BY date_debut DESC";
			$resultat = $this->requete($sql);
			return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Location");
        }

        /**
         * @brief   Méthode pour aller chercher la location courante d'un jeu
         * @param   [numeric] $jeux_id, l'id du jeu
         * @return  [array of location objects]
         */
        public function lireLocationCouranteParJeuxId($jeux_id) {
			$sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE jeux_id = " . $jeux_id . " AND NOW() >= date_debut AND NOW() <= date_retour ORDER BY location_active DESC";
			$resultat = $this->requete($sql);
			return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Location");
        }

        /**
         * @brief   Méthode pour aller chercher toutes les locations d'un jeu après aujourd'hui
         * @param   [numeric] $jeux_id, l'id du jeu
         * @return  [array of location objects]
         */
        public function lireLocationsAVenirParJeuxId($jeux_id) {
			$sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE jeux_id = " . $jeux_id . " AND date_debut > NOW() ORDER BY date_debut ASC";
			$resultat = $this->requete($sql);
			return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Location");
        }

        /**
         * @brief   Méthode pour obtenir tous les locations d'un membre dans la BD
         * @param   [numeric] $membre_id, l'id du membre 
         * @return  [array of location objects]
         */
        public function lireLocationsParMembreId($membre_id) {
            $resultat = $this->lire($membre_id,'membre_id');
            return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Location");
        }

        /**
         * @brief   Méthode pour enregistrer un nouveau membre dans la bd
         * @details Recueillir les informations insérées et les enregistrer dans la BD
         * @param   [numeric] $location_id
         * @param   [numeric] $type_paiement_id
         * @param   [numeric] $membre_id
         * @param   [numeric] $jeux_id
         * @param   [string] $date_location
         * @param   [string] $date_debut
         * @param   [string] $date_retour
         * @param   [string] $prix_location
         * @param   [string] $transaction_id
         * @param   [numeric] $location_active
         * @return  [array]
         */
		public function sauvegarde(Location $location) {
			$donnees = array(
				$location->getTypePaiementId(),
				$location->getMembreId(),
				$location->getJeuxId(),
				$location->getDateLocation(),
				$location->getDateDebut(),
				$location->getDateRetour(),
				$location->getPrixLocation(),
				$location->getTransactionId(),
				$location->getLocationActive(),
				$location->getLocationId()
			);
			if ($location->getLocationId() && $this->lire($location->getLocationId())->fetch()) {
				$sql = "UPDATE " . $this->lireNomTable() . " SET type_paiement_id=?, membre_id=?, jeux_id=?, date_location=?, date_debut=?, date_retour=?, prix_location=?, transaction_id=?, location_active=? WHERE location_id=?"; 
			} else {
				$id = array_pop($donnees);
				$sql = "INSERT INTO " . $this->lireNomTable() . " (type_paiement_id, membre_id, jeux_id, date_location, date_debut, date_retour, prix_location, transaction_id, location_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
			}
			$this->requete($sql, $donnees);
			return $location->getLocationId() > 0 ? $location->getLocationId() : $this->bd->lastInsertId();
		}

        /**
         * @brief   Méthode pour effacer une location par son id
         * @param   [numeric] $location_id, l'id de la location
         */
		public function effacerLocation($location_id) {
			return $this->effacer($location_id);
		}

        /**
         * @brief   Méthode pour désactiver une location par son id
         * @param   [numeric] $location_id, l'id de la location
         */
		public function desactiverLocation($location_id) {
			return $this->modifierChamp($location_id, "location_active", 0);
		}

        /**
         * @brief   Méthode pour activer une location par son id
         * @param   [numeric] $location_id, l'id de la location
         */
		public function activerLocation($location_id) {
			return $this->modifierChamp($location_id, "location_active", 1);
		}

	}

?>