<?php
/**
 * @file     ModeleJeux.php
 * @author   
 * @version  1.0
 * @date     
 * @brief    Modèle Jeux
 *
 * @details  Fonctions "CRUD" pour la table  
 */

	class ModeleJeux extends BaseDAO {

		public function lireNomTable() {
			return "jeux";
		}
        
		public function lireJeuParId($id = 3) {
            $resultat = $this->lire($id);
			$resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Jeux');
			return $resultat->fetch();
		}
		
		public function lireJeuxParMembre($membre_id) {
            $sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE membre_id = '" . $membre_id . "' AND jeux_actif = true AND jeux_valide = true ORDER BY date_debut DESC";
			$resultat = $this->requete($sql);
			return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Jeux");
		}
		
		public function lireDerniersJeux($nombreJeux = 9) {
            $sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE jeux_actif = true AND jeux_valide = true ORDER BY jeux_id DESC LIMIT " . $nombreJeux;
			$resultat = $this->requete($sql);
			return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Jeux");
		}
		
		public function lireTousLesJeux() {
            $sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE jeux_actif = true AND jeux_valide = true";
			$resultat = $this->requete($sql);
			return $resultat->fetchAll(\PDO::FETCH_ASSOC);
		}

//        public function lireTousIdsJeux() {
//            $sql = "SELECT jeux_id FROM " . $this->lireNomTable() . " WHERE jeux_actif = true AND jeux_valide = true";
//            $resultat = $this->requete($sql);
//            return $resultat->fetchAll(\PDO::FETCH_ASSOC);
//        }


		public function sauvegarderJeux(Jeux $jeux) {
			$sql = "INSERT INTO " . $this->lireNomTable() . "(
				plateforme_id, membre_id, titre, prix, date_ajout, concepteur, location, jeux_valide, jeux_actif, description)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			$donnees = array(
				$jeux->getPlateformeId(), $jeux->getMembreId(), $jeux->getTitre(), $jeux->getPrix(), $jeux->getDateAjout(),
				$jeux->getConcepteur(), $jeux->getLocation(), $jeux->getJeuxValide(), $jeux->getJeuxActif(), $jeux->getDescription());
			return $this->requete($sql, $donnees);
		}

        public function effacerJeu($id) {
        	return $this->effacer($id);
        }

        public function validerJeu($id) {
            return $this->modifierChamp($id, "jeux_valide", 1);
        }

        public function desactiverJeu($id) {
            return $this->modifierChamp($id, "jeux_actif", 0);
        }
        
    }

?>