
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
                        if (isset($params["jeton"])) {
                            $evaluation = $modeleEvaluation->lireEvaluationParJeton($params["jeton"]);
                            if ($evaluation) {
                                // Vérifier que le membre qui a fait la transaction ou un admin sont les seuls à accéder à l'évaluation
                                if (isset($_SESSION["id"]) && ($_SESSION["id"] == $evaluation->getMembreId() || $_SESSION["type"] == 2 || $_SESSION["type"] == 3)) {
                                    (string) $date = date("Y-m-d H:i:s");
                                    // ($evaluation_id = 0, $jeton = "", $jeux_id = 0, $membre_id = 0, $achat_id = 0, $location_id = 0, $commentaire_jeu = "", $commentaire_membre = "", $evaluation_jeu = -1, $evaluation_membre = -1, $date_evaluation = "", $evaluation_jeu_active = 1, $evaluation_membre_active = 1)
                                    $modifierEvaluation = new Evaluation($evaluation->getEvaluationId(), 0, 0, 0, 0, 0, $params["commentaireJeu"], $params["commentaireMembre"], $params["evaluationJeu"], $params["evaluationMembre"], $date);
                                    $modeleEvaluation->sauvegarde($modifierEvaluation);
                                    // Calculer l'évaluation globale du jeu
                                    $evaluationsJeu = $modeleEvaluation->lireEvaluationsParJeu($evaluation->getJeuxId());
                                    $evalTotaleJeu = 0;
                                    $nbJeux = 0;
                                    foreach ($evaluationsJeu as $evaluationJeu) {
                                        if ($evaluationJeu->getEvaluationJeu() >= 0) {
                                            $evalTotaleJeu += $evaluationJeu->getEvaluationJeu();
                                            $nbJeux++;
                                        }
                                    }
                                    if ($nbJeux > 0) {
                                        $evalMoyenneJeu = $evalTotaleJeu / $nbJeux;
                                        // Mettre à jour l'évaluation globale du jeu
                                        $modeleJeux->updateEvaluationJeu($evaluation->getJeuxId(), $evalMoyenneJeu);
                                    }
                                    // Calculer l'évaluation globale du membre propriétaire du jeu
                                    $evaluationsMembre = $modeleEvaluation->lireEvaluationsParMembre($evaluation->getMembreId());
                                    $evalTotaleMembre = 0;
                                    $nbMembre = 0;
                                    foreach ($evaluationsMembre as $evaluationMembre) {
                                        if ($evaluationMembre->getEvaluationMembre() >= 0) {
                                            $evalTotaleMembre += $evaluationMembre->getEvaluationMembre();
                                            $nbMembre++;
                                        }
                                    }
                                    if ($nbMembre > 0) {
                                        $evalMoyenneMembre = $evalTotaleMembre / $nbMembre;
                                        // Chercher les données du membre propriétaire du jeu
                                        $jeu = $modeleJeux->lireJeuParId($evaluation->getJeuxId());
                                        // Mettre à jour l'évaluation globale du membre
                                        $modeleMembres->updateEvaluationMembre($jeu->getMembreId(), $evalMoyenneMembre);
                                    }
                                    $_SESSION["msg"]="L'évaluation a été sauvegardée avec succès!";
                                }
                            }
                            else {
                                $donnees["erreur"] = "Vous n'avez pas la permission de modifier cette évaluation.";
                            }
                        }
                        else {
                            $donnees["erreur"] = "Cette évaluation n'existe pas.";
                        }
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

        public function afficherEvaluation($params) {
            $modeleEvaluation = $this->lireDAO("Evaluation");
            $modeleJeux = $this->lireDAO("Jeux");
            $modeleMembres = $this->lireDAO("Membres");
            $modeleLocation = $this->lireDAO("Location");
            $modeleAchat = $this->lireDAO("Achat");
            $donnees["erreur"] = "";
            $_SESSION["msg"]="";
            if (isset($params["jeton"])) {
                $donnees["evaluation"] = $modeleEvaluation->lireEvaluationParJeton($params["jeton"]);
                if ($donnees["evaluation"]) {
                    // Chercher les données du membre qui a fait la transaction (évaluateur)
                    $donnees["membre"] = $modeleMembres->obtenirParId($donnees["evaluation"]->getMembreId());
                    // Vérifier que le membre qui a fait la transaction ou un admin sont les seuls à accéder à l'évaluation
                    if (isset($_SESSION["id"]) && ($_SESSION["id"] == $donnees["membre"]->getMembreId() || $_SESSION["type"] == 2 || $_SESSION["type"] == 3)) {
                        // Chercher les données du jeu loué/vendu
                        $donnees["jeu"] = $modeleJeux->lireJeuParId($donnees["evaluation"]->getJeuxId());
                        $donnees = $this->chercherImages($donnees, "jeu");
                        // Chercher les données du membre propriétaire du jeu
                        $donnees["proprietaire"] = $modeleMembres->obtenirParId($donnees["jeu"]->getMembreId());
                        // Vérifier si c'est une location ou un achat
                        if ($donnees["evaluation"]->getLocationId() != NULL) {
                            $donnees["transaction"] = $modeleLocation->lireLocationParId($donnees["evaluation"]->getLocationId());
                            $limite = new DateTime($donnees["transaction"]->getDateRetour());
                        }
                        if ($donnees["evaluation"]->getAchatId() != NULL) {
                            $donnees["transaction"] = $modeleAchat->lireAchatParId($donnees["evaluation"]->getAchatId());
                            $limite = new DateTime($donnees["transaction"]->getDateAchat());
                        }
                        // Calculer la date limite de l'évaluation (1 semaine après la date de retour ou d'achat)
                        $limite->add(new DateInterval('P7D')); 
                        // Vérifier que la date limite de l'évaluation n'est pas passée
                        if (new DateTime('NOW') <= $limite || $_SESSION["type"] == 2 || $_SESSION["type"] == 3) {
                            $donnees["dateLimite"] = $limite;
                        }
                        else {
                            $donnees["erreur"] = "Évaluation fermée. La date limite de cette évaluation est passée.";
                        }
                    }
                    else {
                        $donnees["erreur"] = "Vous n'avez pas accès à cette évaluation.";
                    }
                }
                else {
                    $donnees["erreur"] = "Cette évaluation n'existe pas.";
                }
            }
            else {
                $donnees["erreur"] = "Cette évaluation n'existe pas.";
            }
            return $donnees;
        }

    }

?>