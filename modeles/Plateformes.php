<?php
/**
 * @file    Plateformes.php
 * @author  Guilherme Tosin, Marcelo Guzmán
 * @version 1.0
 * @date    Septembre 2018
 * @brief   Définit la classe Jeux
 * @details Cette classe définit les attributs d'un jeu
 */
    class Plateformes {
        //Atributs
        private $plateforme_id;
        private $plateforme;
        private $plateforme_icone;        
        private $plateforme_active;        

        // Constructeur
        public function __construct($plateforme_id = 0, $plateforme = "", $plateforme_icone = "", $plateforme_active = 1)
        {
            $this->setPlateformeId($plateforme_id);
            $this->setPlateforme($plateforme);
            $this->setPlateformeIcone($plateforme_icone);
            $this->setPlateformeActive($plateforme_active);
        }

        //SETTERS

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * @param       [numeric] $plateforme_id, l'id de la plateforme
         * @return      [object]
         */
        public function setPlateformeId($plateforme_id){
            if (is_numeric($plateforme_id) && trim($plateforme_id) != ""){
                $this->plateforme_id = $plateforme_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * @param       [numeric] $plateforme, le nom de la plateforme
         * @return      [object]
         */
        public function setPlateforme($plateforme){
            if (is_string($plateforme) && trim($plateforme) != ""){
                $this->plateforme = $plateforme;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * @param       [numeric] $plateforme_icone, l'icone de la plateforme
         * @return      [object]
         */
        public function setPlateformeIcone($plateforme_icone){
            // if (is_string($plateforme_icone) && trim($plateforme_icone) != ""){
            if (trim($plateforme_icone) != ""){
                $this->plateforme_icone = $plateforme_icone;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * @param       [numeric] $plateforme_active, plateforme active ou non
         * @return      [object]
         */
        public function setPlateformeActive($plateforme_active){
            if (is_numeric($plateforme_active) && trim($plateforme_active) != ""){
                $this->plateforme_active = $plateforme_active;
            }
        }

        // GETTERS

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         * @param       [numeric] $plateforme, l'id de la plateforme
         * @return      [object]
         */
        public function getPlateformeId(){
            return $this->plateforme_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         * @param       [numeric] $plateforme_id, le nom de la plateforme
         * @return      [object]
         */
        public function getPlateforme(){
            return $this->plateforme;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         * @param       [numeric] $plateforme_icone, l'icone de la plateforme
         * @return      [object]
         */
        public function getPlateformeIcone(){
            return $this->plateforme_icone;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         * @param       [numeric] $plateforme_active, plateforme active ou non
         * @return      [object]
         */
        public function getPlateformeActive(){
            return $this->plateforme_active;
        }

    }

?>