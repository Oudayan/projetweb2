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
                    if (isset($_SESSION["id"])) {
                        if (isset($_SESSION["cart"])) {
                                $i = 0;
                            if (isset($params['transaction_id'])) {
                                $transId = $params['transaction_id'];
                            } else {
                                $transId = "Comptant";
                            }
                            foreach ($_SESSION["cart"] as $jeux) {
                                if ($jeux->getLocation()) {
                                    // Sauvegarde d'une location
                                    if (isset($_SESSION["datesLocation"][$i])) {
                                        $dates = explode(" au ", $_SESSION["datesLocation"][$i]);
                                        // ($location_id = 0, $type_paiement_id = 0, $membre_id = 0, $jeux_id = 0, $date_debut = "", $date_retour = "", $transaction_id = "")
                                        $location = new Location(0, '3', $_SESSION["id"], $jeux->getJeuxId(), $dates[0], $dates[1], $transId);
                                        $modeleLocation->sauvegarde($location);
                                    }
                                } else {
                                    // Sauvegarde d'un achat
                                    (string) $date = date("Y-m-d");
                                    // ($achat_id = 0, $type_paiement_id= 0, $membre_id = 0, $jeux_id = 0, $date_achat = "", $transaction_id = "")
                                    $achat = new Achat(0, '3', $_SESSION["id"], $jeux->getJeuxId(), $date, $transId);
                                    $modeleAchat->sauvegarde($achat);
                                    // Bannir le jeu pour qu'il n'apparaisse plus dans les jeux disponibles
                                    $modeleJeux->bannirJeu($jeux->getJeuxId());
                                }
                                $i++;
                            }
                            $i = 0;
                            // Vider le panier d'achat
                            foreach ($_SESSION["cart"] as $jeux) {
                                array_splice($_SESSION["cart"], $i, 1);
                                array_splice($_SESSION["cartImages"], $i, 1);
                                array_splice($_SESSION["quantite"], $i, 1);
                                array_splice($_SESSION["prix"], $i, 1);
                                if ($jeux->getLocation()) {
                                    array_splice($_SESSION["datesLocation"], $i, 1);
                                }
                                $i++;
                            }
                            $_SESSION["prixTotal"] = 0;
                            $_SESSION['msg'] = "Succès!";
                            $this->afficherVues("achat");
                        } else {
                            $_SESSION['msg'] = "Il n'y a aucun item dans le panier d'achat.";
                        }
                    } else {
                        $_SESSION['msg'] = "Vous devez vous connecter pour effectuer une transaction.";
                    }
                    break;

                case "ajouterAuPanier" :
                    if (isset($params['jeux_id'])) {
                        $jeu = $modeleJeux->lireJeuParId($params['jeux_id']);
                        if ($jeu->getJeuxValide() && $jeu->getJeuxActif() && !$jeu->getJeuxBanni()) {
                            if ($jeu->getLocation()) {
                                // Ajout du jeu loué au panier d'achats
                                if (isset($params['dates'])) {
                                    // Vérifer que la date de début est plus petite que la date de retour
                                    $dates = explode(" au ", $params['dates']);
                                    if ($dates[0] <= $dates[1]) {
                                        // Vérifier si le jeu est disponible
                                        $locations = $modeleLocation->lireLocationsParJeuxId($params["jeux_id"]);
                                        $disponible = true;
                                        foreach ($locations as $location) {
                                            // Vérifer que la date de début et retour ne soient pas dans une plage de location non-disponible
                                            if ((strtotime($dates[0]) >= strtotime($location->getDateDebut()) && strtotime($dates[0]) <= strtotime($location->getDateRetour())) || (strtotime($dates[1]) >= strtotime($location->getDateDebut()) && strtotime($dates[1]) <= strtotime($location->getDateRetour()))) {
                                                $disponible = false;
                                            }
                                            // Vérifer que la date de début et retour d'une plage de location non-disponible ne soient pas dans la plage de location demandée
                                            if ((strtotime($location->getDateDebut()) >= strtotime($dates[0]) && strtotime($location->getDateDebut()) <= strtotime($dates[1])) || (strtotime($location->getDateRetour()) >= strtotime($dates[0]) && strtotime($location->getDateRetour()) <= strtotime($dates[1]))) {
                                                $disponible = false;
                                            }
                                            // Vérifier les dates en session contre les dates de disponibilités pour empêcher qu'un jeu soit mis plusieurs fois dans le panier
                                            if (isset($_SESSION["datesLocation"]) && $params['jeux_id'] == $location->getJeuxId()) {
                                                foreach($_SESSION["datesLocation"] as $locationPanier) {
                                                    $datesPanier[] = explode(" au ", $params['dates']);
                                                    if ((strtotime($datesPanier[0]) >= strtotime($location->getDateDebut()) && strtotime($datesPanier[0]) <= strtotime($location->getDateRetour())) || (strtotime($datesPanier[1]) >= strtotime($location->getDateDebut()) && strtotime($datesPanier[1]) <= strtotime($location->getDateRetour()))) {
                                                        $disponible = false;
                                                    }
                                                }
                                            }
                                            
                                        }
                                        if ($disponible) {
                                            $quantite = floor((strtotime($dates[1]) - strtotime($dates[0])) / (60 * 60 * 24)) + 1;
                                            // Mettre les dates de locations en Session
                                            $_SESSION["datesLocation"][] = $params['dates'];
                                            // Ajout du jeu loué au panier d'achats
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
                                // Réserver le jeu en le mettant inactif pour empêcher qu'il mis plusieurs fois dans le panier d'achat
                                $modeleJeux->desactiverJeu($params['jeux_id']);
                                // Ajout du jeu acheté au panier d'achats
                                $this->addToCart($jeu, 1);
                            }
                        } else {
                            $_SESSION['msg'] = "Ce jeu n'est pas disponible en ce moment.";
                        }
                    } else {
                        $_SESSION['msg'] = "Veuillez sélectionner un jeu.";
                    }
                    $this->afficherVues("panier", $donnees, false);
                    break;

                case "supprimer" :
                    if (isset($params['jeux_id'])) {
                        $i = 0;
                        foreach ($_SESSION["cart"] as $jeux) {
                            if ($jeux->getJeuxId() == $params['jeux_id']) {
                                array_splice($_SESSION["cart"], $i, 1);
                                array_splice($_SESSION["cartImages"], $i, 1);
                                array_splice($_SESSION["quantite"], $i, 1);
                                $_SESSION["prixTotal"] -= $_SESSION["prix"][$i];
                                array_splice($_SESSION["prix"], $i, 1);
                                array_splice($_SESSION["datesLocation"], $i, 1);
                                break;
                            }
                            $i++;
                        }
                        // Rendre le jeu disponible
                        $modeleJeux->activerJeu($params['jeux_id']);
                    } else {
                        $_SESSION['msg'] = "Veuillez sélectionner un jeu.";
                    }
                    $this->afficherVues("panier", $donnees, false);
                    break;

                    case "supprimerAchat" :
                    if (isset($params['jeux_id'])) {
                        $i = 0;
                        foreach ($_SESSION["cart"] as $jeux) {
                            if ($jeux->getJeuxId() == $params['jeux_id']) {
                                array_splice($_SESSION["cart"], $i, 1);
                                array_splice($_SESSION["cartImages"], $i, 1);
                                array_splice($_SESSION["quantite"], $i, 1);
                                $_SESSION["prixTotal"] -= $_SESSION["prix"][$i];
                                array_splice($_SESSION["prix"], $i, 1);
                                if (isset($_SESSION["datesLocation"])) {
                                    array_splice($_SESSION["datesLocation"], $i, 1);
                                }
                                break;
                            }
                            $i++;
                        }
                    } else {
                        $_SESSION['msg'] = "Veuillez sélectionner un jeu.";
                    }
                    $this->afficherVues("achat");
                    break;

                    default:
                    $this->afficherVues("achat");
            }
        } else {
            header("location:index.php");
        }
    }

    private function addToCart(Jeux $jeu, $quantite) {
        // Ajouter le jeu au panier
        array_push($_SESSION["cart"], $jeu);
        // Ajouter l'image du jeu au panier
        $modeleImages = $this->lireDAO("Images");
        if ($modeleImages->lireImageParJeuxId($jeu->getJeuxId())) {
            $_SESSION['cartImages'][] = $modeleImages->lireImageParJeuxId($jeu->getJeuxId());
        } else {
            $_SESSION['cartImages'][] = new Images(0, $jeu->getJeuxId(), 'images/image_defaut.png');
        }
        // Ajouter la quantité et prix et le prix total au panier
        $prix = $jeu->getPrix() * $quantite;
        $_SESSION["quantite"][] = $quantite;
        $_SESSION["prix"][] = $prix;
        $_SESSION["prixTotal"] += $prix;
    }

}
