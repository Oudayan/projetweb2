<?php
/**
 * @file     ModeleDestinataire.php
 * @author   Jansy Lopez
 * @version  1.0
 * @date     
 * @brief    Modèle Destinataire
 *
 * @details  Fonctions "CRUD" pour la table  
 */

	class ModeleDestinataire extends BaseDAO {

        // Déclaration du nom de la table (fonction abstraite)
		public function lireNomTable() {
			return "destinataire";
        }
               
        public function lireDestinataireParId($id) {
            $resultat = $this->lire($id);
            $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Destinataire');
            return $resultat->fetch();
        }

        public function lireToutesDestinataire() {
            $resultat = $this->lireTous();
            return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Destinataire');
        }


        
    }