<?php
/**
 * @file     ModelePlateformes.php
 * @author   
 * @version  1.0
 * @date     
 * @brief    Modèle Plateformes
 *
 * @details  Fonctions "CRUD" pour la table  
 */

	class ModelePlateformes extends BaseDAO {

        // Déclaration du nom de la table (fonction abstraite)
		public function lireNomTable() {
			return "plateforme";
        }

        public function lirePlateformeParId($id) {
            $resultat = $this->lire($id);
            $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Plateformes');
            return $resultat->fetch();
        }

        public function lireToutesPlateformes() {
            $resultat = $this->lireTous("ASC", "plateforme");
            return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Plateformes');
        }

        public function lireToutesPlateformesActives() {
            $sql = "SELECT * FROM " . $this->lireNomTable() . " WHERE plateforme_active = 1 ORDER BY plateforme ASC";
            $resultat = $this->requete($sql);
            return $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Plateformes");
        }

        public function sauvegarder(Plateformes $plateforme)
        {
            $donnees = array(
                $plateforme->getPlateforme(),
                $plateforme->getPlateformeActive(),
                $plateforme->getPlateformeId()
            );

            if($plateforme->getPlateformeId() && $this->lire($plateforme->getPlateformeId())->fetch())
            {
                $sql = "UPDATE " . $this->lireNomTable() . " SET plateforme=?, plateforme_active=? WHERE plateforme_id=?";
            }
            else
            {
                $id = array_pop($donnees);
                $sql = "INSERT INTO " . $this->lireNomTable() . " (plateforme, plateforme_active) VALUES (?, ?)";
            }
            $this->requete($sql, $donnees);
        }

        public function effacerPlateforme($id) {
            return $this->effacer($id);
        }

        public function desactiverPlateforme($id) {
            return $this->modifierChamp($id, "plateforme_active", 0);
        }

        public function activerPlateforme($id) {
            return $this->modifierChamp($id, "plateforme_active", 1);
        }

    }