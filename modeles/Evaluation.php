<?php
/**
 * @file    Evaluation.php
 * @author  Oudayan Dutta
 * @version 1.0
 * @date    Octobre 2018
 * @brief   Définit la classe Evaluation
 * @details Cette classe définit les attributs d'un type de l'évaluation de jeu
 */

    class Evaluation {
        //Atributs
        private $evaluation_id;
        private $jeton;
        private $jeux_id;
        private $membre_id;
        private $achat_id;
        private $location_id;
        private $commentaire_jeu;
        private $commentaire_membre;
        private $evaluation_jeu;
        private $evaluation_membre;
        private $date_evaluation;
        private $evaluation_jeu_active;
        private $evaluation_membre_active;

        // Constructeur
        public function __construct($evaluation_id = 0, $jeton = "", $jeux_id = 0, $membre_id = 0, $achat_id = 0, $location_id = 0, $commentaire_jeu = "", $commentaire_membre = "", $evaluation_jeu = -1, $evaluation_membre = -1, $date_evaluation = "", $evaluation_jeu_active = 1, $evaluation_membre_active = 1) {
            $this->setEvaluationId($evaluation_id); 
            $this->setJeton($jeton);
            $this->setJeuxId($jeux_id);
            $this->setMembreId($membre_id);
            $this->setAchatId($achat_id);
            $this->setLocationId($location_id);
            $this->setCommentaireJeu($commentaire_jeu);
            $this->setCommentaireMembre($commentaire_membre);
            $this->setEvaluationJeu($evaluation_jeu);
            $this->setEvaluationMembre($evaluation_membre);
            $this->setDateEvaluation($date_evaluation);
            $this->setEvaluationJeuActive($evaluation_jeu_active);
            $this->setEvaluationMembreActive($evaluation_membre_active);
        }

        //SETTERS

         /**
         * @brief       Permet de définir en écriture l'attribut de la classe Evaluation
         * @param       [numeric] $membre_id, Setter pour l'id d'une evaluation
         * @return      [object]
         */
        public function setEvaluationId($evaluation_id) {
            if (is_numeric($evaluation_id) && trim($evaluation_id) != "") {
                $this->evaluation_id = $evaluation_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Evaluation
         * @param       [string] $jeton, Setter pour le jeton unique de l'évaluation
         * @return      [object]
         */
        public function setJeton($jeton) {
            if (is_string($jeton) && trim($jeton) != "") {
                $this->jeton = $jeton;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Evaluation
         * @param       [numeric] $jeux_id, Setter pour l'id du jeu évalué
         * @return      [object]
         */
        public function setJeuxId($jeux_id) {
            if (is_numeric($jeux_id) && trim($jeux_id) != "") {
                $this->jeux_id = $jeux_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Evaluation
         * @param       [numeric] $membre_id, Setter pour l'id du membre qui a fait l'évaluation
         * @return      [object]
         */
        public function setMembreId($membre_id) {
            if (is_numeric($membre_id) && trim($membre_id) != "") {
                $this->membre_id = $membre_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Evaluation
         * @param       [numeric] $achat_id, Setter pour l'id de l'achat du jeu
         * @return      [object]
         */
        public function setAchatId($achat_id) {
            if (is_numeric($achat_id) && trim($achat_id) != "") {
                $this->achat_id = $achat_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Evaluation
         * @param       [numeric] $location_id, Setter pour l'id de la location du jeu
         * @return      [object]
         */
        public function setLocationId($location_id) {
            if (is_numeric($location_id) && trim($location_id) != "") {
                $this->location_id = $location_id;
            }
        }

         /**
         * @brief       Permet de définir en écriture l'attribut de la classe Evaluation
         * @param       [string] $commentaire_jeu, Setter pour le commentaire d'un jeu
         * @return      [object]
         */
        public function setCommentaireJeu($commentaire_jeu) {
            if (is_string($commentaire_jeu) && trim($commentaire_jeu) != "") {
                $this->commentaire_jeu = $commentaire_jeu;
            }
        }

         /**
         * @brief       Permet de définir en écriture l'attribut de la classe Evaluation
         * @param       [string] $commentaire_membre, Setter pour le commentaire d'un membre
         * @return      [object]
         */
        public function setCommentaireMembre($commentaire_membre) {
            if (is_string($commentaire_membre) && trim($commentaire_membre) != "") {
                $this->commentaire_membre = $commentaire_membre;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Evaluation
         * @param       [numeric] $evaluation, Setter pour l'evaluation du jeu
         * @return      [object]
         */
        public function setEvaluationJeu($evaluation_jeu) {
            if (is_numeric($evaluation_jeu) && trim($evaluation_jeu) != "") {
                $this->evaluation_jeu = $evaluation_jeu;
            }
        }

         /**
         * @brief       Permet de définir en écriture l'attribut de la classe Evaluation
         * @param       [numeric] $evaluation, Setter pour l'evaluation du membre qui a loué/vendu le jeu
         * @return      [object]
         */
        public function setEvaluationMembre($evaluation_membre) {
            if (is_numeric($evaluation_membre) && trim($evaluation_membre) != "") {
                $this->evaluation_membre = $evaluation_membre;
            }
        }

         /**
         * @brief       Permet de définir en écriture l'attribut de la classe Evaluation
         * @param       [numeric] $date_evaluation, Setter pour la date d'ajout de l'évaluation
         * @return      [object]
         */
        public function setDateEvaluation($date_evaluation) {
            if (is_string($date_evaluation) && trim($date_evaluation) != "") {
                $this->date_evaluation = $date_evaluation;
            }
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Evaluation
         * @param       [string] $evaluation_jeu_active, Setter pour indiquer si l'évaluation du jeu est actif ou annnulé
         * @return      [object]
         */
        public function setEvaluationJeuActive($evaluation_jeu_active) {
            if (is_numeric($evaluation_jeu_active) && trim($evaluation_jeu_active) != "") {
                $this->evaluation_jeu_active = $evaluation_jeu_active;
            }
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Evaluation
         * @param       [string] $evaluation_membre_active, Setter pour indiquer si l'évaluation du jeu est actif ou annnulé
         * @return      [object]
         */
        public function setEvaluationMembreActive($evaluation_membre_active) {
            if (is_numeric($evaluation_membre_active) && trim($evaluation_membre_active) != "") {
                $this->evaluation_membre_active = $evaluation_membre_active;
            }
        }


        // GETTERS

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Evaluation
         * @param       [numeric] $evaluation_id, Getter pour l'id de l'évaluation
         * @return      [object]
         */
        public function getEvaluationId() {
            return $this->evaluation_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Evaluation
         * @param       [string] $jeton, Getter pour le jeton unique d'un évaluation
         * @return      [object]
         */
        public function getJeton() {
            return $this->jeton;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Evaluation
         * @param       [numeric] $jeux_id, Getter pour l'id du jeu commenté
         * @return      [object]
         */
        public function getJeuxId() {
            return $this->jeux_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Evaluation
         * @param       [string] $membre_id, Getter pour l'id de membre qui fait l'évaluation
         * @return      [object]
         */
        public function getMembreId() {
            return $this->membre_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Evaluation
         * @param       [numeric] $achat_id, Getter pour l'id de l'achat du jeu
         * @return      [object]
         */
        public function getAchatId() {
            return $this->achat_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Evaluation
         * @param       [numeric] $location_id, Getter pour l'id de la location du jeu
         * @return      [object]
         */
        public function getLocationId() {
            return $this->location_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Evaluation
         * @param       [string] $commentaire_jeu, Getter pour le commentaire du jeu
         * @return      [object]
         */
        public function getCommentaireJeu() {
            return $this->commentaire_jeu;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Evaluation
         * @param       [string] $commentaire_membre, Getter pour le commentaire du membre
         * @return      [object]
         */
        public function getCommentaireMembre() {
            return $this->commentaire_membre;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Evaluation
         * @param       [string] $evaluation, Getter pour l'évaluation du jeu
         * @return      [object]
         */
        public function getEvaluationJeu() {
            return $this->evaluation_jeu;
        }

         /**
         * @brief       Permet de définir en lecture l'attribut de la classe Evaluation
         * @param       [string] $evaluation, Getter pour l'évaluation du membre qui loue/vend le jeu
         * @return      [object]
         */
        public function getEvaluationMembre() {
            return $this->evaluation_membre;
        }

         /**
         * @brief       Permet de définir en lecture l'attribut de la classe Evaluation
         * @param       [string] $date_evaluation, Getter pour la date d'ajout du évaluation
         * @return      [object]
         */
        public function getDateEvaluation() {
            return $this->date_evaluation;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Evaluation
         * @param       [string] $evaluation_jeu_active, Getter pour indiquer si l'évaluation du jeu est active ou annnulé
         * @return      [object]
         */
        public function getEvaluationJeuActive() {
            return $this->evaluation_jeu_active;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Evaluation
         * @param       [string] $evaluation_membre_active, Getter pour indiquer si l'évaluation du membre est active ou annnulé
         * @return      [object]
         */
        public function getEvaluationMembreActive() {
            return $this->evaluation_membre_active;
        }

    }
