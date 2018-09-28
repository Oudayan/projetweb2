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
        $donnees["erreur"] = "";

        if (isset($params["action"])) {

            switch ($params["action"]) {

//                case "ajouterUnMembre": // Tourner a la page de la formulaire de s`inscrire
//                    $this->afficherVues("ajouteUnMembre");
//                    break;

                case "enregistrerMembre" :

                    if (isset($params["nom"]) && isset($params["prenom"]) && isset($params["mot_de_passe"]) && isset($params["adresse"]) && isset($params["telephone"]) && isset($params["courriel"])) {


                        $modeleMembres = $this->lireDAO("Membres");
                        $enregistrement["Membre"] = new Membres(null, $params["type_utilisateur_id"], $params["nom"], $params["prenom"], $params["mot_de_passe"], $params["adresse"], $params["telephone"], $params["courriel"], false, true);
                        $succes = $modeleMembres->sauvegarde($enregistrement["Membre"]);

                        $_SESSION["msg"] = "Vous avez devenu membre de notre site";
//                        header("location:index.php");

                    } else {

                        $_SESSION["msg"] ="Remplissez tous les champs...";
//                        $this->afficherVues("ajouteUnMembre");
                    }
                    header("location:index.php");
                    break;
//
                case "verifierLogin" :
                    {
//                        var_dump($_POST);
//                        echo $params["courriel"];
                        
                        if (isset($params["courriel"]) && isset($params["mot_de_passe"])) {
                            $modeleMembres = $this->lireDAO("Membres");
                            $donnees = $modeleMembres->obtenirParCourriel($params["courriel"]);

                            var_dump($donnees);
                            if ($donnees) {
                                // Comparaison entre les données reçues et ceux de la BD
                                if ($donnees->getCourriel() == $params["courriel"]  && $donnees->getMotDePasse() == $params["mot_de_passe"]) {
                                    $_SESSION["id"] = $donnees->getMembreId();
                                    $_SESSION["courriel"] = $params["courriel"];
                                    $_SESSION["type"] = $donnees->getTypeUtilisateur();
//                                    $_SESSION["msg"] = "Bienvenue ! " . $donnees->getPrenom() . " ";
                                    $_SESSION['prenom'] = $donnees->getPrenom();
                                }
                            } else {
//                                var_dump("Le mot de passe ou le courriel ne sont pas corrects");
                                $_SESSION["msg"] = "Le courriel ou le mot de passe ne sont pas corrects";
                            }
                        }  else {
                            $_SESSION["msg"] = "Veuillez remplir le courriel et le mot de passe!";
                        }

                        header("location:index.php");
                    }
                    break;

                case  "logout":
                    if (isset($_SESSION["id"])) {
                        unset($_SESSION["id"]);
                        setcookie("id",null,-1,'/');
                    }
                    if (isset($_SESSION["courriel"])) {
                        unset($_SESSION["courriel"]);
                        setcookie("courriel",null,-1,'/');
                    }
                    if (isset($_SESSION["type"])) {
                        unset($_SESSION["type"]);
                        setcookie("type",null,-1,'/');
                    }
                    if (isset($_SESSION["msg"])) {
                        unset($_SESSION["msg"]);
                        setcookie("msg",null,-1,'/');
                    }
                    header("location:index.php");
                    break;



                default:
                    trigger_error($params["action"] . " Action invalide.");
            }
        } else {
            var_dump("No");
        }
    }
}