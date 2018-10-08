<?php
/**
 * @file    TypePaiement.php
 * @author  Jansy Loepz, Chunliang
 * @version 1.0
 * @date    Septembre 2018
 * @brief   Définit la classe Categorie
 * @details Cette classe définit les attributs d'un type de type de paiement
 */

    class TypePaiement {
        //Atributs
        private $type_paiement_id;
        private $type_paiement;

        // Constructeur
        public function __construct($type_paiement_id = 0, $type_paiement = "")
        {
            $this->setTypePaiementId($type_paiement_id);
            $this->setTypePaiement($type_paiement);
        }

        //SETTERS

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe TypePaiement
         * @param       [numeric] $type_paiement, l'id de la TypePaiement
         * @return      []
         */
        public function setTypePaiementId($type_paiement_id) {
            if (is_numeric($type_paiement_id) && trim($type_paiement_id) != "") {
                $this->type_paiement_id = $type_paiement_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe TypePaiement
         * @param       [string] $type_paiement, le nom de le Type de Paiement
         * @return      []
         */
        public function setTypePaiement($type_paiement) {
            if (is_string($type_paiement) && trim($type_paiement) != "") {
                $this->paiement = $type_paiement;
            }
        }

        // GETTERS

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe TypePaiement
         * @param       [numeric] $type_paiement_id, l'id de le Type de Paiement
         * @return      [numeric]
         */
        public function getTypePaiementId() {
            return $this->type_paiement_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe TypePaiement
         * @param       [string] $TypePaiement,  le nom de le Type de Paiement
         * @return      [string]
         */
        public function getTypePaiement() {
            return $this->type_paiement;
        }

    }
