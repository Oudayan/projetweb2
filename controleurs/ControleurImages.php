<?php
/**
 * @file      ControleurJeux.php
 * @author    Chunliang He, Guilherme Tosin, Jansy López, Marcelo Guzmán
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Définit la classe pour le controleur jeux
 * @details   Cette classe définit les différentes activités concernant aux jeux
 */

class ControleurImages extends BaseControleur
    /**
     * @brief   Méthode qui sera appelée par les controleurs
     * @details Méthode abstraite pour traiter les "cases" des contrôleurs
     * @param   [array] $params La chaîne de requête URL ("query string") captée par le Routeur.php
     * @return  L'acces aux vues,aux données et aux différents messages pour ce contrôleur.
     */
{
    public function index(array $params)
    {
        $modeleJeu = $this->lireDAO("Images");
        $donnees['images'] = $modeleJeu->toutesImages();


        if (isset($params["action"]))
        {
            switch($params["action"])
            {
                case "afficherJeux" :
                    if(isset($params["JeuxId"]))
                    {
                        $donnees['jeux'] = $modeleJeu->lireJeuParId($params["JeuxId"]);
                        $this->afficherVues("jeux", $donnees);
                    }
                    break;

                case "derniers" :

                        $donnees['derniers'] = $modeleJeu->lireDerniersJeux();
                        $this->afficherVues("jeux", $donnees);
                    break;

                default :
                    $this->afficherVues("jeux", $donnees);
                    break;
            }
        }
        else
        {
            $this->afficherVues("jeux", $donnees);
        }

    }

}