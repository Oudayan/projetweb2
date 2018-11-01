<?php
/**
 * @file    Membres.php
 * @author  Guilherme Tosin, Marcelo Guzmán, Chunliang He, Oudayan Dutta
 * @version 1.0
 * @date    Septembre 2018
 * @brief   Définit la classe Membres
 * @details Cette classe définit les attributs d'un membre
 */

    class Membres {

        //Atributs
        private $membre_id;
        private $type_utilisateur_id;
        private $nom;
        private $prenom;
        private $mot_de_passe;
        private $adresse;
        private $telephone;
        private $courriel;
        private $date_ajout;
        private $evaluation_globale;
        private $alerte_email;
        private $newsletter;
        private $membre_valide;
        private $membre_actif;

        // Constructeur
        public function __construct($membre_id = 0, $type_utilisateur_id = 1, $nom = "", $prenom = "", $mot_de_passe = "", $adresse = "", $telephone = "", $courriel = "", $date_ajout = "", $evaluation_globale = -1, $alerte_email = 1, $newsletter = 0, $membre_valide = 0, $membre_actif = 1) {
            $this->setMembreId($membre_id);
            $this->setTypeUtilisateur($type_utilisateur_id);
            $this->setNom($nom);
            $this->setPrenom($prenom);
            $this->setMotDePasse($mot_de_passe);
            $this->setAdresse($adresse);
            $this->setTelephone($telephone);
            $this->setCourriel($courriel);
            $this->setDateAjout($date_ajout);
            $this->setEvaluationGlobale($evaluation_globale);
            $this->setAlerteEmail($alerte_email);
            $this->setNewsletter($newsletter);
            $this->setMembreValide($membre_valide);
            $this->setMembreActif($membre_actif);
        }

        //SETTERS

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         * @param       [numeric] $membre_id ,  l'id d'un membre
         * @return      [object]
         */
        public function setMembreId($membre_id) {
            if (is_numeric($membre_id) && trim($membre_id) != "") {
                $this->membre_id = $membre_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         * @param       [numeric] $type_utilisateur_id , l'id du type d'utilisateur
         * @return      [object]
         */
        public function setTypeUtilisateur($type_utilisateur_id) {
            if (is_numeric($type_utilisateur_id) && trim($type_utilisateur_id) != "") {
                $this->type_utilisateur_id = $type_utilisateur_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         * @param       [string] $nom , le nom d'un membre
         * @return      [object]
         */
        public function setNom($nom) {
            if (is_string($nom) && trim($nom) != "") {
                $this->nom = $nom;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         * @param       [string] $prenom , le prénom d'un membre
         * @return      [object]
         */
        public function setPrenom($prenom) {
            if (is_string($prenom) && trim($prenom) != "") {
                $this->prenom = $prenom;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         * @param       [string] $mot_de_passe , le mot de passe d'un membre
         * @return      [object]
         */
        public function setMotDePasse($mot_de_passe) {
            if (is_string($mot_de_passe) && trim($mot_de_passe) != "") {
                $this->mot_de_passe = $mot_de_passe;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         * @param       [string] $adresse, l'adresse d'un membre
         * @return      [object]
         */
        public function setAdresse($adresse) {
            if (is_string($adresse) && trim($adresse) != "") {
                $this->adresse = $adresse;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         * @param       [string] $telephone, le numéro de téléphone d'un utilisateur
         * @return      [object]
         */
        public function setTelephone($telephone) {
            if (is_string($telephone) && trim($telephone) != "") {
                $this->telephone = $telephone;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         * @param       [mixed] $courriel, le courriel d'un membre
         * @return      [object]
         */
        public function setCourriel($courriel) {
            if (is_string($courriel) && trim($courriel) != "") {
                $this->courriel = $courriel;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         * @param       [string] $date_ajout, la date d'ajout du membre
         * @return      [object]
         */
        public function setDateAjout($date_ajout) {
            if (is_string($date_ajout) && trim($date_ajout) != "") {
                $this->date_ajout = $date_ajout;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         * @param       [numeric] $evaluation_globale, l'evaluation globale du membre, compilée à partir de chaque évaluation/commentaire d'un jeu du membre
         * @return      [object]
         */
        public function setEvaluationGlobale($evaluation_globale) {
            if (is_numeric($evaluation_globale) && trim($evaluation_globale) != "") {
                $this->evaluation_globale = $evaluation_globale;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         * @param       [bool] $alerte_email, indique si l'option de recevoir un courriel quand il y a un nouveau message dans la messagerie interne
         * @return      [object]
         */
        public function setAlerteEmail($alerte_email) {
            if (is_numeric($alerte_email)) {
                $this->alerte_email = $alerte_email;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         * @param       [bool] $newsletter, indique si un membre est inscrit ou pas à la newsletter
         * @return      [object]
         */
        public function setNewsletter($newsletter) {
            if (is_numeric($newsletter)) {
                $this->newsletter = $newsletter;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         * @param       [bool] $membre_valide, indique si un membre est ou pas valide
         * @return      [object]
         */
        public function setMembreValide($membre_valide) {
            if (is_numeric($membre_valide)) {
                $this->membre_valide = $membre_valide;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         * @param       [bool] $membre_actif, indique si un membre est ou pas actif
         * @return      [object]
         */
        public function setMembreActif($membre_actif) {
            if (is_numeric($membre_actif)) {
                $this->membre_actif = $membre_actif;
            }
        }

        // GETTERS

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         * @param       [numeric] $membre_id ,  l'id d'un membre
         * @return      [object]
         */
        public function getMembreId() {
            return $this->membre_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         * @param       [numeric] $type_utilisateur_id ,  l'id de le type de utilisateur
         * @return      [object]
         */
        public function getTypeUtilisateur() {
            return $this->type_utilisateur_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         * @param       [string] $nom, le nom d'un membre
         * @return      [object]
         */
        public function getNom() {
            return $this->nom;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         * @param       [string] $prenom, le prénom d'un membre
         * @return      [object]
         */
        public function getPrenom() {
            return $this->prenom;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         * @param       [string] $mot_de_passe, le mot de passe d'un memebre
         * @return      [object]
         */
        public function getMotDePasse() {
            return $this->mot_de_passe;
        }


        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         * @param       [string] $adresse, l'adresse' d'un memebre
         * @return      [object]
         */
        public function getAdresse() {
            return $this->adresse;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         * @param       [string] $telephone, le téléphone d'un memebre
         * @return      [object]
         */
        public function getTelephone() {
            return $this->telephone;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         * @param       [string] $courriel, le courriel d'un membre
         * @return      [object]
         */
        public function getCourriel() {
            return $this->courriel;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         * @param       [string] $date_ajout, la date d'ajout du membre
         * @return      [object]
         */
        public function getDateAjout() {
            return $this->date_ajout;
        }

            /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         * @param       [numeric] $evaluation_globale, l'evaluation globale du membre, compilée à partir de chaque évaluation/commentaire d'un jeu du membre
         * @return      [object]
         */
        public function getEvaluationGlobale() {
            return $this->evaluation_globale;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         * @param       [bool] $alerte_email, le membre est ou pas valide
         * @return      [object]
         */
        public function getAlerteEmail() {
            return $this->alerte_email;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         * @param       [bool] $newsletter, le membre est ou pas valide
         * @return      [object]
         */
        public function getNewsletter() {
            return $this->newsletter;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         * @param       [bool] $membre_valide, le membre est ou pas valide
         * @return      [object]
         */
        public function getMembreValide() {
            return $this->membre_valide;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         * @param       [bool] $membre_actif, le membre est ou pas acatif
         * @return      [object]
         */
        public function getMembreActif() {
            return $this->membre_actif;
        }

    }

?>