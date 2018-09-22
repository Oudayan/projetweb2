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

        if (isset($params["action"]))
        {
            switch($params["action"])
            {
                case "jeux" :
                    $donnees['jeux'] = $modeleJeu->lireDerniersJeux();
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