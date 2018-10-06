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
                        foreach ($donnees['commentaires'] as $commentaire){
                            $donnees['commentaires']['membres'][] = $modeleMembres->obtenirParId($commentaire->getMembreId());
                        }
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

                    //var_dump($params); 

                    if (isset($params['jeux_id']) && isset($params['membre_id']) && isset($params['titre']) && isset($params['prix']) && isset($params['concepteur']) && isset($params['location']) && isset($params['plateforme_id']) && isset($params['categorie']))
                    {
                        (string)$date = date("Y-m-d H:i");  
                        // $jeux_id = 0, $plateforme_id = 1, $membre_id = "", $titre = "", $prix = "", $date_ajout = "", $concepteur = "", $location = "", $jeux_valide = false, $jeux_actif = true, $description = "", $evaluation_globale= ""
                        $jeu = new Jeux($params['jeux_id'], $params["plateforme_id"], $params["membre_id"], $params["titre"], $params["prix"], $date, $params["concepteur"], $params["location"], 1, 1, $params["description"], -1);
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

                        // var_dump($jeu, "ID = " . $id);

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
                        // $this->afficherVues("maPage", $donnees);
                        var_dump("bla");
                    }

                    // $donnees['jeux'] = $$modeleJeux->sauvegarderJeux();
                    // $donnees['categoriesJeu'] = $modeleCategoriesJeux->sauvegarderCategoriesJeu();
                    // $this->afficherVues("maPage", $donnees);
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

    public function filtrerJeux(array $params) {

        $modeleJeux = $this->lireDAO("Jeux");
        $modeleImages = $this->lireDAO("Images");
        $modeleMembres = $this->lireDAO("Membres");
        $modelePlateformes = $this->lireDAO("Plateformes");
        $modeleCategoriesJeux = $this->lireDAO("CategoriesJeux");
        $modeleCommentaireJeux = $this->lireDAO("CommentaireJeux");
        $modeleCategories = $this->lireDAO("Categories");

        //  Construction de la requête SQL
        $filtre = "jeux_actif = true AND jeux_valide = true";

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

        $counter = 0;
        $categories = $modeleCategories->lireToutesCategories();
        for ($i = 0; $i <= count($categories); $i++) {
            $cat = "categories" . $i;
            if (isset($params[$cat])) {
//                    var_dump($cat);
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


        if (isset($params["transaction"]) && ($params["transaction"] !== '')) {
            $_SESSION["rechercher"]["transaction"] = $params["transaction"];

            $filtre .= ($filtre == "" ? "" : " AND ") . "location = '" . $params["transaction"] . "'";
        }
        else {
            $_SESSION["rechercher"]["transaction"] = '-1';
        }



        $donnees['jeux'] = $modeleJeux->filtreJeux($filtre);
        $donnees['categories'] = $modeleCategories->lireToutesCategories();
        $donnees['plateforme'] = $modelePlateformes->lireToutesPlateformes();
        
        $this->afficherVues("rechercher", $donnees);

    }

    public function afficherAccueil(){

        $modeleJeux = $this->lireDAO("Jeux");
        $modeleImages = $this->lireDAO("Images");

        $donnees['trois'] = $modeleJeux->lireDerniersTrois();
        foreach($donnees['trois'] as $derniers ){
            if ($modeleImages->lireImageParJeuxId($derniers->getJeuxId())) {
                $donnees['imagesTrois'][] = $modeleImages->lireImageParJeuxId($derniers->getJeuxId());
            }
            else {
                $donnees['imagesTrois'][] = new Images(0, $derniers->getJeuxId(), 'images/image_defaut.png');
            }
        }

        $donnees['derniers'] = $modeleJeux->lireDerniersJeux();
        foreach($donnees['derniers'] as $derniers ){
            if ($modeleImages->lireImageParJeuxId($derniers->getJeuxId())) {
                $donnees['images'][] = $modeleImages->lireImageParJeuxId($derniers->getJeuxId());
            }
            else {
                $donnees['images'][] = new Images(0, $derniers->getJeuxId(), 'images/image_defaut.png');
            }
        }
   
        $this->afficherVues("accueil", $donnees);

    }

    public function afficherJeuxMembres(){
        if(isset($_SESSION["id"]))
        {
            $modeleJeux = $this->lireDAO("Jeux");
            $modeleImages = $this->lireDAO("Images");
    
            $donnees['jeux'] = $modeleJeux->lireJeuxParMembre($_SESSION["id"]);
            foreach($donnees['jeux'] as $jeu ){
                if ($modeleImages->lireImageParJeuxId($jeu->getJeuxId())) {
                    $donnees['images'][] = $modeleImages->lireImageParJeuxId($jeu->getJeuxId());
                }
                else {
                    $donnees['images'][] = new Images(0, $jeu->getJeuxId(), 'images/image_defaut.png');
                }
            }
        }
        else
        {
            $donnees['erreur'] = "Vous devez vous connecter pour acceder à cette page";
        }
        $this->afficherVues("membre", $donnees);
    }


}