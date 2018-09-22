<?php
/**
 * @file      ControleurRecherches.php
 * @author    Guilherme Tosin, Marcelo Guzmán
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Définit la classe pour le controleur pour la recherche de jeux
 * @details   Cette classe contrôle la recherche de jeux
 */

    class ControleurRecherches extends BaseControleur
    /**
     * @brief   Méthode qui sera appelée par les controleurs
     * @details Méthode abstraite pour traiter les "cases" des contrôleurs
     * @param   [array] $params La chaîne de requête URL ("query string") captée par le Routeur.php
     * @return  L'acces aux vues,aux données et aux différents messages pour ce contrôleur.
     */
    {
        public function index(array $params)

        {

            $modeleJeu = $this->lireDAO("Jeux");
            $donnees['jeux'] = $modeleJeu->lireDerniersJeux();
            $donnees['derniers'] = $modeleJeu->lireDerniersJeux();


            if (isset($params["action"]))
            {
                switch($params["action"])
                {
                    case "accueil" :
                        $donnees['derniers'] = $modeleJeu->lireDerniersJeux();
                        $this->afficherVues("accueil", $donnees);
                        break;

                    default :
                        $this->afficherVues("accueil", $donnees);
                        break;
                }
            }
            else
            {
                $this->afficherVues("accueil", $donnees);
            }
           
        }
        
    }