<?php
/**
 * @file      ControleurMessagerie.php
 * @author    Jansy Lopes
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Définit la classe pour le controleur messagerie
 * @details   Cette classe définit les différentes activités concernant aux messagerie
 */

class ControleurMessagerie extends BaseControleur {
    /**
     * @brief   Méthode qui sera appelée par les controleurs
     * @details Méthode abstraite pour traiter les "cases" des contrôleurs
     * @param   [array] $params La chaîne de requête URL ("query string") captée par le Routeur.php
     * @return  L'acces aux vues,aux données et aux différents messages pour ce contrôleur.
     */

    public function index(array $params) {

        $modeleMessagerie = $this->lireDAO("Messagerie");
        $modeleDestinataire = $this->lireDAO("Destinataire");
        $modeleMembre = $this->lireDAO("Membres");

        $donnees["erreur"] = "";

        if (isset($params["action"])) {

            switch($params["action"]) {

                case "afficherMessagerie" :
                    if (isset($_SESSION["id"])) {
                        $donnees['messages'] = "";
                        $donnees['messagesEnvoyes'] = $modeleMessagerie->obtenirTousEnvoyeParMembreId($_SESSION["id"]);
                        $donnees['messagesRecu'] = $modeleMessagerie->obtenirTousRecuParMembreId($_SESSION["id"]);
                        foreach($donnees['messagesRecu'] as $recu) {
                            $donnees['expediteurs'][] = $modeleMembre->obtenirParId($recu->getMembreId());                  
                        }
                    }
                    else {
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
                    if (isset($params['membre_id']) && isset($params['destinataire_id']) && isset($params['sujet']) && isset($params['message'])) {
                        $attachement =  isset($params['attachement']) ? $params['attachement'] : "";
                        (string)$date = date("Y-m-d h:i:s");
                        // ($msg_id = "", $membre_id = "", $sujet = "", $message = "", $attachement = "", $msg_date = "", $msg_envoye = 0, $msg_lu = 0, $msg_actif = 1)
                        $message = new Messagerie(0, $params['membre_id'], $params['sujet'], $params['message'], $attachement, $date, 0, 0, 1);
                        $msg_id = $modeleMessagerie->sauvegarde($message);
                        $destinataire = new Destinataire($params['destinataire_id'], $msg_id);
                        $modeleDestinataire->sauvegarde($destinataire);
                        // echo "success";
                        $donnees['messages'] = $modeleMessagerie->obtenirTousParMembreId($_SESSION["id"]);
                        if (isset($params['msg_id']) && isset($params['sujet']) && isset($params['message'])) {
                            (string)$date = date("Y-m-d h:i:s");
                            // ($msg_id = "", $membre_id = "", $sujet = "", $message = "", $attachement = "", $msg_date = "", $msg_envoye = 0, $msg_lu = 0, $msg_actif = 1)
                            $message = new Messagerie($params['msg_id'], $_SESSION["id"], $params['sujet'],  $params['message'], $attachement, $date, 0, 0, 1);
                            $id = $modeleMessagerie->sauvegarde($message);
                        }
                        $this->afficherVues("messagerie", $donnees);
                    }
                    else {
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