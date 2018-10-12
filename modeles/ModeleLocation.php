<?php
/**
 * @file     ModeleLocation.php
 * @author   chunliang
 * @version  1.0
 * @date     
 * @brief    Modèle Location 
 *
 * @details  Fonctions "CRUD" pour la table  
 */

	class ModeleLocation extends BaseDAO {

		public function lireNomTable() {
			return "location";
		}

        public function lireToutesLesLocations() {
            $resultat = $this->lireTous();
            return $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Location");
        }

		public function lireLocationParId($id) {
            $resultat = $this->lire($id);
			$resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Location');
			return $resultat->fetch();
		}

        public function lireLocationsParJeuxId($id) {
            $sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE jeux_id = " . $id . " AND date_retour > NOW() ORDER BY date_debut ASC" ;
			$resultat = $this->requete($sql);
			return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Location");
        }

		public function sauvegarde(Location $location)
		{
			$donnees = array(
				$location->getTypePaiementId(),
				$location->getMembreId(),
				$location->getJeuxId(),
				$location->getDateDebut(),
				$location->getDateRetour(),
				$location->getTransactionId(),
				$location->getLocationId()
			);
			if($location->getLocationId() && $this->lire($location->getLocationId())->fetch())
			{
				$sql = "UPDATE " . $this->lireNomTable() . " SET type_paiement_id=?, membre_id=?, jeux_id=?, date_debut=?, date_retour=?, transaction_id=? WHERE location_id=?"; 
			}
			else
			{
				$id = array_pop($donnees);
				$sql = "INSERT INTO " . $this->lireNomTable() . " (type_paiement_id, membre_id, jeux_id, date_debut, date_retour, transaction_id) VALUES (?, ?, ?, ?, ?, ?)";
			}
			$this->requete($sql, $donnees);
			return $location->getLocationId() > 0 ? $location->getLocationId() : $this->bd->lastInsertId();
		}

//		public function lireDetaileLocation() {
//
//            $sql = "SELECT * FROM " . $this->lireNomTable() . " l
//            INNER JOIN  jeux j ON j.jeux_id = l.jeux_id
//            INNER JOIN	membre m ON M.membre_id = l.membre_id
//            INNER JOIN	type_paiement tp ON tp.type_paiement_id = l.type_paiement_id";
//            $resultat = $this->requete($sql);
//			return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Location");
//        }
//
//        public function effacerLocation($id) {
//        	return $this->effacer($id);
//        }
//
//        // $action = 0-À valider / 1-Accepté / 2-Refusé / 3-Expiré:
//        public function validerLocation($id, $action) {
//            return $this->modifierChamp($id, "valide", $action);
//        }
//
//        public function bannirEvaluation($id) {
//            return $this->modifierChamp($id, "e_banni", 1);
//        }

    }

?>