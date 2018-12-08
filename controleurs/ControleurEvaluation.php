
<?php
/**
 * @file      ControleurEvaluation.php
 * @author    Oudayan Dutta
 * @version   1.0.0
 * @date      Octobre 2018
 * @brief     Définit la classe pour le controleur des Evaluation
 * @details   Cette classe définit les différentes activités concernant les évaluations et évaluations des jeux
 */

    class ControleurEvaluation extends BaseControleur {

        /**
         * @brief   Méthode qui sera appelée par les controleurs
         * @details Méthode pour évaluer les "cases" du contrôleurs
         * @param   [array] $params La chaîne de requête URL ("query string") captée par le fichier Routeur.php
         * @return  L'acces aux vues, aux donnees
         */
        public function index(array $params) {
            $modeleEvaluation = $this->lireDAO("Evaluation");
            $modeleJeux = $this->lireDAO("Jeux");
            $modeleMembres = $this->lireDAO("Membres");

            $donnees["erreur"] = "";
            $_SESSION["msg"]="";

            if (isset($params["action"])) {

                switch ($params["action"]) {

                    case "afficherEvaluation" :
                        $donnees = $this->afficherEvaluation($params);
                        $this->afficherVues("evaluation", $donnees);
                        break;

                    case "sauvegarderEvaluation" :
                        $this->sauvegarderEvaluation($params);
                        // $donnees = $this->afficherEvaluation($params);
                        // $this->afficherVues("evaluation", $donnees);
                        header("location:index.php?Messagerie&action=afficherMessagerie");
                        break;

                    case "deleteEvaluation" :
                        break;

                    default:
                        header("location:index.php");
                }
            }
            else {
                header("location:index.php");
            }
        }

    }

?>