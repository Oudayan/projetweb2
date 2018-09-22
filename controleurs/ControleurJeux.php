<?php
/**
 * @file      ControleurJeux.php
 * @author    Chunliang He, Guilherme Tosin, Jansy López, Marcelo Guzmán
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Définit la classe pour le controleur jeux
 * @details   Cette classe définit les différentes activités concernant aux jeux
 */

    class ControleurJeux extends BaseControleur
    {
        /**
         * @brief   Méthode qui sera appelée par les controleurs
         * @details Méthode pour évaluer les "cases" du contrôleurs
         * @param   [array] $params La chaîne de requête URL ("query string") captée par le fichier Routeur.php
         * @return  L'acces aux vues, aux donnes
         */

        public function index(array $params)
        {
            $modeleJeu = $this->lireDAO('Jeux');
            // $donnees['jeux'] = $modeleJeu->lireJeuParId();
            if (isset($params["action"]))
            {
                switch($params["action"])
                {
                    case "afficherJeux" :
                        if(isset($params["JeuxId"]))
                        {
                            $donnees["jeux"] = $modeleJeu->lireJeuParId($params["JeuxId"]);
                            $this->afficherVues("jeux", $donnees);
                        }
                    break;
                    default:
                        trigger_error($params["action"]. " Action invalide.");
                }
            }
            else
            {
                header("Location: index.php");
            }
        }
    }