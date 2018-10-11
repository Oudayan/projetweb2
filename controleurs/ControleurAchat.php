<?php

/**
 * @file      ControleurMembres.php
 * @author    Chunliang He, Guilherme Tosin, Jansy López, Marcelo Guzmán
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Définit la classe pour le controleur membres
 * @details   Cette classe définit les différentes activités concernant aux membres inscrits sur le site
 */
class ControleurAchat extends BaseControleur {

    /**
     * @brief   Méthode qui sera appelée par les controleurs
     * @details Méthode pour évaluer les "cases" du contrôleurs
     * @param   [array] $params La chaîne de requête URL ("query string") captée par le fichier Routeur.php
     * @return  L'acces aux vues, aux donnes
     */
    public function index(array $params) {
        $modeleJeux = $this->lireDAO("Jeux");
        $modeleImages = $this->lireDAO("Images");
        $modeleAchat = $this->lireDAO("Achat");
        $modeleLocation = $this->lireDAO("Location");

        $donnees["erreur"] = "";
        $_SESSION["msg"] = "";

        if (isset($params["action"])) {

            switch ($params["action"]) {

                case "afficherPanier" :
                    $this->afficherVues("achat");
                    break;

                case "payerPanier" :
                    if (isset($_SESSION["id"]) && isset($_SESSION["cart"])) {
                        foreach ($_SESSION["cart"] as $jeux) {
                            if ($jeux->getLocation() == 1) {
                                if (isset($_SESSION["datesLocation"])) {
                                    $dates = explode(" au ", $_SESSION["datesLocation"]);
                                    // ($location_id = 0, $type_paiement_id = "", $membre_id = "", $jeux_id = "", $date_debut = "", $date_retour = "")
                                    $location = new Location(0, '3', $_SESSION["id"], $jeux->getJeuxId(), $dates[0], $dates[1]);
                                    $$modeleLocation->sauvegarde($location);
                                }
                            } else {
                                (string) $date = date("Y-m-d");
                                // ($achat_id = 0, $type_paiement_id= 0, $membre_id = 0, $jeux_id = 0, $date_achat = "", $transaction_id = "")
                                $achat = new Achat(0, '3', $_SESSION["id"], $jeux->getJeuxId(), $date, $params['transaction_id']);
                                $modeleAchat->sauvegarde($achat);
                            }
                        }
                        $i = 0;
                        foreach ($_SESSION["cart"] as $jeux) {
                            array_splice($_SESSION["cart"], $i, 1);
                            array_splice($_SESSION["cartImages"], $i, 1);
                            $i++;
                        }
                        echo "success";
                    }
                    break;

                    case "ajouterAuPanier" :
                    if (isset($params['jeux_id'])) {
                        $jeu = $modeleJeux->lireJeuParId($params['jeux_id']);
                        if ($jeu->getLocation()) {
                            // Ajout du jeu loué au panier d'achats
                            if (isset($params['dates'])) {
                                // Effacer les anciennes dates de locations pour ajouter les nouvelles
                                $_SESSION["datesLocation"][] = $params['dates'];
                                // Vérifer que la date de début est plus petite que la date de retour
                                $dates = explode(" au ", $params['dates']);
                                if ($dates[0] <= $dates[1]) {
                                    // Vérifier si le jeu est disponible
                                    $_SESSION["test"] = "date debut avannt date retour";
                                    $locations = $modeleLocation->lireLocationsParJeuxId($params["JeuxId"]);
                                    $disponible = true;
                                    foreach ($locations as $location) {
                                        if (($dates[0] >= $location->getDateDebut() && $dates[0] <= $location->getDateRetour()) || ($dates[1] >= $location->getDateDebut() && $dates[1] <= $location->getDateRetour())) {
                                            $disponible = false;
                                        }
                                    }
                                    if ($disponible) {
                                        $dateR = strtotime($dates[1]);
                                        $dateD = strtotime($dates[0]);
                                        $datediff = $dateR - $dateD;
                                        $quantite = floor($datediff / (60 * 60 * 24)) + 1;
                                        $_SESSION["test"] = $quantite;
                                        $this->addToCart($jeu, $quantite);
                                    }
                                    else {
                                        $_SESSION['msg'] = "Ce jeu n'est pas disponible entre ces dates.";
                                    }
                                } else {
                                    $_SESSION['msg'] = "La date de retour ne peut pas être avant la date de début de location.";
                                }
                            } else {
                                $_SESSION['msg'] = "Veuillez sélectionner un jeu et des dates de location.";
                            }
                        } else {
                            // Ajout du jeu acheté au panier d'achats
                            $this->addToCart($jeu, 1);
                        }
                    } else {
                        $_SESSION['msg'] = "Veuillez sélectionner un jeu.";
                    }
                    //var_dump($_SESSION['msg']);
                    break;

                    // case "acheter" :
                    // if (isset($params['jeux_id'])) {
                    //     $jeuxAchete = $modeleJeux->lireJeuParId($params['jeux_id']);
                    //     array_push($_SESSION["cart"], $jeuxAchete);
                    //     $imageJeuxAchete = $modeleImages->lireImagesParJeuxId($params["jeux_id"]);
                    //     array_push($_SESSION["cartImages"], $imageJeuxAchete[0]->getCheminPhoto());
                    //     echo sizeof($_SESSION["cart"]);
                    // } else {
                    //     $_SESSION['msg'] = "Veuillez sélectionner un jeu.";
                    //     var_dump($_SESSION['msg']);
                    // }
                    // break;

                case "supprimer" :
                    if (isset($params['jeux_id'])) {
                        $i = 0;
                        foreach ($_SESSION["cart"] as $jeux) {
                            if ($jeux->getJeuxId() == $params['jeux_id']) {
                                array_splice($_SESSION["cart"], $i, 1);
                                array_splice($_SESSION["cartImages"], $i, 1);
                                array_splice($_SESSION["quantite"], $i, 1);
                                array_splice($_SESSION["prix"], $i, 1);
                                break;
                            }
                            $i++;
                        }
                        echo sizeof($_SESSION["cart"]);
                    } else {
                        $_SESSION['msg'] = "Veuillez sélectionner un jeu.";
                        var_dump($_SESSION['msg']);
                    }
                    break;

                default:
                    trigger_error($params["action"] . " Action invalide.");
            }
        } else {
            $_SESSION['msg'] = "Erreur";
        }
    }

    private function addToCart(Jeux $jeu, $quantite) {
        // Ajouter le jeu au panier
        array_push($_SESSION["cart"], $jeu);
        // Ajouter l'image du jeu au panier
        $modeleImages = $this->lireDAO("Images");
        if ($modeleImages->lireImageParJeuxId($jeu->getJeuxId()))
        {
            $_SESSION['cartImages'][] = $modeleImages->lireImageParJeuxId($jeu->getJeuxId());
        }
        else
        {
            $_SESSION['cartImages'][] = new Images(0, $jeu->getJeuxId(), 'images/image_defaut.png');
        }
        // Ajouter la quantité et prix et le prix total au panier
        $_SESSION["quantite"][] = "test" + $quantite;
        $prix = number_format($jeu->getPrix() * $quantite, 2);
        $_SESSION["prix"] = "test" + $prix;
        $_SESSION["prixTotal"] += $prix;
        echo sizeof($_SESSION["cart"]);
    }

}
