<?php
/**
 * @file      ControleurMessagerie.php
 * @author    Jansy Lopes
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Définit la classe pour le controleur messagerie
 * @details   Cette classe définit les différentes activités concernant aux messagerie
 */

class ControleurMessagerie extends BaseControleur
    /**
     * @brief   Méthode qui sera appelée par les controleurs
     * @details Méthode abstraite pour traiter les "cases" des contrôleurs
     * @param   [array] $params La chaîne de requête URL ("query string") captée par le Routeur.php
     * @return  L'acces aux vues,aux données et aux différents messages pour ce contrôleur.
     */
{
    public function index(array $params)
    {
        $modeleMessagerie = $this->lireDAO("Messagerie");
        $modeleDestinataire = $this->lireDAO("Destinataire");
        $modeleJeux = $this->lireDAO("Membres");

        $donnees["erreur"] = "";

        if (isset($params["action"]))
        {
            switch($params["action"])
            {
                case "afficherMessagerie" :
                    if (isset($_SESSION["id"]))
                    {
                        $donnees['messages'] = "";
                        $donnees['messagesEnvoyes'] = $modeleMessagerie->obtenirTousEnvoyeParMembre_Id($_SESSION["id"]);
                        $donnees['messagesRecu'] = $modeleMessagerie->obtenirTousRecuParMembre_Id($_SESSION["id"]);
                    /*  foreach ($donnees['sujet'] as $sujet){
                            $donnees['sujet']['messagerie'][] = $modeleMembres->obtenirParId($sujet->getMembreId());
                        }*/
                    }
                    else
                    {
                        $donnees["erreur"] = "Ce Sujet n'existe pas.";
                    }
                    $this->afficherVues("messagerie", $donnees);
                    break;

                case "afficherMessage" :
                    //$donnees['messages'] = $modeleMessagerie->obtenirTousParMembre_Id($_SESSION["id"]);
                    if(isset($params["msg_id"]))
                    {
                        $this->afficherVues("messagerie", $donnees);
                    }
                    break;

                case "formAjoutMessage" :
                    if (isset($params['membre_id']) && isset($params['destinataire_id']) && isset($params['sujet']) && isset($params['message']))
                    {
                        (string)$date = date("Y-m-d");
                        $message = new Messagerie(null, $params['membre_id'], $_POST['sujet'],  $_POST['message'] , $date, true);
                        $msg_id = $modeleMessagerie->sauvegarde($message);
                        $destinataire = new Destinataire($_POST['destinataire_id'], $msg_id);
                        $modeleDestinataire->sauvegarde($destinataire);
                        echo "success";

                        $donnees['messages'] = $modeleMessagerie->obtenirTousParMembre_Id($_SESSION["id"]);
                        if (isset($_POST['msg_id']) && isset($_POST['sujet']) && isset($_POST['message']))
                        {
                            (string)$date = date("Y-m-d");
                            $message = new Messagerie($_POST['msg_id'], $_SESSION["id"], $_POST['sujet'],  $_POST['message'] ,   $date, true);
                            $id = $modeleMessagerie->sauvegarde($message);
                        }
                        $this->afficherVues("messagerie", $donnees);
                    }
                    else
                    {
                        $_SESSION['msg'] ="Remplissez tous les champs...";
                        // $this->afficherVues("maPage", $donnees);
                        var_dump($_SESSION['msg']);
                    }

                    // $donnees['jeux'] = $$modeleJeux->sauvegarderJeux();
                    // $donnees['categoriesJeu'] = $modeleCategoriesJeux->sauvegarderCategoriesJeu();
                    // $this->afficherVues("maPage", $donnees);
                    //$this->filtrerJeux($params);
                    break;

                }
            }
        }
    }