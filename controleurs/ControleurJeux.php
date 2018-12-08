<?php
/**
 * @file      ControleurJeux.php
 * @author    Guilherme Tosin, Marcelo Guzmán, Oudayan Dutta
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Définit la classe pour le controleur jeux
 * @details   Cette classe définit les différentes activités concernant aux jeux
 */

    class ControleurJeux extends BaseControleur {

        /**
         * @brief   Méthode qui sera appelée par les controleurs
         * @details Méthode abstraite pour traiter les "cases" des contrôleurs
         * @param   [array] $params La chaîne de requête URL ("query string") captée par le Routeur.php
         * @return  L'acces aux vues,aux données et aux différents messages pour ce contrôleur.
         */
        public function index(array $params) {
            $modeleJeux = $this->lireDAO("Jeux");
            $modeleMembres = $this->lireDAO("Membres");
            $modelePlateformes = $this->lireDAO("Plateformes");
            $modeleCategories = $this->lireDAO("Categories");
            $modeleCategoriesJeux = $this->lireDAO("CategoriesJeux");
            $modeleEvaluation = $this->lireDAO("Evaluation");
            $modeleLocation = $this->lireDAO("Location");

            $donnees["erreur"] = "";

            if (isset($params["action"])) {

                switch($params["action"]) {

                    case "afficherJeu" :
                        if (isset($params["JeuxId"])) {
                            $donnees['jeu'] = $modeleJeux->lireJeuParId($params["JeuxId"]);
                            $donnees = $this->chercherImages($donnees, 'jeu');
                            $donnees['membre'] = $modeleMembres->obtenirParId($donnees['jeu']->getMembreId());
                            $donnees['plateforme'] = $modelePlateformes->lirePlateformeParId($donnees['jeu']->getPlateformeId());
                            $donnees['categoriesJeu'] = $modeleCategoriesJeux->lireCategoriesParJeuxId($params["JeuxId"]);
                            $donnees['evaluations'] = $modeleEvaluation->lireEvaluationsParJeu($params["JeuxId"]);
                            $donnees['nbEvaluations'] = $modeleEvaluation->lireNbEvaluationsParJeu($params["JeuxId"]);
                            $donnees['nbCommentaires'] = $modeleEvaluation->lireNbCommentairesParJeu($params["JeuxId"]);
                            foreach ($donnees['evaluations'] as $commentaire) {
                                $donnees['evaluations']['membres'][] = $modeleMembres->obtenirParId($commentaire->getMembreId());
                            }
                            $locations = $modeleLocation->lireLocationsActivesParJeuxId($params["JeuxId"]);
                            
                            $donnees['nonDispos'] = "['";
                            $cnt = 0;
                            foreach ($locations as $location) {
                                $start = new DateTime($location->getDateDebut());
                                $end = new DateTime($location->getDateRetour());
                                while ($start <= $end) {
                                    if ($cnt == 0) {
                                        $donnees['nonDispos'] .=  $start->format('Y-m-d');
                                    }
                                    else {
                                        $donnees['nonDispos'] .= "', '" . $start->format('Y-m-d');
                                    }
                                    $cnt++;
                                    $start->add(new DateInterval('P1D')); 
                                }
                            }
                            $donnees['nonDispos'] .= "']";
                        }
                        else {
                            $donnees["erreur"] = "Ce jeu n'existe pas.";
                        }
                        $this->afficherVues("jeux", $donnees);
                        break;

                    case "afficherJeux" :
                        $this->afficherAccueil();
                        break;

                    case "derniers" :
                        $this->afficherAccueil();
                        break;

                    case "formAjoutJeux":
                        $donnees['plateforme'] = $modelePlateformes->lireToutesPlateformesActives();
                        $donnees['categories'] = $modeleCategories->lireToutesCategoriesActives();  
                        $this->afficherVues("ajoutJeux", $donnees);
                        break;

                    case "formModifierJeux":
                        $donnees = $this->formModifierJeu($params);
                        $this->afficherVues("ajoutJeux", $donnees);
                        break;

                    case "enregistrerJeux":
                        $this->sauvegarderJeu($params);
                        $donnees = $this->afficherJeuxMembres();
                        $this->afficherVues("membre", $donnees);
                        break;

                    case "rechercherJeux":
                        $this->filtrerJeux($params);
                        break;

                    case "resetRecherche":
                        unset($_SESSION['rechercher']);
                        $this->filtrerJeux($params);
                        break;

                    case "gererMesJeux":
                        $donnees = $this->afficherJeuxMembres();
                        $this->afficherVues("membre", $donnees);
                        break; 

                    case "desactiverJeu":
                        if (isset($params['jeux_id'])) {
                            $modeleJeux->desactiverJeu($params['jeux_id']);
                        }
                        $donnees = $this->afficherJeuxMembres();    
                        $this->afficherVues("membre", $donnees);
                        break;

                    case "activerJeu":
                        if (isset($params['jeux_id'])) {
                            $modeleJeux->activerJeu($params['jeux_id']);
                        }
                        $donnees = $this->afficherJeuxMembres();    
                        $this->afficherVues("membre", $donnees);
                        break;

                    default :
                        $this->afficherAccueil();
                        break;
                }
            }
            else {
                $this->afficherAccueil();
            }

        }


        private function filtrerJeux(array $params) {
            $modeleJeux = $this->lireDAO("Jeux");
            $modeleLocation = $this->lireDAO("Location");
            $modelePlateformes = $this->lireDAO("Plateformes");
            $modeleCategories = $this->lireDAO("Categories");

            //  Construction de la requête SQL
            $filtre = "jeux_valide = 1 AND jeux_actif = 1 AND jeux_banni = 0";

            if (isset($params["plateforme"]) && ($params['plateforme'] !== '')) {
                $_SESSION["rechercher"]["plateforme"] = $params["plateforme"];

                $filtre .= ($filtre == "" ? "" : " AND ") . "plateforme_id = " . $params["plateforme"];
            }

            if (isset($params["titre"]) && ($params['titre'] !== '')) {
                $_SESSION["rechercher"]["titre"] = $params["titre"];
                $filtre .= ($filtre == "" ? "" : " AND ") . "j.titre LIKE '%" . $params["titre"] . "%'";
            }
            else {
                $_SESSION["rechercher"]["titre"] = '';
            }

            if (isset($params["prix"]) && ($params['prix'] !== '')) {
                $_SESSION["rechercher"]["prix"] = $params["prix"];
                $filtre .= ($filtre == "" ? "" : " AND ") . "j.prix <= '" . $params["prix"] . "'";
            }
            else {
                $_SESSION["rechercher"]["prix"] = '';
            }

            if (isset($params["datesLocation"]) && $params['datesLocation'] !== '' && isset($params["transaction"]) && $params["transaction"] == 1) {
                $_SESSION["rechercher"]["datesLocation"] = $params["datesLocation"];
                $dates = explode(" au ", $params["datesLocation"]);

    //            $dispos = $modeleLocation->lireToutesLesLocations();
    //            foreach ($dispos AS $dispo){
    //                if (strtotime($dates[0]) >= strtotime($dispo->getDateDebut()) && strtotime($dates[1]) <= strtotime($dispo->getDateRetour())) {
    //                    $disponible = true;
    //                }
    //            }
    //            WHERE (date_debut >= '2018-10-15') OR (date_retour <= '2018-10-16')
                $filtre .= ($filtre == "" ? "" : " AND ") . " (l.date_retour < '" . $dates[0] . "' OR l.date_debut > '" . $dates[1] . "')";
    //            var_dump($dates);
            }
    //        else {
    //            $_SESSION["rechercher"]["datesLocation"] = '';
    //        }

            $counter = 0;
            $categories = $modeleCategories->lireToutesCategoriesActives();
            $catFlag = 0;
            for ($i = 0; $i <= count($categories); $i++) {
                $cat = "categories" . $i;
                if (isset($params[$cat])) {
                    $catFlag = 1;
                    $_SESSION["rechercher"][$cat] = "checked";
                    $counter++;
                    if ($counter == 1) {
                        $filtre .= ($filtre == "" ? "(" : " AND (") . "c.categorie_id = " . $params[$cat];
                    }
                    else {
                        $filtre .= (" OR ") . "c.categorie_id = " . $params[$cat];
                    }
                }
                else {
                    $_SESSION["rechercher"][$cat] = "";
                }
            }
            if ($counter > 0) {
                $filtre .= ")";
            }
            if ($catFlag) {
                $donnees["catShow"] = " show ";
            }
            else
            {
                $donnees["catShow"] = "";
            }

            $disponible = 0;
            if (isset($params["transaction"]) && ($params["transaction"] != '')) {
                $_SESSION["rechercher"]["transaction"] = $params["transaction"];
                $filtre .= ($filtre == "" ? "" : " AND ") . "location = " . $params["transaction"];
                if($params["transaction"] == 1) {
                    $donnees['jeux'] = $modeleJeux->filtreJeux($filtre, ", l.date_debut, l.date_retour");
                }
                else {
                    $donnees['jeux'] = $modeleJeux->filtreJeux($filtre);
                }
            }
            else {
                $_SESSION["rechercher"]["transaction"] = '-1';
                $donnees['jeux'] = $modeleJeux->filtreJeux($filtre);
            }

            $donnees = $this->chercherImages($donnees);
            for ($i = 0; $i < count($donnees['jeux']); $i++) {
                $donnees['plateformeJeu'][$i] = $modelePlateformes->lirePlateformeParId($donnees['jeux'][$i]->getPlateformeId());
            }
            $donnees['categories'] = $modeleCategories->lireToutesCategoriesActives();
            $donnees['plateforme'] = $modelePlateformes->lireToutesPlateformesActives();
            $this->afficherVues("rechercher", $donnees);
        }


        private function afficherAccueil() {
            $modeleJeux = $this->lireDAO("Jeux");
            $modelePlateformes = $this->lireDAO("Plateformes");
            $donnees['plateformes'] = $modelePlateformes->lireToutesPlateformesActives();
            $donnees['trois'] = $modeleJeux->lireDerniersJeux(6);
            $donnees = $this->chercherImages($donnees, "trois", "Trois");
            $donnees['derniers'] = $modeleJeux->lireDerniersJeux(12);
            $donnees = $this->chercherImages($donnees, "derniers");
            for ($i = 0; $i < count($donnees['derniers']); $i++) {
                $donnees['plateformeDerniers'][$i] = $modelePlateformes->lirePlateformeParId($donnees['derniers'][$i]->getPlateformeId());
            }
            $this->afficherVues("accueil", $donnees);
        }

    }

?>