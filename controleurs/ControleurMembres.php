<?php
/**
 * @file      ControleurMembres.php
 * @author    Chunliang He, Guilherme Tosin, Jansy López, Marcelo Guzmán, Oudayan Dutta
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

    public function index(array $params) {

        $modeleJeux = $this->lireDAO("Jeux");
        $modeleImages = $this->lireDAO("Images");
        $modeleMembres = $this->lireDAO("Membres");
        $modelePlateformes = $this->lireDAO("Plateformes");
        $modeleCategoriesJeux = $this->lireDAO("CategoriesJeux");
        $modeleCommentaireJeux = $this->lireDAO("CommentaireJeux");
        $modeleCategories = $this->lireDAO("Categories");

        $donnees["erreur"] = "";
        $_SESSION["msg"] = "";

        if (isset($params["action"])) {

            switch ($params["action"]) {

                case "afficherMembre":
                    $donnees['derniers'] = $modeleJeux->lireDerniersJeux();
                    $donnees['images'] = $modeleImages->lireDerniersImages();
                    $this->afficherVues("accueil", $donnees);
                    break;

                case "formAjoutMembre":
                    $modeleJeux = $this->lireDAO("Jeux");
                    $donnees['trois'] = $modeleJeux->lireDerniersJeux(3);
                    $donnees = $this->chercherImages($donnees, "trois", "Trois");
                    $this->afficherVues("ajoutMembre", $donnees);
                    break;

                case "formModifierMembre":
                    $donnees = $this->formModifierMembre($params);
                    $this->afficherVues("ajoutMembre", $donnees);
                    break;

                case "enregistrerMembre" :
                    $this->sauvegarderMembre($params);
                    header("location:index.php");
                    break;

                case "verifierLogin" :
                    if (isset($params["courriel"]) && isset($params["mot_de_passe"])) {
                        $modeleMembres = $this->lireDAO("Membres");
                        $donnees = $modeleMembres->obtenirParCourriel($params["courriel"]);
                        if ($donnees) {
                            // Comparaison entre les données reçues et ceux de la BD
                            if ($donnees->getCourriel() == $params["courriel"]  && $donnees->getMotDePasse() == md5($params["mot_de_passe"] )) {
                                if($donnees->getMembreValide() == 1 ) {
                                    if($donnees->getMembreActif() == 1 ) {
                                        $_SESSION["id"] = $donnees->getMembreId();
                                        $_SESSION["courriel"] = $params["courriel"];
                                        $_SESSION["type"] = $donnees->getTypeUtilisateur();
                                        $_SESSION["cart"] = [];
                                        $_SESSION["cartImages"] = [];
                                        $_SESSION["msg"] = "Bienvenue ! " . $donnees->getPrenom() . " ";
                                        $_SESSION['prenom'] = $donnees->getPrenom();
                                        $_SESSION['nomComplet'] = $donnees->getPrenom() . " " . $donnees->getNom();
                                        $_SESSION["prixTotal"] = 0;
                                    }
                                    else {
                                        $_SESSION["msg"] = "Vous êtes présentement bannis du site. Veuillez contacter l'administrateur pour plus de détails.";
                                    }
                                }
                                else {
                                    $_SESSION["msg"] = "Votre compte n'est pas encore activé. Vous serez contacté par l'administrateur quand votre compte sera validé.";
                                }
                            }
                            else {
                                $_SESSION["msg"] = "Le courriel ou le mot de passe ne sont pas corrects.";
                            }
                        }
                        else {
                            $_SESSION["msg"] = "Ce courriel n'existe pas dans la base de données.";
                        }
                    }
                    else {
                        $_SESSION["msg"] = "Veuillez remplir le courriel et le mot de passe !";
                    }
                    // Redirection selon type de membre
                    if(isset($_SESSION["type"]) && $_SESSION["type"] == 1) {
                        header("location:index.php?Jeux&action=gererMesJeux");
                    }
                    else if (isset($_SESSION["type"]) && ($_SESSION["type"] == 3 || $_SESSION["type"] == 4)) {
                        header("location:index.php?Admin&action=afficherAdmin");
                    }
                    else {
                        header("location:index.php");
                    }
                    break;

                case  "logout":
                    if (isset($_SESSION["id"])) {
                        unset($_SESSION["id"]);
                        setcookie("id", null, -1, '/');
                    }
                    if (isset($_SESSION["courriel"])) {
                        unset($_SESSION["courriel"]);
                        setcookie("courriel", null, -1, '/');
                    }
                    if (isset($_SESSION["type"])) {
                        unset($_SESSION["type"]);
                        setcookie("type", null, -1, '/');
                    }
                    if (isset($_SESSION["msg"])) {
                        unset($_SESSION["msg"]);
                        setcookie("msg", null, -1, '/');
                    }
                    if (isset($_SESSION["cart"])) {
                        unset($_SESSION["cart"]);
                        setcookie("cart", null, -1, '/');
                    }
                    if (isset($_SESSION["cartImages"])) {
                        unset($_SESSION["cartImages"]);
                        setcookie("cartImages", null, -1, '/');
                    }
                    if (isset($_SESSION["quantite"])) {
                        unset($_SESSION["quantite"]);
                        setcookie("quantite", null, -1, '/');
                    }
                    if (isset($_SESSION["prix"])) {
                        unset($_SESSION["prix"]);
                        setcookie("prix", null, -1, '/');
                    }
                    if (isset($_SESSION["prixTotal"])) {
                        unset($_SESSION["prixTotal"]);
                        setcookie("prixTotal", null, -1, '/');
                    }
                    if (isset($_SESSION["datesLocation"])) {
                        unset($_SESSION["datesLocation"]);
                        setcookie("datesLocation", null, -1, '/');
                    }
                    unset($_SESSION);
                    header("location:index.php");
                    break;

                default:
                    header("location:index.php");
            }
        } else {
            header("location:index.php");
        }
    }

}