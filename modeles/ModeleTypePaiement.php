<?php
/**
 * @file     ModeleCategories.php
 * @author   Jansy Lopez
 * @version  1.0
 * @date     
 * @brief    Modèle TypePaiement
 *
 * @details  Fonctions "CRUD" pour la table  
 */

	class ModeleTypePaiement extends BaseDAO {

        // Déclaration du nom de la table (fonction abstraite)
		public function lireNomTable() {
			return "type_paiement";
        }
               
        public function lireTypePaiementParId($type_paiement_id) {
            $resultat = $this->lire($type_paiement_id);
            $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'TypePaiement');
            return $resultat->fetch();
        }

        public function lireToutesTypePaiement() {
            $resultat = $this->lireTous();
            return $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'TypePaiement');
        }


        
    }