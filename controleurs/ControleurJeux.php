<?php
/**
 * @file      ControleurJeux.php
 * @author    Guilherme Tosin, Marcelo Guzmán
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
        $modeleJeux = $this->lireDAO("Jeux");
        $modeleImages = $this->lireDAO("Images");
        $modeleMembres = $this->lireDAO("Membres");
        $modelePlateformes = $this->lireDAO("Plateformes");
        $modeleCategoriesJeux = $this->lireDAO("CategoriesJeux");
        $modeleCommentaireJeux = $this->lireDAO("CommentaireJeux");
        $modeleCategories = $this->lireDAO("Categories");
        $modeleLocation = $this->lireDAO("Location");
        $donnees["erreur"] = "";
        if (isset($params["action"]))
        {
            switch($params["action"])
            {
                case "afficherJeu" :
                    if (isset($params["JeuxId"]))
                    {
                        $donnees['jeu'] = $modeleJeux->lireJeuParId($params["JeuxId"]);
                        $donnees['images'] = $modeleImages->lireImagesParJeuxId($params["JeuxId"]);
                        $donnees['membre'] = $modeleMembres->obtenirParId($donnees['jeu']->getMembreId());
                        $donnees['plateforme'] = $modelePlateformes->lirePlateformeParId($donnees['jeu']->getPlateformeId());
                        $donnees['categoriesJeu'] = $modeleCategoriesJeux->lireCategoriesParJeuxId($params["JeuxId"]);
                        $donnees['commentaires'] = $modeleCommentaireJeux->toutObtenirParIdJeuxId($params["JeuxId"]);
                        $donnees['nbCommentaires'] = $modeleCommentaireJeux->nbEvaluationsParJeu($params["JeuxId"]);
                        foreach ($donnees['commentaires'] as $commentaire)
                        {
                            $donnees['commentaires']['membres'][] = $modeleMembres->obtenirParId($commentaire->getMembreId());
                        }
                        $locations = $modeleLocation->lireLocationsParJeuxId($params["JeuxId"]);
                        
                        $donnees['nonDispos'] = "['";
                        $cnt = 0;
                        foreach ($locations as $location)
                        {
                            $start = new DateTime($location->getDateDebut());
                            $end = new DateTime($location->getDateRetour());
                            while($start <= $end)
                            {
                                if($cnt == 0)
                                {
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
                    else
                    {
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
                    $donnees['plateforme'] = $modelePlateformes->lireToutesPlateformes();
                    $donnees['categories'] = $modeleCategories->lireToutesCategories();  
                    $this->afficherVues("ajoutJeux", $donnees);
                    break;

                case "formModifierJeux":
                    if (isset($params["JeuxId"]))
                    {
                        $donnees['plateforme'] = $modelePlateformes->lireToutesPlateformes();
                        $donnees['categories'] = $modeleCategories->lireToutesCategories();
                        $donnees['categoriesJeu'] = $modeleCategoriesJeux->lireCategoriesParJeuxId($params["JeuxId"]);
                        $donnees['jeu'] = $modeleJeux->lireJeuParId($params["JeuxId"]);
                        $donnees['images'] = $modeleImages->lireImagesParJeuxId($params["JeuxId"]);
                    }
                    else
                    {
                        $donnees["erreur"] = "Ce jeu n'existe pas.";
                    }
                    $this->afficherVues("ajoutJeux", $donnees);
                    break;

                case "enregistrerJeux":
                    if (isset($params['jeux_id']) && isset($params['titre']) && isset($params['prix']) && isset($params['concepteur']) && isset($params['location']) && isset($params['plateforme_id']) && isset($params['categorie']))
                    {
                        if (isset($params['jeux_id']) && $params['jeux_id'] > 0) {
                            $jeuUpdadte = $modeleJeux->lireJeuParId($params['jeux_id']);
                            $membre = $jeuUpdadte->getMembreId();
                            $date = $jeuUpdadte->getDateAjout();
                            $valide = $jeuUpdadte->getJeuxValide();
                            $actif = $jeuUpdadte->getJeuxActif();
                            $banni = $jeuUpdadte->getJeuxBanni();
                        }
                        else
                        {
                            $membre = $_SESSION["id"];
                            (string)$date = date("Y-m-d H:i"); 
                            $valide = 0;
                            $actif = 1;
                            $banni = 0;
                        }

                        //$jeux_id = 0, $plateforme_id = 1, $membre_id = "", $titre = "", $prix = "", $date_ajout = "", $concepteur = "", $location = "", $jeux_valide = 0, $jeux_actif = 1, $jeux_banni = 0, $description = "", $evaluation_globale= "")    
                        $jeu = new Jeux($params['jeux_id'], $params["plateforme_id"], $membre, $params["titre"], $params["prix"], $date, $params["concepteur"], $params["location"], $valide, $actif, $banni, $params["description"], -1);
                        $jeux_id = $modeleJeux->sauvegarderJeux($jeu);
                        if(isset($params['cheminsImages']))
                        {
                            $tmpDir = 'images/Jeux/tmp' . $_SESSION['id'];
                            $newDir = 'images/Jeux/' . $jeux_id;
                            if(is_dir($tmpDir))
                            {
                                if(is_dir($newDir))
                                {
                                    $files = scandir($tmpDir);
                                    $tmpDir .= "/";
                                    $newDir .= "/";
                                    foreach ($files as $file) {
                                        if (in_array($file, array(".",".."))) continue;
                                        // If we copied this successfully, mark it for deletion
                                        if (copy($tmpDir.$file, $newDir.$file)) {
                                            $delete[] = $tmpDir.$file;
                                        }
                                    }
                                    // Delete all successfully-copied files
                                    foreach ($delete as $file) {
                                        unlink($file);
                                    }
                                    rmdir($tmpDir);
                                }
                                else {
                                    rename($tmpDir, $newDir);
                                }
                            }
                            $modeleImages->effacerImagesParJeuxId($jeux_id);
                            foreach($params['cheminsImages'] as $cheminImage)
                            {
                                if ($cheminImage != "") {
                                    $image = new Images(0, $jeux_id, str_replace('/tmp' . $_SESSION['id'] . '/', '/' . $jeux_id . '/', $cheminImage));
                                    // echo "<pre>";
                                    // var_dump($image);
                                    // echo "</pre>";
                                    $modeleImages->sauvegarderImage($image);
                                }
                            }
                        }
                        //Sauvegarder les categories de jeu
                        $modeleCategoriesJeux->effacerCategoriesParJeuxId($jeux_id);
                        for($i=0; $i < count($params['categorie']); $i++)
                        {
                            // $jeux_id = 0,$categorie_id = 0, $categorie = ""
                            $cat = new CategoriesJeux($jeux_id, $params['categorie'][$i], "test");
                            //var_dump($modeleCategoriesJeux->sauvegarderCategoriesJeu($cat));
                            $modeleCategoriesJeux->sauvegarderCategoriesJeu($cat);
                        }
                    }
                    else
                    {
                        $_SESSION['msg'] ="Remplissez tous les champs...";
                    }
                    $this->filtrerJeux($params);
                    break;

                case "rechercherJeux":
                    $this->filtrerJeux($params);
                    break;

                case "resetRecherche":
                    unset($_SESSION['recherche']);
                    $this->filtrerJeux($params);
                    break;

                case "gererMesJeux":
                    $this->afficherJeuxMembres();
                    break; 

                case "desactiverJeu":
                    if(isset($params['jeux_id'])){
                        $modeleJeux->desactiverJeu($params['jeux_id']);
                    }
                    $this->afficherJeuxMembres();    
                    break;

                case "activerJeu":
                    if(isset($params['jeux_id'])){
                        $modeleJeux->activerJeu($params['jeux_id']);
                    }
                    $this->afficherJeuxMembres();    
                    break;

                default :
                    $this->afficherAccueil();
                    break;
            }
        }
        else
        {
            $this->afficherAccueil();
        }

    }


    private function filtrerJeux(array $params)
    {
        $modeleJeux = $this->lireDAO("Jeux");
        $modeleLocation = $this->lireDAO("Location");
        $modeleMembres = $this->lireDAO("Membres");
        $modelePlateformes = $this->lireDAO("Plateformes");
        $modeleCategoriesJeux = $this->lireDAO("CategoriesJeux");
        $modeleCommentaireJeux = $this->lireDAO("CommentaireJeux");
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
        $categories = $modeleCategories->lireToutesCategories();
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
        $donnees['categories'] = $modeleCategories->lireToutesCategories();
        $donnees['plateforme'] = $modelePlateformes->lireToutesPlateformes();
        $this->afficherVues("rechercher", $donnees);
    }


    private function afficherAccueil()
    {
        $modeleJeux = $this->lireDAO("Jeux");
        $modeleImages = $this->lireDAO("Images");
        $donnees['trois'] = $modeleJeux->lireDerniersJeux(3);
        $donnees = $this->chercherImages($donnees, "trois", "Trois");
        $donnees['derniers'] = $modeleJeux->lireDerniersJeux();
        $donnees = $this->chercherImages($donnees, "derniers");
        $this->afficherVues("accueil", $donnees);
    }


    private function afficherJeuxMembres()
    {
        if(isset($_SESSION["id"]))
        {
            $modeleJeux = $this->lireDAO("Jeux");
            $donnees['jeux'] = $modeleJeux->lireJeuxParMembre($_SESSION["id"]);
            $donnees = $this->chercherImages($donnees);
        }
        else
        {
            $donnees['erreur'] = "Vous devez vous connecter pour acceder à cette page";
        }
        $this->afficherVues("membre", $donnees);
    }


    private function chercherImages($donnees, $jeux = "jeux", $images = "")
    {
        $modeleImages = $this->lireDAO("Images");
        foreach($donnees[$jeux] as $jeu)
        {
            if ($modeleImages->lireImageParJeuxId($jeu->getJeuxId()))
            {
                $donnees['images' . $images][] = $modeleImages->lireImageParJeuxId($jeu->getJeuxId());
            }
            else
            {
                $donnees['images' . $images][] = new Images(0, $jeu->getJeuxId(), 'images/image_defaut.png');
            }
        }
        return $donnees;
    }

}