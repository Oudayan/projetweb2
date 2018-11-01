<?php

/**
 * @file      ControleurMembres.php
 * @author    Chunliang He, Guilherme Tosin, Jansy López, Marcelo Guzmán, Oudayan Dutta
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
        $modeleEvaluation = $this->lireDAO("Evaluation");
        $modeleMessagerie = $this->lireDAO("Messagerie");
        $modeleDestinataire = $this->lireDAO("Destinataire");

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
                            if (isset($params['transaction_id'])) {
                                $transId = $params['transaction_id'];
                            } else {
                                $transId = "Paypal";
                            }
                            $i = 0;
                            foreach ($_SESSION["cart"] as $jeux) {
                                // Création d'un jeton pour commentaire et évaluation unique
                                $transaction = false;
                                $jeton = $this->creerJeton(25);
                                (string) $date = date("Y-m-d H:i:s");
                                if ($jeux->getLocation()) {
                                    // Sauvegarde d'une location
                                    if (isset($_SESSION["datesLocation"][$i])) {
                                        $dates = explode(" au ", $_SESSION["datesLocation"][$i]);
                                        // ($location_id = 0, $type_paiement_id = 0, $membre_id = 0, $jeux_id = 0, $date_location = "", $date_debut = "", $date_retour = "", $transaction_id = "", $location_active = 1)
                                        $location = new Location(0, 1, $_SESSION["id"], $jeux->getJeuxId(), $date, $dates[0], $dates[1], $transId, 1);
                                        $location_id = $modeleLocation->sauvegarde($location);
                                        $achat_id = NULL;
                                        $transaction = true;
                                    }
                                } else {
                                    // Sauvegarde d'un achat
                                    // ($achat_id = 0, $type_paiement_id= 0, $membre_id = 0, $jeux_id = 0, $date_achat = "", $transaction_id = "", $achat_actif = 1)
                                    $achat = new Achat(0, 1, $_SESSION["id"], $jeux->getJeuxId(), $date, $transId, 1);
                                    $achat_id = $modeleAchat->sauvegarde($achat);
                                    // Activer la vente du jeu pour qu'il n'apparaisse plus dans les jeux disponibles
                                    $modeleJeux->activerVente($jeux->getJeuxId());
                                    $location_id = NULL;
                                    $transaction = true;
                                }
                                $i++;
                                if ($transaction) {
                                    // ($evaluation_id = 0, $jeton = "", $jeux_id = 0, $membre_id = 0, $achat_id = 0, $location_id = 0, $commentaire_jeu = "", $commentaire_membre = "", $evaluation_jeu = -1, $evaluation_membre = -1, $date_evaluation = "", $evaluation_jeu_active = 1, $evaluation_membre_active = 1)
                                    $evaluation = new Evaluation(0, $jeton, $jeux->getJeuxId(), $_SESSION["id"], $achat_id, $location_id, NULL, NULL, -1, -1, $date, 1, 1);
                                    $modeleEvaluation->sauvegarde($evaluation);
                                    // ($msg_id = "", $membre_id = "", $sujet = "", $message = "", $attachement = "", $msg_date = "", $msg_envoye = 0, $msg_lu = 0, $msg_actif = 1)
                                    $message = new Messagerie(0, $jeux->getMembreId(), "Évaluation de " . ($jeux->getLocation() == 1 ? "la location" : "l'achat") . " du jeu " . $jeux->getTitre(), "<a href='index.php?Evaluation&action=afficherEvaluation&jeton=" . $jeton . "'>Cliquez ici pour évaluer le jeu</a>", "", $date, 1, 0, 1);
                                    $msg_id = $modeleMessagerie->sauvegarde($message);
                                    $destinataire = new Destinataire($_SESSION["id"], $msg_id);
                                    $modeleDestinataire->sauvegarde($destinataire);
                                }
                            }
                            // Vider le panier d'achat
                            unset($_SESSION["cart"]);
                            unset($_SESSION["cartImages"]);
                            unset($_SESSION["quantite"]);
                            unset($_SESSION["prix"]);
                            unset($_SESSION["datesLocation"]);
                            $_SESSION["prixTotal"] = 0;
                            $_SESSION['msg'] = "La transaction a été complétée avec succès!";
                            $this->afficherVues("achat");
                        }
                        else {
                            $_SESSION['msg'] = "Il n'y a aucun item dans le panier d'achat.";
                        }
                    }
                    else {
                        $_SESSION['msg'] = "Vous devez vous connecter pour effectuer une transaction.";
                    }
                    break;

                case "ajouterAuPanier" :
                    $_SESSION["msg"] = "Le panier est vide.";
                    if (isset($params['jeux_id'])) {
                        $jeu = $modeleJeux->lireJeuParId($params['jeux_id']);
                        if ($jeu->getJeuxValide() && $jeu->getJeuxActif() && !$jeu->getJeuxBanni()) {
                            if ($jeu->getLocation()) {
                                // Ajout du jeu loué au panier d'achats
                                if (isset($params['dates'])) {
                                    // Vérifier le format des dates de location (AAAA-MM-JJ au AAAA-MM-JJ)
                                    if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) au (\d{4})-(\d{2})-(\d{2})$/", $params['dates'])) {
                                        $dates = explode(" au ", $params['dates']);
                                        // Vérifier que la date de début de location est valide
                                        if ($this->dateValide($dates[0])) {
                                            // Vérifier que la date de fin de location est valide
                                            if ($this->dateValide($dates[1])) {
                                                // Vérifer que la date de début est plus petite que la date de retour
                                                if (strtotime($dates[0]) <= strtotime($dates[1])) {
                                                    // Vérifier que la date de début de location n'est pas passée la date de fin de location
                                                    if (strtotime($dates[0]) >= strtotime(date("Y-m-d"))) {
                                                        // Vérifier si le jeu est disponible dans la table location
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
                                                        }
                                                        // Vérifier les dates en session contre les dates de location pour empêcher qu'un jeu soit mis plusieurs fois dans le panier aux mêmes dates
                                                        if (isset($_SESSION["datesLocation"]) && isset($_SESSION["cart"])) {
                                                            for ($i = 0; $i < count($_SESSION["datesLocation"]); $i++) {
                                                                if ($params['jeux_id'] == $_SESSION["cart"][$i]->getJeuxId()) {
                                                                    $datesPanier = explode(" au ", $_SESSION["datesLocation"][$i]);
                                                                    if ((strtotime($dates[0]) >= strtotime($datesPanier[0]) && strtotime($dates[0]) <= strtotime($datesPanier[1])) || (strtotime($dates[1]) >=strtotime($datesPanier[0]) && strtotime($dates[1]) <= strtotime($datesPanier[1]))) {
                                                                        $disponible = false;
                                                                    }
                                                                    if ((strtotime($datesPanier[0]) >= strtotime($dates[0]) && strtotime($datesPanier[0]) <= strtotime($dates[1])) || (strtotime($datesPanier[1]) >= strtotime($dates[0]) && strtotime($datesPanier[1]) <= strtotime($dates[1]))) {
                                                                        $disponible = false;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if ($disponible) {
                                                            // Mettre les dates de locations en Session
                                                            $_SESSION["datesLocation"][] = $params['dates'];
                                                            // Calculer la quantité (nombre de jours de location)
                                                            $quantite = floor((strtotime($dates[1]) - strtotime($dates[0])) / (60 * 60 * 24)) + 1;
                                                            // Ajout du jeu loué au panier d'achats
                                                            $this->addToCart($jeu, $quantite);
                                                        }
                                                        else {
                                                            $_SESSION['msg'] = "Ce jeu n'est pas disponible entre ces dates.";
                                                        }
                                                    }
                                                    else {
                                                        $_SESSION['msg'] = "La date de début de location ne peut pas être avant aujourd'hui.";
                                                    }
                                                }
                                                else {
                                                    $_SESSION['msg'] = "La date de retour ne peut pas être avant la date de début de location.";
                                                }
                                            }
                                            else {
                                                $_SESSION['msg'] = "Veuillez entrer une date de fin de location valide.";
                                            }
                                        }
                                        else {
                                            $_SESSION['msg'] = "Veuillez entrer une date de début de location valide.";
                                        }
                                    }
                                    else {
                                        $_SESSION['msg'] = "Veuillez respecter le format de dates suivant : \"AAAA-MM-JJ au AAAA-MM-JJ\"";
                                    }
                                }
                                else {
                                    $_SESSION['msg'] = "Veuillez sélectionner un jeu et des dates de location.";
                                }
                            }
                            // Achat du jeu
                            else {
                                // Réserver le jeu en le mettant inactif pour empêcher qu'il mis plusieurs fois dans le panier d'achat
                                $modeleJeux->desactiverJeu($params['jeux_id']);
                                // Garder en session aujourd'hui comme dates de location
                                $_SESSION["datesLocation"][] = date("Y-m-d") . " au " . date("Y-m-d");
                                // Ajout du jeu acheté au panier d'achats
                                $this->addToCart($jeu, 1);
                            }
                        }
                        else {
                            $_SESSION['msg'] = "Ce jeu n'est pas disponible en ce moment.";
                        }
                    }
                    else {
                        $_SESSION['msg'] = "Veuillez sélectionner un jeu.";
                    }
                    $this->afficherVues("panier", $donnees, false);
                    break;

                case "supprimer" :
                    if (isset($params['jeux_id']) && isset($_SESSION["cart"])) {
                        $i = 0;
                        foreach ($_SESSION["cart"] as $jeux) {
                            if ($jeux->getJeuxId() == $params['jeux_id']) {
                                array_splice($_SESSION["cart"], $i, 1);
                                array_splice($_SESSION["cartImages"], $i, 1);
                                array_splice($_SESSION["quantite"], $i, 1);
                                $_SESSION["prixTotal"] -= $_SESSION["prix"][$i];
                                array_splice($_SESSION["prix"], $i, 1);
                                array_splice($_SESSION["datesLocation"], $i, 1);
                                $_SESSION['msg'] = $jeux->getTitre() . " a été enlevé du panier!";
                                break;
                            }
                            $i++;
                        }
                        // Rendre le jeu disponible
                        $modeleJeux->activerJeu($params['jeux_id']);
                    } else {
                        $_SESSION['msg'] = "Aucun jeu à enlever.";
                    }
                    $this->afficherVues("panier", $donnees, false);
                    break;

                    case "supprimerAchat" :
                    if (isset($params['jeux_id']) && isset($_SESSION["cart"])) {
                        $i = 0;
                        foreach ($_SESSION["cart"] as $jeux) {
                            if ($jeux->getJeuxId() == $params['jeux_id']) {
                                array_splice($_SESSION["cart"], $i, 1);
                                array_splice($_SESSION["cartImages"], $i, 1);
                                array_splice($_SESSION["quantite"], $i, 1);
                                $_SESSION["prixTotal"] -= $_SESSION["prix"][$i];
                                array_splice($_SESSION["prix"], $i, 1);
                                array_splice($_SESSION["datesLocation"], $i, 1);
                                $_SESSION['msg'] = $jeux->getTitre() . " a été enlevé du panier!";
                                break;
                            }
                            $i++;
                        }
                    } else {
                        $_SESSION['msg'] = "Aucun jeu à enlever.";
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
        $_SESSION["cart"][] =  $jeu;
        // Ajouter l'image du jeu au panier
        // $donnees = $this->chercherImages($donnees, "cart", "cartImages");
        $modeleImages = $this->lireDAO("Images");
        if ($modeleImages->lireImageParJeuxId($jeu->getJeuxId())) {
            $_SESSION['cartImages'][] = $modeleImages->lireImageParJeuxId($jeu->getJeuxId());
        }
        else {
            $_SESSION['cartImages'][] = new Images(0, $jeu->getJeuxId(), 'images/image_defaut.png');
        }
        // Ajouter la quantité et prix et le prix total au panier
        $prix = $jeu->getPrix() * $quantite;
        $_SESSION["quantite"][] = $quantite;
        $_SESSION["prix"][] = $prix;
        $_SESSION["prixTotal"] += $prix;
        $_SESSION['msg'] = $jeu->getTitre() . " a été rajouté au panier!";
        }

    /**
     * Fonction pour créer un jeton pour s'assurer qu'une location ait seulement une évaluation
     * Source : https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string/13733588#13733588
     */
    public function creerJeton($longueur){
        $jeton = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz0123456789";
        $max = strlen($codeAlphabet);
        for ($i=0; $i < $longueur; $i++) {
            $jeton .= $codeAlphabet[random_int(0, $max-1)];
        }
        return $jeton;
    }

}
