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
                        // $donnees['commentaires'] = $modeleCommentaireJeux->lireCommentaireParJeuxId($params["JeuxId"]);
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
                    if(isset($params["JeuxId"]))
                    {
                        $this->afficherVues("accueil", $donnees);
                    }
                    break;

                case "derniers" :

                    $donnees['derniers'] = $modeleJeux->lireDerniersJeux();
                    $donnees['images'] = $modeleImages->lireDerniersImages();


                    $this->afficherVues("accueil", $donnees);
                    
                    break;
                
                case "formAjoutJeux":

                    $donnees['plateforme'] = $modelePlateformes->lireToutesPlateformes();
                    $donnees['categories'] = $modeleCategories->lireToutesCategories();
                    // $donnees['categoriesJeu'] = $modeleCategoriesJeux->lireCategoriesParJeuxId(2);
                    // $donnees['jeu'] = $modeleJeux->lireJeuParId(2);
                    
                    $this->afficherVues("ajoutJeux", $donnees);
                    
                    break;

                case "formModifierJeux":
                    if (isset($params["JeuxId"]))
                    {
                        $donnees['plateforme'] = $modelePlateformes->lireToutesPlateformes();
                        $donnees['categories'] = $modeleCategories->lireToutesCategories();
                        $donnees['categoriesJeu'] = $modeleCategoriesJeux->lireCategoriesParJeuxId($params["JeuxId"]);
                        $donnees['jeu'] = $modeleJeux->lireJeuParId($params["JeuxId"]);
                    }
                    else
                    {
                        $donnees["erreur"] = "Ce jeu n'existe pas.";
                    }

                    $this->afficherVues("ajoutJeux", $donnees);
                    
                    break;

                case "enregistrerJeux":

                    var_dump($params); 

                    if (isset($params['membre_id']) && isset($params['titre']) && isset($params['prix']) && isset($params['concepteur']) && isset($params['location']) && isset($params['plateforme_id']) && isset($params['categorie']))
                    {
           
                        $modeleJeux = $this->lireDAO("Jeux");
                        $enregistrement["Jeux"] = new Jeux(null, $params["plateforme_id"], $params["membre_id"], $params['titre'], $params['prix'], $now, $params['concepteur'], $params['location'], $params['jeux_valide'], $params['jeux_actif'], $params['description'], $params['evaluation_globale']);
                        $succes = $modeleJeux->sauvegarderJeux($enregistrement["Jeux"]);
                    }

                    else
                    {
                        $_SESSION['msg'] ="Remplissez tous les champs...";
                        $this->afficherVues("maPage", $donnees);
                    }

                    // $donnees['jeux'] = $$modeleJeux->sauvegarderJeux();
                    // $donnees['categoriesJeu'] = $modeleCategoriesJeux->sauvegarderCategoriesJeu();
                    // $this->afficherVues("accueil", $donnees);
                    $this->afficherVues("maPage", $donnees);

                    break;

                case "rechercherJeux":
                    $modeleJeux = $this->lireDAO("Jeux");
                    $modeleImages = $this->lireDAO("Images");
                    $modeleMembres = $this->lireDAO("Membres");
                    $modelePlateformes = $this->lireDAO("Plateformes");
                    $modeleCategoriesJeux = $this->lireDAO("CategoriesJeux");
                    $modeleCategories = $this->lireDAO("Categories");

                    //  Construction de la requête SQL

                    $filtre = "jeux_actif = true AND jeux_valide = true";

                    if (isset($params["plateforme"]) && ($params['plateforme'] !== '')) {
                        $filtre .= ($filtre == "" ? "" : " AND ") . "plateforme_id = " . $params["plateforme"];
                    }

                    if (isset($params["categories"])) {
                        $counter = 0;
                        for ($i = 1; $i <= count($params["categories"]); $i++) {
                            $counter++;
                            if ($counter == 1) {
                                $filtre .= ($filtre == "" ? "(" : " AND (") . "c.categorie_id = " . $i;
                            }
                            else {
                                $filtre .= (" OR ") . "c.categorie_id = " . $i;
                            }
                        }
                        if ($counter > 0) {
                            $filtre .= ")";
                        }
                    }

                    if (isset($params["negotiation"]) && ($params["negotiation"] !== '')) {
                        $filtre .= ($filtre == "" ? "" : " AND ") . "location = '" . $params["negotiation"] . "'";
                    }

                    $donnees['jeux'] = $modeleJeux->filtreJeux($filtre);
                    $donnees['categories'] = $modeleCategories->lireToutesCategories();
                    $donnees['plateforme'] = $modelePlateformes->lireToutesPlateformes();
                    
                    $this->afficherVues("rechercher", $donnees);
                    break;

                default :
                    $this->afficherVues("accueil", $donnees);
                    break;
            }
        }
        else
        {
            $donnees['derniers'] = $modeleJeux->lireDerniersJeux();
            $donnees['images'] = $modeleImages->lireDerniersImages();
            $this->afficherVues("accueil", $donnees);
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
        $donnees['images'] = $modeleImages->toutesImages();
        $donnees['categories'] = $modeleCategories->lireToutesCategories();
        $donnees['plateforme'] = $modelePlateformes->lireToutesPlateformes();

        //$_POST['action'] = "index.php?Jeux&action=rechercherJeux";

        //  Construction de la requête SQL

        $filtre = "jeux_actif = true AND jeux_valide = true";

        if (isset($params["plateforme"]) && ($params['plateforme'] !== '')) {
            $filtre .= ($filtre == "" ? "" : " AND ") . "plateforme_id = '" . $params["plateforme"] . "'";
            //$params['plateforme'] = $params["plateforme"];
        }
        else if (!isset($params['plateforme'])) {
            //$params['plateforme'] = null;
        }

        $counter = 0;

        for ($i = 1; $i <= count($params["categories"]); $i++) {
            if (isset($params['categories'][$i])) {
                //$params["categorie"]++;
                $counter++;
                if ($counter == 1) {
                    $filtre .= ($filtre == "" ? "(" : " AND (") . "categorie_id = " . $i;
                }
                else {
                    $filtre .= (" OR ") . "categorie_id = " . $i;
                }
                //$params["categorie" .$i] = "checked";
            }
            else {
                //$params["categorie" .$i] = "";
            }
        }
        if ($counter == 0) {
            for ($i = 1; $i <= count($_POST["categorie"]); $i++) {
                //$_POST["categorie" .$i] = "checked";
            }
        }
        else {
            $filtre .= ")";
        }


//                if (isset($params["categorie"]) && (trim($_POST['categorie'] !== ''))) {
//                    $filtre .= ($filtre == "" ? "" : " AND ") . "c.categorie_id = '" . $params["categorie"] . "'";
//                    $_POST['categorie'] = $params["categorie"];
//                }
//                else if (!isset($_POST['categorie'])) {
//                    $_POST['categorie'] = null;
//                }


        if (isset($params["negotiation"]) && ($_POST['negotiation'] !== '')) {
            $filtre .= ($filtre == "" ? "" : " AND ") . "location = '" . $params["negotiation"] . "'";
            //$_POST['negotiation'] = $params["negotiation"];
        }
        else {
            //$_POST['negotiation'] = null;
        }
        $donnees['jeux'] = $modeleJeux->filtreJeux($filtre);
        //var_dump($donnees['jeux']);
        $this->afficherVues("rechercher", $donnees);
    }
}