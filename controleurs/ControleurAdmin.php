
<?php
/**
 * @file      ControleurMembres.php
 * @author    Chunliang He, Guilherme Tosin, Jansy López, Marcelo Guzmán
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Définit la classe pour le controleur membres
 * @details   Cette classe définit les différentes activités concernant aux membres inscrits sur le site
 */

class ControleurAdmin extends BaseControleur
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
        $modeleAdmin= $this->lireDao("Admin");

        $modeleLocation= $this->lireDao("Location");


        /**
         *  test begin
         */

//        http://www.projet.com/projetweb2/index.php?Admin&action=afficherLocation#v-pills-settings
//
//
//        $donnees['location'] = $modeleLocation->lireDetaileLocation();
//        var_dump($donnees);


        /**
         * test fin
         */


        $donnees["erreur"] = "";
        $_SESSION["msg"]="";

        if (isset($params["action"])) {

            switch ($params["action"]) {

                case "afficherMembres" :
                    $this->afficherAdmin();
                break;

                case "validerMembre" :
                    if (isset($params['membre_id'])) {
//                        echo $params['membre_id'];
                        $modeleMembres->validerMembre($params['membre_id']);
                    }
                    $this->afficherAdmin();
                break;

                case "bannirMembre" :
                    if (isset($params['membre_id'])) {
//                        echo $params['membre_id'];
                        $modeleMembres->bannirMembre($params['membre_id']);
                    }
                    $this->afficherAdmin();
                    break;

                case "reactiverMembre" :
                    if (isset($params['membre_id'])) {
//                        echo $params['membre_id'];
                        $modeleMembres->reactiverMembre($params['membre_id']);
                    }
                    $this->afficherAdmin();
                    break;

                case "promouvoirMembre" :
                    if (isset($params['membre_id'])) {
//                        echo $params['membre_id'];
                        $modeleMembres->promouvoirMembre($params['membre_id']);
                    }
                    $this->afficherAdmin();

                    break;

                case "demouvoirMembre" :
                    if (isset($params['membre_id'])) {
//                        echo $params['membre_id'];
                        $modeleMembres->demouvoirMembre($params['membre_id']);
                    }
                    $this->afficherAdmin();
                    break;

//------------- Admin location------------------------------------------------------------------------------------------
                case "afficherLocation" :
                    $this->afficherLocation();
                    break;

                default:
                    trigger_error($params["action"] . " Action invalide.");
            }
        } else {
            var_dump("No");
        }
    }

    public function afficherAdmin() {
        $modeleMembres = $this->lireDAO("Membres");

        $donnees['membres'] = $modeleMembres->obtenirTous();
        $this->afficherVues("admin", $donnees);
    }

    public function afficherLocation() {
       $modeleLocation = $this->lireDao("Location");
       $donnees['location'] = $modeleLocation->lireDetaileLocation();
       $this->afficherVues("admin", $donnees);
    }
}



?>






































