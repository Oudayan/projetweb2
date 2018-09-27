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
        if (isset($params["action"])) {

            switch ($params["action"]) {

                case "ajouterUnMembre": // Tourner a la page de la formulaire de s`inscrire
                    $this->afficherVues("ajouteUnMembre");
                    break;

                case "enregistrerMembre" :

                    if (!isset($params["nom"]) || !isset($params["prenom"]) || !isset($params["mot_de_passe"]) || !isset($params["adresse"]) || !isset($params["telephone"]) || !isset($params["courriel"])) {
                        echo "Remplissez tous les champs...";
                    } else {

                        $modeleMembres = $this->lireDAO("Membres");
                        $enregistrement["Membre"] = new Membres(null, $params["type_utilisateur_id"], $params["nom"], $params["prenom"], $params["mot_de_passe"], $params["adresse"], $params["telephone"], $params["courriel"], false, true);
                        $succes = $modeleMembres->sauvegarde($enregistrement["Membre"]);

                        $_SESSION["succes"] = "Vous avez devenu membre de notre site";
                        $this->afficherVues("message");
                    }
                    break;
//
                case "verifierLogin" :
                    {
                        if (isset($params["courriel"]) && isset($params["MotDePasse"])) {
                            $modeleMembres = $this->lireDAO("Membres");
                            $donnees = $modeleMembres->obtenirParCourriel($params["courriel"]);

                            // Comparaison entre les données reçues et ceux de la BD
                            if ($donnees && $donnees->lireCourriel() == $params["courriel"] && $donnees->lireMotDePasse() == $params["MotDePasse"]) {
                                $_SESSION["courriel"] = $params["courriel"];
                                $_SESSION["prenom"] = $donnees->lirePrenom();
                                $_SESSION["succes"] = "Bienvenue ! " . $_SESSION["prenom"] . " ";
                            } else {
                                var_dump("Le mot de passe ou le courriel ne sont pas corrects");
                                $_SESION["erreur"] = "Le courriel ou le mot de passe ne sont pas corrects";
                            }
                        }
                    }
                    break;



                default:
                    trigger_error($params["action"] . " Action invalide.");
            }
        } else {
            var_dump("No");
        }
    }
}