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
                    $donnees['messages'] = $modeleMessagerie->obtenirTousParMembre_Id($_SESSION["id"]);

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
                  if (isset($_POST['membre_id']) && isset($_POST['destinataire_id']) && isset($_POST['sujet']) && isset($_POST['message']))
                  {
                      (string)$date = date("Y-m-d");
                      // $jeux_id = 0, $plateforme_id = 1, $membre_id = "", $titre = "", $prix = "", $date_ajout = "", $concepteur = "", $location = "", $jeux_valide = false, $jeux_actif = true, $description = "", $evaluation_globale= ""
                      $message = new Messagerie(null, $_POST['membre_id'], $_POST['sujet'],  $_POST['message'] , $date, true);
                      $msg_id = $modeleMessagerie->sauvegarde($message);
                      $destinataire = new Destinataire($_POST['destinataire_id'], $msg_id);
                      $modeleDestinataire->sauvegarde($destinataire);
                      echo "success";
                  }

                  else
                  {
                      echo 'Remplissez tous les champs...';
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
