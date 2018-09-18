<?php
/**
 * @file      ControleurMembres.php
 * @author    Chunliang He, Guilherme Tosin, Jansy López, Marcelo Guzmán
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Définit la classe pour le controleur membres
 * @details   Cette classe définit les différentes activités concernant aux membres inscrits sur le site
 */

    class ControleurMembres extends BaseControleur
    {
        /**
         * @brief   Méthode qui sera appelée par les controleurs
         * @details Méthode pour évaluer les "cases" du contrôleurs
         * @param   [array] $params La chaîne de requête URL ("query string") captée par le fichier Routeur.php
         * @return  L'acces aux vues, aux donnes
         */

        public function index(array $params)
        {
            // if (isset($params["action"]))
        }
    }