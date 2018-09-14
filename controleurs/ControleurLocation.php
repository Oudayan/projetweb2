<?php
/** 
 * @file        ControleurLocation.php
 * @author      Oudayan Dutta, Zoraida Ortiz, Denise Ratté, Jorge Subirats 
 * @version     3.0
 * @date        25 février 2018
 * @brief       Controleur pour la location de logements
 *
 * @details 	Ce controleur définit les différentes activités concernant les activités de location d'un logement.
 */ 

	class ControleurLocation extends BaseControleur {

		/**
         * @brief   Méthode qui sera appelée par les contrôleurs
         * @details Méthode pour traiter les "cases" des contrôleurs
         * @param   [array] $params La chaîne de requête URL ("query string") captée par le Routeur.php
         * @return  L'acces aux vues,aux données et aux différents messages pour ce contrôleur.
         */
		public function index(array $params) {

            $modeleLocation = $this->lireDAO("Location");
            $modeleLogement = $this->lireDAO("Logement");
            $modeleDisponibilite = $this->lireDAO("Disponibilite");
            $modeleOption = $this->lireDAO("Option");
            $modeleUsagers = $this->lireDAO("Usagers");

            // Si le paramètre action existe
			if (isset($params["action"])) {

				// Switch en fonction de l'action qui nous est envoyée
				switch($params["action"]) {
					
                    // Affichage de la page de location
                    case "afficherLocation" :
                        $this->afficherLocation($params);
                        break;

                    // Louer un logement
					case "louerLogement" :
                        $donnees["erreur"] = "";
                        if (isset($_SESSION["courriel"])) {
                            if (isset($params["idLogement"]) && isset($params["datesLocation"]) && isset($_SESSION["location"]["prixTotal"])) {
                                $donnees["idLogement"] = $params["idLogement"];
                                $donnees["datesLocation"] = $params["datesLocation"];
                                $usager = $modeleUsagers->obtenir_par_courriel($_SESSION["courriel"]);
                                if ($usager->lireTypePaiement() == 1) {
                                    $donnees["paypal"] = "checked";
                                }
                                else if ($usager->lireTypePaiement() == 2) {
                                    $donnees["mastercard"] = "checked";
                                }
                                else if ($usager->lireTypePaiement() == 3) {
                                    $donnees["visa"] = "checked";
                                }
                                // Vérifier qu'un propriétaire ne puisse pas louer son propre logement 
                                $donnees["logement"] = $modeleLogement->lireLogementParId($params["idLogement"]);
                                $proprietaire = $donnees["logement"]->lireCourriel();
                                if ($_SESSION["courriel"] != $proprietaire) {
                                    // Valider que le logement est disponible pour ces dates
                                    $disponible = false;
                                    $dates = explode("  au  ", $params["datesLocation"]);
                                    $dispos = $modeleDisponibilite->lireDisponibilitesParLogement($params["idLogement"]);
                                    foreach ($dispos as $dispo) {
                                        if (strtotime($dates[0]) >= strtotime($dispo->lireDateDebut()) && strtotime($dates[1]) <= strtotime($dispo->lireDateFin()) && $dispo->lireDActive() == 1) {
                                            $disponible = true;
                                        }
                                    }
                                    // Si le logement est disponible, sauvegarder la demande de location
                                    if ($disponible) {
                                        $maintenant = date('Y-m-d H:m:s');
                                        // Créer un jeton pour s'assurer que le bon locataire évalue le bon logement.
                                        $jeton = $this->creerJeton(25);
                                        $location = new Location(0, $params["idLogement"], $proprietaire, $_SESSION["courriel"], $dates[0], $dates[1], $maintenant, $_SESSION["location"]["prixTotal"], 0, $jeton, NULL, NULL, NULL, NULL, NULL, NULL);
                                        $modeleLocation->sauvegarderLocation($location);
                                        $donnees["succes"] = "Demande de location réussie.<br>Veuillez attendre la confirmation du propriétaire par messagerie&nbsp;interne.";
                                    }
                                    else {
                                        $donnees["erreur"] = "Désolé, ce logement n'est plus disponible entre ces dates.";
                                    }
                                }
                                else {
                                    $donnees["erreur"] = "Désolé, vous ne pouvez pas louer votre propre logement.";
                                }
                            }
                            else {
                                $donnees["erreur"] = "Données manquantes pour la location. Veuillez recommencer.";
                            }
                        }
                        else {
                            $donnees["erreur"] = "Vous n'avez pas les permissions nécessaires pour effectuer cette action.";
                        }
                        $this->afficherVues("paiement", $donnees);
                        break;

                    // Afficher les demandes de location pour un propriétaire ou admin
					case "lireLocationsAValider" :
                        $donnees["erreur"] = "";
                        if (isset($_SESSION["courriel"]) && isset($_SESSION["typeUser"]) && $_SESSION["typeUser"] != 3) {
                            $locations = $modeleLocation->lireLocationsAValider($_SESSION["courriel"]);
                            for ($i = 0; $i < count($locations); $i++) {
                                // Vérifier si la demande de location est expirée
                                if (strtotime($locations[$i]->lireDateDebut()) >= strtotime(date('Y-m-d'))) {
                                    // Chercher les données de la location et du logement
                                    $locataire = $locations[$i]->lireIdLocataire();
                                    $proprietaire = $locations[$i]->lireIdProprietaire();
                                    $logement = $modeleLogement->lireLogementParId($locations[$i]->lireIdLogement());
                                    $adresse = $logement->lireNoCivique() . " " . $logement->lireRue() . " " . $logement->lireApt() . ", " . $logement->lireVille() . ", " . $logement->lireProvince() . ", " . $logement->lirePays() . ", " . $logement->lireCodePostal();
                                    // Vérifier si le logement est encore disponible
                                    $disponible = false;
                                    $dispos = $modeleDisponibilite->lireDisponibilitesParLogement($locations[$i]->lireIdLogement());
                                    foreach ($dispos as $dispo) {
                                        if (strtotime($locations[$i]->lireDateDebut()) >= strtotime($dispo->lireDateDebut()) && strtotime($locations[$i]->lireDateFin()) <= strtotime($dispo->lireDateFin()) && $dispo->lireDActive() == 1) {
                                            $disponible = true;
                                        }
                                    }
                                    // Si le logement est disponible, sauvegarder la demande de location
                                    if ($disponible) {
                                        $donnees["location"][$i] = $locations[$i];
                                        $donnees["logement"][$i] = $logement;
                                        $donnees["locataire"][$i] = $modeleUsagers->obtenir_par_courriel($locations[$i]->lireIdLocataire());
                                    }
                                    else {
                                        // Logement non disponible - mettre valide = 4 : 
                                        $modeleLocation->validerLocation($locations[$i]->lireIdLocation(), 4);
                                        // Envoyer message au locataire par la messagerie interne
                                        $donnees["erreur"] = "Désolé, le logement situé au " . $adresse . " n'est plus disponible entre le " . $locations[$i]->lireDateDebut() . " et le " . $locations[$i]->lireDateFin() . ".";
                                        $sujet = "Demande de location déclinée";
                                        header("Location: index.php?Messagerie&action=messageAutomatique&locataire=" . urlencode($locataire) . "&proprietaire=" . urlencode($proprietaire) . "&sujet=" . urlencode($sujet) . "&message=" . urlencode($donnees["erreur"]));
                                    }
                                }
                                else {
                                    // Demande expirée - mettre valide=3 : 
                                    $modeleLocation->validerLocation($locations[$i]->lireIdLocation(), 3);
                                    // Envoyer message au locataire par la messagerie interne
                                    $donnees["erreur"] = "Désolé, la demande de location pour le logement situé au " . $adresse . " entre le " . $locations[$i]->lireDateDebut() . " et le " . $locations[$i]->lireDateFin() . " est expirée.";
                                    $sujet = "Demande de location expirée";
                                    header("Location: index.php?Messagerie&action=messageAutomatique&locataire=" . urlencode($locataire) . "&proprietaire=" . urlencode($proprietaire) . "&sujet=" . urlencode($sujet) . "&message=" . urlencode($donnees["erreur"]));
                                }
                            }
                        }
                        else {
                            $donnees["erreur"] = "Vous n'avez pas les permissions nécessaires pour effectuer cette action.";
                        }
                        $this->afficherVues("locationsProprietaire", $donnees, false);
                        break;
                    
                    // Accepter une location - Gestion des disponibilités du logement
					case "approuverLocation" :
                        if (isset($params["idLocation"])) {
                            $location = $modeleLocation->lireLocationParId($params["idLocation"]);
                            // Chercher les données de la location et du logement
                            $locataire = $location->lireIdLocataire();
                            $proprietaire = $location->lireIdProprietaire();
                            $logement = $modeleLogement->lireLogementParId($location->lireIdLogement());
                            $adresse = $logement->lireNoCivique() . " " . $logement->lireRue() . " " . $logement->lireApt() . ", " . $logement->lireVille() . ", " . $logement->lireProvince() . ", " . $logement->lirePays() . ", " . $logement->lireCodePostal();
                            // Vérifier que l'usager est propriétaire du logement
                            if (isset($_SESSION["courriel"]) && isset($_SESSION["courriel"]) == $location->lireIdProprietaire()) {
                                $disponible = false;
                                // Gestion des disponibilités restantes
                                $dispos = $modeleDisponibilite->lireDisponibilitesParLogement($location->lireIdLogement());
                                foreach ($dispos as $dispo) {
                                    if (strtotime($location->lireDateDebut()) >= strtotime($dispo->lireDateDebut()) && strtotime($location->lireDateFin()) <= strtotime($dispo->lireDateFin()) && $dispo->lireDActive() == 1) {
                                        $disponible = true;
                                        // Désactiver la diponibilité courante
                                        $modeleDisponibilite->desactiverDisponibilite($dispo->lireIdDisponibilite());
                                        // Créer de nouvelle disponibilités avec les plages restantes
                                        // Dates début et dates fin sont différentes des dates dispos
                                        if ($location->lireDateDebut() > $dispo->lireDateDebut() && $location->lireDateFin() < $dispo->lireDateFin()) {
                                            $dispoDebut1 = $dispo->lireDateDebut();
                                            $dispoFin1 = date('Y-m-d', strtotime('-1 day', strtotime($location->lireDateDebut())));
                                            $dispoDebut2 = date('Y-m-d', strtotime('+1 day', strtotime($location->lireDateFin())));
                                            $dispoFin2 = $dispo->lireDateFin();
                                            // Insérer les disponibilités d'une durée de plus d'un jour (enlever les 0 nuit)
                                            if ($dispoDebut1 != $dispoFin1) {
                                                $nouvelleDispo1 = new Disponibilite(0, $dispo->lireIdLogement(), $dispoDebut1, $dispoFin1, true);
                                                $modeleDisponibilite->sauvegarderDisponibilite($nouvelleDispo1);
                                            }
                                            if ($dispoDebut2 != $dispoFin2) {
                                                $nouvelleDispo2 = new Disponibilite(0, $dispo->lireIdLogement(), $dispoDebut2, $dispoFin2, true);
                                                $modeleDisponibilite->sauvegarderDisponibilite($nouvelleDispo2);
                                            }
                                        }
                                        // Dates début identique mais dates fin différentes
                                        else if ($location->lireDateDebut() == $dispo->lireDateDebut() && $location->lireDateFin() < $dispo->lireDateFin()) {
                                            $dispoDebut1 = date('Y-m-d', strtotime('+1 day', strtotime($location->lireDateFin())));
                                            $dispoFin1 = $dispo->lireDateFin();
                                            $nouvelleDispo = new Disponibilite(0, $dispo->lireIdLogement(), $dispoDebut1, $dispoFin1);
                                            $modeleDisponibilite->sauvegarderDisponibilite($nouvelleDispo);
                                        }
                                        // Dates fin identique mais dates début différentes
                                        else if ($location->lireDateDebut() > $dispo->lireDateDebut() && $location->lireDateFin() == $dispo->lireDateFin()) {
                                            $dispoDebut1 = $dispo->lireDateDebut();
                                            $dispoFin1 = date('Y-m-d', strtotime('-1 day', strtotime($location->lireDateDebut())));
                                            $nouvelleDispo = new Disponibilite(0, $dispo->lireIdLogement(), $dispoDebut1, $dispoFin1);
                                            $modeleDisponibilite->sauvegarderDisponibilite($nouvelleDispo);
                                        }
                                    }
                                }
                                if ($disponible) {
                                    // Approuver la location
                                    $modeleLocation->validerLocation($params["idLocation"], 1);
                                    // Créer le lien pour l'évaluation et commentaires sur le logement
                                    //$lienEvaluation = "<a href=" . RACINE . "index.php?Evaluation&action=evaluerLogement&idLocation=" . $location->lireIdLocation() . "&jeton=" . $location->lireJeton() . "Évaluez ce logement !</a>";
                                    $lienEvaluation = "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . "index.php?Evaluation&action=evaluerLogement&idLocation=" . $location->lireIdLocation() . "&jeton=" . $location->lireJeton();
                                    // Envoyer message au locataire par la messagerie interne
                                    //$donnees["success"] = "<p>Votre demande de location pour le logement situé au " . $adresse . " entre le " . $location->lireDateDebut() . " et le " . $location->lireDateFin() . " est approuvée !</p><p>Veuillez répondre à ce courriel pour contacter le propriétaire et avoir les détails de la prise de possession du logement.</p><p>Voici le lien pour l'évaluation du logement : " . $lienEvaluation . ".<br>Ce lien sera fermé et compilé le lendemain de la date de fin de location.</p><p>Merci !</p>";
                                    $donnees["success"] = "Votre demande de location pour le logement situé au " . $adresse . " entre le " . $location->lireDateDebut() . " et le " . $location->lireDateFin() . " est approuvée ! Veuillez répondre à ce courriel pour contacter le propriétaire et avoir les détails de la prise de possession du logement. Le lien pour l'évaluation du logement sera fermé et compilé le lendemain de la date de fin de location. Veuillez copier-coller ce lien dans la barre d'adresse de votre fureteur : " . $lienEvaluation;
                                    $sujet = "Demande de location APPROUVÉE !";
                                    header("Location: index.php?Messagerie&action=messageAutomatique&locataire=" . urlencode($locataire) . "&proprietaire=" . urlencode($proprietaire) . "&sujet=" . urlencode($sujet) . "&message=" . urlencode($donnees["success"]));
                                }
                                else {
                                    // Mettre la location à 3-Expiré
                                    $modeleLocation->validerLocation($params["idLocation"], 3);
                                    // Envoyer message au locataire par la messagerie interne
                                    $donnees["erreur"] = "Désolé, la demande de location pour le logement situé au " . $adresse . " entre le " . $location->lireDateDebut() . " et le " . $location->lireDateFin() . " est expirée.";
                                    $sujet = "Demande de location expirée";
                                    header("Location: index.php?Messagerie&action=messageAutomatique&locataire=" . urlencode($locataire) . "&proprietaire=" . urlencode($proprietaire) . "&sujet=" . urlencode($sujet) . "&message=" . urlencode($donnees["erreur"]));
                                }
                            }
                            else {
                                $donnees["erreur"] = "Vous n'avez pas les permissions nécessaires pour effectuer cette action.";
                            }
                        }
                        else {
                            $donnees["erreur"] = "Données manquantes pour la confirmation de location. Veuillez recommencer.";
                        }
                        $this->afficherVues("locationsProprietaire", $donnees, false);
                        break;
                    
                    // Accepter une location
					case "refuserLocation" :
                        if (isset($params["idLocation"])) {
                            $location = $modeleLocation->lireLocationParId($params["idLocation"]);
                            if (isset($_SESSION["courriel"]) && isset($_SESSION["courriel"]) == $location->lireIdProprietaire()) {
                                //if (strtotime($location->lireDateDebut()) > strtotime(date('Y-m-d'))) {
                                    $modeleLocation->validerLocation($params["idLocation"], 2);
                                    // Envoyer message au locataire par la messagerie interne
                                    $donnees["erreur"] = "Désolé, la demande de location pour le logement situé au " . $adresse . " entre le " . $locations[$i]->lireDateDebut() . " et le " . $locations[$i]->lireDateFin() . "a été déclinée.";
                                    $sujet = "Location déclinée";
                                    header("Location: index.php?Messagerie&action=messageAutomatique&locataire=" . urlencode($locataire) . "&proprietaire=" . urlencode($proprietaire) . "&sujet=" . urlencode($sujet) . "&message=" . urlencode($donnees["erreur"]));
                                /*}
                                else {
                                    $donnees["erreur"] = "Vous ne pouvez pas annuler une location en cours.";
                                }*/
                            }
                            else {
                                $donnees["erreur"] = "Vous n'avez pas les permissions nécessaires pour effectuer cette action.";
                            }
                        }
                        else {
                            $donnees["erreur"] = "Données manquantes pour la confirmation de location. Veuillez recommencer.";
                        }
                        $this->afficherVues("locationsProprietaire", $donnees, false);
                        break;
                    
                    default :
					    $this->afficherLocation($params);
                        break;

			 	} // Fin du switch
					
		  	}
		  	else {
				$this->afficherVues("accueil");
		  	}

	  	} // Fin d'index
		/**
		 * @brief Fonction pour afficher le modal de demande de location d'un logement
		 * @details Prend les coordonnées et autres informations sur les logements. 
		 * @details Utilise les modèles suivants: ModeleLocaton,ModeleLogement, ModeleDisponibilite et le ModeleOption
		 * @return Puis ouvre la vue AfficheLocation.
		 */
        public function afficherLocation($params) {
            $modeleLocation = $this->lireDAO("Location");
            $modeleLogement = $this->lireDAO("Logement");
            $modeleDisponibilite = $this->lireDAO("Disponibilite");
            $modeleOption = $this->lireDAO("Option");
            $donnees["erreur"] = "";
            if (isset($params["idLogement"])) {
                // Chercher les données du logement
                $donnees["logement"] = $modeleLogement->lireLogementParId($params["idLogement"]);
                // Chercher les dates de location du logement
                $dispos = $modeleDisponibilite->lireDisponibilitesParLogement($params["idLogement"]);
                foreach ($dispos as $dispo) {
                    // Sélectionner la plage de disponibilité du logement correspondante au formulaire recherche
                    if ($dispo->lireDateDebut() <= $_SESSION["recherche"]["debutLocation"] && $dispo->lireDateFin() >= $_SESSION["recherche"]["finLocation"] && $dispo->lireDActive() == 1) {
                        // Assigner les valeurs de dates minimum et maximum selon les dispos du logement
                        $_SESSION["disponibilite"]["dateDebut"] = $dispo->lireDateDebut();
                        $_SESSION["disponibilite"]["dateFin"] = $dispo->lireDateFin();
                    }
                }
                // Si de nouvelles dates de locations sont entrées, les sauvegarder en $_SESSION
                if (isset($params["datesLocation"]) && $params["datesLocation"] != "") {
                    $dates = explode("  au  ", $params["datesLocation"]);
                    $_SESSION["recherche"]["debutLocation"] = $dates[0];
                    $_SESSION["recherche"]["finLocation"] = $dates[1];
                    $_SESSION['recherche']['datesLocation'] = $dates[0] . "  au  " . $dates[1];
                }
                // Si aucune date est en $_SESSION, assigner les valeurs défaut aujourd'hui à demain
                else if (!isset($_SESSION['recherche']['datesLocation'])) {
                    $aujourdhui = new DateTime();
                    $_SESSION["recherche"]["debutLocation"] = $aujourdhui;
                    $demain = new DateTime("+1 day");
                    $_SESSION["recherche"]["finLocation"] = $demain;
                    $_SESSION['recherche']['datesLocation'] = $aujourdhui . "  au  " . $demain;
                }
                // Calculer le nombre de jours de location
                $dateDebut = strtotime($_SESSION["recherche"]["debutLocation"]);
                $dateFin = strtotime($_SESSION["recherche"]["finLocation"]);
                $_SESSION["location"]["nbJours"] =  round(($dateFin - $dateDebut) / 86400);
                // Calculer le prix sans taxes
                $sousTotal = $_SESSION["location"]["nbJours"] * $donnees["logement"]->lirePrix();
                // Chercher les frais de nettoyage du logement
                $nettoyage = $donnees["logement"]->lireFraisNettoyage();
                // Chercher les frais de service dans la table options
                $fraisService = 0;
                $fraisServiceLogement = $modeleOption->lireOptionParId(2);
                $fraisService = $fraisServiceLogement->lireValeursOption();
                // Calculer le prix total
                $prixTotal = $sousTotal + $nettoyage + $fraisService;
                // Chercher les taxes dans la table options
                $valeursOption = $modeleOption->lireOptionParId(3);
                $taxes = unserialize($valeursOption->lireValeursOption());
                // Calculer les taxes
                $cnt = 0;
                foreach ($taxes as $taxe) {
                    // Appliquer taxe de chaque pays et province présent dans le options
                    if ($taxe[0] == $donnees["logement"]->lirePays() || $taxe[0] == $donnees["logement"]->lireProvince()) {
                        $_SESSION["location"]["taxe"][$cnt] = $taxe[1];
                        $_SESSION["location"]["taux"][$cnt] = $taxe[2];
                        $_SESSION["location"]["sousTotalTaxe"][$cnt] = $this->formatMonnaie($prixTotal * $taxe[2] / 100);
                        $prixTotal = $prixTotal * (100 + $taxe[2]) / 100;
                        $cnt++;
                    }
                }
                // Convertir les données en format monnaie
                $_SESSION["location"]["prix"] = $this->formatMonnaie($donnees["logement"]->lirePrix());
                $_SESSION["location"]["sousTotal"] = $this->formatMonnaie($sousTotal);
                $_SESSION["location"]["nettoyage"] = $this->formatMonnaie($nettoyage);
                $_SESSION["location"]["fraisService"] = $this->formatMonnaie($fraisService);
                $_SESSION["location"]["prixTotalFormate"] = $this->formatMonnaie($prixTotal);
                $_SESSION["location"]["prixTotal"] = $prixTotal;
            }
            else {
                $donnees["erreur"] = "Données manquantes pour la location. Veuillez recommencer.";
            }
            $this->afficherVues("location", $donnees, false);
        }

        /**
		 * @brief Fonction pour formatter un nombre en monnaie
		 * @details Prend un nombre  entier le met en float et lui met le signe de dollar
		 * @param [numeric] nombre
		 * @return un nombre.
		 */
        public function formatMonnaie($nombre) {
            if (is_numeric($nombre)) {
                $nombre = number_format(ceil($nombre / 0.01) * 0.01, 2, '.', ' ') . " $";
                return $nombre;
            }
            return false;
        }
		/**
         * Fonction pour créer un jeton pour s'assurer qu'une location ait seulement une évaluation
         * Source : https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string/13733588#13733588
         */
		public function creerJeton($longueur){
            $jeton = "";
            $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz123456789";
            $max = strlen($codeAlphabet);
            for ($i=0; $i < $longueur; $i++) {
                $jeton .= $codeAlphabet[random_int(0, $max-1)];
            }
            return $jeton;
        }

    }

?>