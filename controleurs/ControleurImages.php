
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
                    if(isset( $_SESSION['id']))
                    {
                        // var_dump($params);
                        $dir = 'images/Jeux/tmp' . $_SESSION['id'];
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
                                echo "<img src='" . $cheminImage[$key] . "' class='img-fluid'>";
                                echo "<input type='text'  id='inputImage" . $params["Id"] . "' name='cheminsImages[]' value='" . $cheminImage[$key] . "' hidden />";
                            }
                        }
                        
                        
                        /* var_dump($_FILES["files"]["name"]);
                        var_dump($_FILES["files"]["type"]);
                        var_dump($_FILES["files"]["tmp_name"]);
                        var_dump($_FILES["files"]["error"]);
                        var_dump($_FILES["files"]["size"]); */ 
                    }
                        
                
                break;
                case "deleteFichierImage" :
                    // var_dump($params);
                    $fichier = $params['files'][0];
                    $solo = RACINE . strstr($fichier,"images/");
                    // var_dump($solo);
                    unlink($solo);
                
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