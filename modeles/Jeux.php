<?php
/**
 * @file    Jeux.php
 * @author  Chunliang He, Guilherme Tosin, Jansy López, Marcelo Guzmán, Oudayan Dutta
 * @version 1.0
 * @date    Septembre 2018
 * @brief   Définit la classe Jeux
 * @details Cette classe définit les attributs d'un jeu
 */

    class Jeux {
        //Atributs
        private $jeux_id;
        private $plateforme_id;
        private $membre_id;
        private $titre;
        private $prix;
        private $date_ajout;
        private $concepteur;
        private $description;
        private $evaluation_globale;
        private $location;
        private $vendu;
        private $jeux_valide;
        private $jeux_actif;
        private $jeux_banni;

        // Constructeur
        public function __construct($jeux_id = 0, $plateforme_id = 1, $membre_id = 0, $titre = "", $prix = 0, $date_ajout = "", $concepteur = "", $description = "", $evaluation_globale= -1, $location = 0, $vendu = 0, $jeux_valide = 0, $jeux_actif = 1, $jeux_banni = 0) {
            $this->setJeuxId($jeux_id);
            $this->setPlateformeId($plateforme_id);
            $this->setMembreId($membre_id);
            $this->setTitre($titre);
            $this->setPrix($prix);
            $this->setDateAjout($date_ajout);
            $this->setConcepteur($concepteur);
            $this->setDescription($description);
            $this->setEvaluationGlobale($evaluation_globale);
            $this->setLocation($location);
            $this->setVendu($vendu);
            $this->setJeuxValide($jeux_valide);
            $this->setJeuxActif($jeux_actif);
            $this->setJeuxBanni($jeux_banni);
        }

        //SETTERS

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * @param       [numeric] $jeux_id ,  l'id d'un jeu
         * @return      [object]
         */
        public function setJeuxId($jeux_id) {
            if (is_numeric($jeux_id) && trim($jeux_id) != "") {
                $this->jeux_id = $jeux_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * @param       [numeric] $plateforme_id, l'id du type de plateforme
         * @return      [object]
         */
        public function setPlateformeId($plateforme_id) {
            if (is_numeric($plateforme_id) && trim($plateforme_id) != "") {
                $this->plateforme_id = $plateforme_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * @param       [numeric] $membre_id, l'id du propriétaire du jeu
         * @return      [object]
         */
        public function setMembreId($membre_id) {
            if (is_numeric($membre_id) && trim($membre_id) !="") {
                $this->membre_id = $membre_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * @param       [string] $titre, le titre du jeu
         * @return      [object]
         */
        public function setTitre($titre) {
            if (is_string($titre) && trim($titre) !="") {
                $this->titre = $titre;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * @param       [numeric] $prix, le prix du jeu
         * @return      [object]
         */
        public function setPrix($prix) {
            if (is_numeric($prix) && trim($prix) != "") {
                $this->prix = $prix;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * @param       [string] $date_ajout, la date d'ajout du jeu
         * @return      [object]
         */
        public function setDateAjout($date_ajout) {
            if (is_string($date_ajout) && trim($date_ajout) != "") {
                $this->date_ajout = $date_ajout;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * @param       [string] $concepteur, le concepteur du jeu
         * @return      [object]
         */
        public function setConcepteur($concepteur) {
            if (is_string($concepteur) && trim($concepteur) != "") {
                $this->concepteur = $concepteur;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * @param       [string] $jeux_actif, la description du jeu
         * @return      [object]
         */
        public function setDescription($description) {
            if (is_string($description) && trim($description) != "") {
                $this->description = $description;
            }
        }

         /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * @param       [numeric] $evaluation_globale, l'evaluation globale du jeu, compilée à partir de chaque évaluation/commentaire du jeu
         * @return      [object]
         */
        public function setEvaluationGlobale($evaluation_globale) {
            if (is_numeric($evaluation_globale) && trim($evaluation_globale) != "") {
                $this->evaluation_globale = $evaluation_globale;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * @param       [bool] $location, indique si le jeu est à louer ou à vendre
         * @return      [object]
         */
        public function setLocation($location) {
            if (is_numeric($location) && trim($location) != "") {
                $this->location = $location;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * @param       [bool] $vendu, indique si le jeu en vendu ou non
         * @return      [object]
         */
        public function setVendu($vendu) {
            if (is_numeric($vendu) && trim($vendu) != "") {
                $this->vendu = $vendu;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * @param       [bool] $jeux_valide, indique si un jeu a été validé par l'admin ou non
         * @return      [object]
         */
        public function setJeuxValide($jeux_valide) {
            if (is_numeric($jeux_valide)) {
                $this->jeux_valide = $jeux_valide;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * @param       [bool] $jeux_actif, indique si un jeu est actif ou non
         * @return      [object]
         */
        public function setJeuxActif($jeux_actif) {
            if (is_numeric($jeux_actif)) {
                $this->jeux_actif = $jeux_actif;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * @param       [bool] $jeux_banni, indique si un jeu est banni ou non
         * @return      [object]
         */
        public function setJeuxBanni($jeux_banni) {
            if (is_numeric($jeux_banni)) {
                $this->jeux_banni = $jeux_banni;
            }
        }

        // GETTERS

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         * @param       [numeric] $jeux_id,  l'id du jeu
         * @return      [object]
         */
        public function getJeuxId() {
            return $this->jeux_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         * @param       [numeric] $plateforme_id, l'id du type de plateforme du jeu
         * @return      [object]
         */
        public function getPlateformeId() {
            return $this->plateforme_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         * @param       [numeric] $membre_id, l'id du propriétaire du jeu
         * @return      [object]
         */
        public function getMembreId() {
            return $this->membre_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         * @param       [string] $titre, le titre du jeu
         * @return      [object]
         */
        public function getTitre() {
            return $this->titre;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         * @param       [string] $prix, le prix du jeu
         * @return      [object]
         */
        public function getPrix() {
            return $this->prix;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         * @param       [string] $date_ajout, la date d'ajout du jeu
         * @return      [object]
         */
        public function getDateAjout() {
            return $this->date_ajout;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         * @param       [string] $concepteur, le concepteur du jeu
         * @return      [object]
         */
        public function getConcepteur() {
            return $this->concepteur;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         * @param       [string] $description, la description du jeu
         * @return      [object]
         */
        public function getDescription() {
            return $this->description;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         * @param       [numeric] $evaluation_globale, l'evaluation globale du jeu, compilée à partir de chaque évaluation/commentaire du jeu
         * @return      [object]
         */
        public function getEvaluationGlobale() {
            return $this->evaluation_globale;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         * @param       [bool] $location, indique si le jeu est à louer ou à vendre
         * @return      [object]
         */
        public function getLocation() {
            return $this->location;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         * @param       [bool] $vendu, indique si le jeu en vendu ou non
         * @return      [object]
         */
        public function getVendu() {
            return $this->vendu;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         * @param       [bool] $jeux_valide, $jeux_valide, indique si un jeu a été validé par l'admin ou non
         * @return      [object]
         */
        public function getJeuxValide() {
            return $this->jeux_valide;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         * @param       [bool] $jeux_actif, le jeu est actif ou non
         * @return      [object]
         */
        public function getJeuxActif() {
            return $this->jeux_actif;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         * @param       [bool] $jeux_banni, le jeu est banni ou non
         * @return      [object]
         */
        public function getJeuxBanni() {
            return $this->jeux_banni;
        }

    }
