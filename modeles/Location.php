<?php
/**
 * @file    Location.php
 * @author  Oudayan Dutta, Denise Ratté, Zoraida Ortiz, Jorge Subirats 
 * @version 1.0
 * @date    20 février 2018
 * @brief   Définit la classe Location.
 *
 * @details Cette classe définit les attributs privés d'une location avec toutes les méthodes publiques "getters" et "setters" pour écrire et lire les attributs
 */
	class Location {

		// Attributs
		private $id_location;
		private $id_logement;
		private $id_proprietaire;
		private $id_locataire;
		private $date_debut;
		private $date_fin;
		private $date_location;
		private $cout;
		private $valide;
		private $jeton;
		private $evaluation;
		private $commentaire;
		private $date_evaluation;
		private $e_banni;
		private $e_date_banni;
		private $e_commentaire_banni;

        // Constructeur
		public function __construct($id_location = 0, $id_logement = 0, $id_proprietaire = "", $id_locataire = "", $date_debut = "", $date_fin = "", $date_location = "", $cout = 0, $valide = 0, $jeton = NULL,  $evaluation = NULL, $commentaire = NULL, $date_evaluation = NULL, $e_banni = NULL, $e_date_banni = NULL, $e_commentaire_banni = NULL) {
			$this->ecrireIdLocation($id_location);
			$this->ecrireIdLogement($id_logement);
			$this->ecrireIdProprietaire($id_proprietaire);
			$this->ecrireIdLocataire($id_locataire);
			$this->ecrireDateDebut($date_debut);			
			$this->ecrireDateFin($date_fin);			
			$this->ecrireDateLocation($date_location);			
			$this->ecrireCout($cout);			
			$this->ecrireValide($valide);
			$this->ecrireJeton($jeton);
            $this->ecrireEvaluation($evaluation);
            $this->ecrireCommentaire($commentaire);
            $this->ecrireDateEvaluation($date_evaluation);
            $this->ecrireEBanni($e_banni);
            $this->ecrireEDateBanni($e_date_banni);
            $this->ecrireECommentaireBanni($e_commentaire_banni);
		}
        
         // "SETTERS"
        /**     
		 * @brief      Permet de définir en ecriture l'attribut de la classe Location
		 * @param      [numeric]  $id_location  numéro d'identifiant de la location
		 * @return     [object]
		 */
        public function ecrireIdLocation($id_location) {
            if (is_numeric($id_location) && trim($id_location) != "") {
                $this->id_location = $id_location;
            }
        }
        /**     
		 * @brief      Permet de définir en ecriture l'attribut de la classe Location
		 * @param      [numeric]  $id_logement  numéro d'identifiant du logement
		 * @return     [object]
		 */
        public function ecrireIdLogement($id_logement) {
            if (is_numeric($id_logement) && trim($id_logement) != "") {
                $this->id_logement = $id_logement;
            }
        }
        /**
		 * @brief      Permet de définir en ecriture l'attribut de la classe Destinataire
		 * @param      [string]  $id_proprietaire     identifiant du proprietaire
		 * @return     [object]
		 */
        public function ecrireIdProprietaire($id_proprietaire) {
            if (is_string($id_proprietaire) && trim($id_proprietaire) != "") {
                $this->id_proprietaire = $id_proprietaire;
            }
        }
        /**
		 * @brief      Permet de définir en ecriture l'attribut de la classe Destinataire
		 * @param      [string]  $id_locataire     identifiant du locataire
		 * @return     [object]
		 */
        public function ecrireIdLocataire($id_locataire) {
            if (is_string($id_locataire) && trim($id_locataire) != "") {
                $this->id_locataire = $id_locataire;
            }
        }
        /**
		 * @brief      Permet de définir en ecriture l'attribut de la classe Destinataire
		 * @param      [string]  $date_debut     identifiant de la date de début de la location
		 * @return     [object]
		 */
        public function ecrireDateDebut($date_debut) {
            if (is_string($date_debut) && trim($date_debut) != "") {
                $this->date_debut = $date_debut;
            }
        }
        /**
		 * @brief      Permet de définir en ecriture l'attribut de la classe Destinataire
		 * @param      [string]  $date_fin     identifiant de la date de fin de la location
		 * @return     [object]
		 */
        public function ecrireDateFin($date_fin) {
            if (is_string($date_fin) && trim($date_fin) != "") {
                $this->date_fin = $date_fin;
            }
        }
        /**
		 * @brief      Permet de définir en ecriture l'attribut de la classe Destinataire
		 * @param      [string]  $date_location     identifiant de la date de location
		 * @return     [object]
		 */
        public function ecrireDateLocation($date_location) {
            if (is_string($date_location) && trim($date_location) != "") {
                $this->date_location = $date_location;
            }
        }
        /**     
		 * @brief      Permet de définir en ecriture l'attribut de la classe Location
		 * @param      [numeric]  $cout  cout de la location du logement
		 * @return     [object]
		 */
        public function ecrireCout($cout) {
            if (is_numeric($cout) && trim($cout) != "") {
                $this->cout = $cout;
            }
        }
        /**     
		 * @brief      Permet de définir en ecriture l'attribut de la classe Location
		 * @param      [numeric]  $valide  valide la location du logement
		 * @return     [object]
		 */
        public function ecrireValide($valide) {
            if (is_numeric($valide) && trim($valide) != "") {
                $this->valide = $valide;
            }
        }
        /**
		 * @brief      Permet de définir en ecriture l'attribut de la classe Destinataire
		 * @param      [string]  $jeton     
		 * @return     [object]
		 */
        public function ecrireJeton($jeton) {
            if (is_string($jeton) && trim($jeton) != "") {
                $this->jeton = $jeton;
            }
        }
        /**     
		 * @brief      Permet de définir en ecriture l'attribut de la classe Location
		 * @param      [numeric]  $evaluation  evaluation de la satisfaction du client
		 * @return     [object]
		 */
        public function ecrireEvaluation($evaluation) {
            if (is_numeric($evaluation) && trim($evaluation) != "") {
                $this->evaluation = $evaluation;
            }
        }
        /**
		 * @brief      Permet de définir en ecriture l'attribut de la classe Location
		 * @param      [string]  $commentaire  permet que le locataire laisse ses commentaires    
		 * @return     [object]
		 */
        public function ecrireCommentaire($commentaire) {
            if (is_string($commentaire) && trim($commentaire) != "") {
                $this->commentaire = $commentaire;
            }
        }
        /**
		 * @brief      Permet de définir en ecriture l'attribut de la classe Location
		 * @param      [string]  $date_evaluation  permet de connaitre la date où l'évaluation a été écrite    
		 * @return     [object]
		 */
        public function ecrireDateEvaluation($date_evaluation) {
            if (is_string($date_evaluation) && trim($date_evaluation) != "") {
                $this->date_evaluation = $date_evaluation;
            }
        }
		/**
		 * @brief      Permet de définir en ecriture l'attribut de la classe Location
		 * @param      [string]  $e_banni  permet de connaitre si un utilisateur est banni du site  
		 * @return     [object]
		 */
        public function ecrireEBanni($e_banni) {
            if (is_bool($e_banni) && trim($e_banni) != "") {
                $this->e_banni = $e_banni;
            }
        }
		/**
		 * @brief      Permet de définir en ecriture l'attribut de la classe Location
		 * @param      [string]  $e_date_banni  permet de connaitre la date où un utilisateur est banni du site  
		 * @return     [object]
		 */
        public function ecrireEDateBanni($e_date_banni) {
            if (is_string($e_date_banni) && trim($e_date_banni) != "") {
                $this->e_date_banni = $e_date_banni;
            }
        }
        /**
		 * @brief      Permet de définir en ecriture l'attribut de la classe Location
		 * @param      [string]  $e_commentaire_banni  permet de connaitre la raison pourquoi un utilisateur est banni du site  
		 * @return     [object]
		 */
        public function ecrireECommentaireBanni($e_commentaire_banni) {
            if (is_string($e_commentaire_banni) && trim($e_commentaire_banni) != "") {
                $this->e_commentaire_banni = $e_commentaire_banni;
            }
        }

        // "GETTERS"
        /**     
		 * @brief      Permet de définir en lecture l'attribut de la classe Location
		 * @param      [numeric]  $id_location  numéro d'identifiant de la location
		 * @return     [object]
		 */
        public function lireIdLocation() {
            return $this->id_location;
        }
		/**     
		 * @brief      Permet de définir en lecture l'attribut de la classe Location
		 * @param      [numeric]  $id_logement  numéro d'identifiant du logement
		 * @return     [object]
		 */
        public function lireIdLogement() {
            return $this->id_logement;
        }
        /**
		 * @brief      Permet de définir en lecture l'attribut de la classe Destinataire
		 * @param      [string]  $id_proprietaire     identifiant du proprietaire
		 * @return     [object]
		 */
        public function lireIdProprietaire() {
            return $this->id_proprietaire;
        }
        /**
		 * @brief      Permet de définir en lecture l'attribut de la classe Destinataire
		 * @param      [string]  $id_locataire     identifiant du locataire
		 * @return     [object]
		 */
        public function lireIdLocataire() {
            return $this->id_locataire;
        }
        /**
		 * @brief      Permet de définir en lecture l'attribut de la classe Destinataire
		 * @param      [string]  $date_debut     identifiant de la date de début de la location
		 * @return     [object]
		 */
        public function lireDateDebut() {
            return $this->date_debut;
        }
        /**
		 * @brief      Permet de définir en lecture l'attribut de la classe Destinataire
		 * @param      [string]  $date_fin     identifiant de la date de fin de la location
		 * @return     [object]
		 */
        public function lireDateFin() {
            return $this->date_fin;
        }
        /**
		 * @brief      Permet de définir en lecture l'attribut de la classe Destinataire
		 * @param      [string]  $date_location     identifiant de la date de location
		 * @return     [object]
		 */
        public function lireDateLocation() {
            return $this->date_location;
        }
        /**     
		 * @brief      Permet de définir en lecture l'attribut de la classe Location
		 * @param      [numeric]  $cout  cout de la location du logement
		 * @return     [object]
		 */
        public function lireCout() {
            return $this->cout;
        }
        /**     
		 * @brief      Permet de définir en lecture l'attribut de la classe Location
		 * @param      [numeric]  $valide  valide la location du logement
		 * @return     [object]
		 */
        public function lireValide() {
            return $this->valide;
        }
        /**
		 * @brief      Permet de définir en lecture l'attribut de la classe Destinataire
		 * @param      [string]  $jeton     
		 * @return     [object]
		 */
        public function lireJeton() {
            return $this->jeton;
        }
        /**     
		 * @brief      Permet de définir en lecture l'attribut de la classe Location
		 * @param      [numeric]  $evaluation  evaluation de la satisfaction du client
		 * @return     [object]
		 */
        public function lireEvaluation() {
            return $this->evaluation;
        }
        /**
		 * @brief      Permet de définir en lecture l'attribut de la classe Location
		 * @param      [string]  $commentaire  permet que le locataire laisse ses commentaires    
		 * @return     [object]
		 */
        public function lireCommentaire() {
            return $this->commentaire;
        }
        /**
		 * @brief      Permet de définir en lecture l'attribut de la classe Location
		 * @param      [string]  $date_evaluation  permet de connaitre la date où l'évaluation a été écrite    
		 * @return     [object]
		 */
        public function lireDateEvaluation() {
            return $this->date_evaluation;
        }
        /**
		 * @brief      Permet de définir en lecture l'attribut de la classe Location
		 * @param      [string]  $e_banni  permet de connaitre si un utilisateur est banni du site  
		 * @return     [object]
		 */
        public function lireEBanni() {
            return $this->e_banni;
        }
        /**
		 * @brief      Permet de définir en lecture l'attribut de la classe Location
		 * @param      [string]  $e_date_banni  permet de connaitre la date où un utilisateur est banni du site  
		 * @return     [object]
		 */
        public function lireEDateBanni() {
            return $this->e_date_banni;
        }
        /**
		 * @brief      Permet de définir en lecture l'attribut de la classe Location
		 * @param      [string]  $e_commentaire_banni  permet de connaitre la raison pourquoi un utilisateur est banni du site  
		 * @return     [object]
		 */
        public function lireECommentaireBanni() {
            return $this->e_commentaire_banni;
        }

    }
