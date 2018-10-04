
<?php
/**
 * @file      ControleurImages.php
 * @author    Chunliang He, Guilherme Tosin, Jansy López, Marcelo Guzmán
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Définit la classe pour le controleur membres
 * @details   Cette classe définit les différentes activités concernant aux membres inscrits sur le site
 */

class ControleurImages extends BaseControleur
{
    /**
     * @brief   Méthode qui sera appelée par les controleurs
     * @details Méthode pour évaluer les "cases" du contrôleurs
     * @param   [array] $params La chaîne de requête URL ("query string") captée par le fichier Routeur.php
     * @return  L'acces aux vues, aux donnes
     */

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
        $_SESSION["msg"]="";

        if (isset($params["action"])) {

            switch ($params["action"]) {

                case "afficherImages" :
                    //var_dump($params);
                    //var_dump($_FILES["files"]["tmp_name"][0]);
                    echo "<img src='" . $_FILES["files"]["tmp_name"][0] . "'/>";
                    break;
            
                case "sauvegardeFichiersImages" :
                    // if(isset($params['jeux_id']))
                    // {
                    //     $jeux_id = $params["jeux_id"];
                        // var_dump($params["jeux_id"]);
                        // $dir = '../images/Jeux/1';
                        $dir = 'images/Jeux/test';
                        if (!is_dir($dir))
                                mkdir ($dir,0777); 
                        $chemin = $dir . '/';
                        $cheminImage = [];
                        // var_dump($_FILES);
                        
                        foreach ($_FILES["files"]["error"] as $key => $error) {
                            if ($error == UPLOAD_ERR_OK) {
                                $name = $_FILES["files"]["name"][$key];
                                move_uploaded_file( $_FILES["files"]["tmp_name"][$key], $chemin . $_FILES['files']['name'][$key]);
                                $cheminImage[] = $chemin . $_FILES['files']['name'][$key];
                            }
                        }
                        // echo "<input type='file' name='image' value='" . $chemin . "/>";
                        echo "<input type='text' name='path' value='" . $cheminImage[0] . "' hidden>"; 
                        echo "<img src='" . $cheminImage[0] . "' class='img-fluid'/>";
                        //var_dump($cheminImage);
                        
                        /* var_dump($_FILES["files"]["name"]);
                        var_dump($_FILES["files"]["type"]);
                        var_dump($_FILES["files"]["tmp_name"]);
                        var_dump($_FILES["files"]["error"]);
                        var_dump($_FILES["files"]["size"]); */ 
                    //}
                        
                
                break;
                case "deleteFichierImage" :
                
                    $fichier = $_POST['files'][0];
                    $solo = strstr($fichier,"/images/");
                    $solo1 = ".." . $solo ;
                    var_dump($solo1);
                                unlink($solo1);
                
                    /* var_dump($_FILES["files"]["name"]);
                    var_dump($_FILES["files"]["type"]);
                    var_dump($_FILES["files"]["tmp_name"]);
                    var_dump($_FILES["files"]["error"]);
                    var_dump($_FILES["files"]["size"]); */               
                break;

                default:
                    trigger_error($params["action"] . " Action invalide.");
            }
        } else {
            var_dump("No");
        }
    }

    

}