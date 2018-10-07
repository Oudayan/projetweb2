<?php

/**
 * @file      ControleurMembres.php
 * @author    Chunliang He, Guilherme Tosin, Jansy López, Marcelo Guzmán
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Définit la classe pour le controleur membres
 * @details   Cette classe définit les différentes activités concernant aux membres inscrits sur le site
 */
class ControleurAchat extends BaseControleur {

    /**
     * @brief   Méthode qui sera appelée par les controleurs
     * @details Méthode pour évaluer les "cases" du contrôleurs
     * @param   [array] $params La chaîne de requête URL ("query string") captée par le fichier Routeur.php
     * @return  L'acces aux vues, aux donnes
     */
    public function index(array $params) {
        $modeleJeux = $this->lireDAO("Jeux");
        $modeleImages = $this->lireDAO("Images");
        $modeleAchat = $this->lireDAO("Achat");

        $donnees["erreur"] = "";
        $_SESSION["msg"] = "";

        if (isset($params["action"])) {

            switch ($params["action"]) {
                case "afficherPanier" :
                    $this->afficherVues("achat");
                    break;
                case "payerPanier" :
                    (string) $date = date("Y-m-d");
                    foreach ($_SESSION["cart"] as $jeux) {
                        $achat = new Achat(null, '3', $_SESSION["id"], $jeux->getJeuxId(), $date, $params['transaction_id']);
                        $modeleAchat->sauvegarde($achat);
                    }
                    $i = 0;
                    foreach ($_SESSION["cart"] as $jeux) {
                            array_splice($_SESSION["cart"], $i, 1);
                            array_splice($_SESSION["cartImages"], $i, 1);
                        $i++;
                    }
                    echo "success";
                    break;
                case "acheter" :
                    if (isset($params['jeux_id'])) {
                        $jeuxAchete = $modeleJeux->lireJeuParId($params['jeux_id']);
                        array_push($_SESSION["cart"], $jeuxAchete);
                        $imageJeuxAchete = $modeleImages->lireImagesParJeuxId($params["jeux_id"]);
                        array_push($_SESSION["cartImages"], $imageJeuxAchete[0]->getCheminPhoto());
                        echo sizeof($_SESSION["cart"]);
                    } else {
                        $_SESSION['msg'] = "Remplissez les produit...";
                        var_dump($_SESSION['msg']);
                    }
                    break;
                case "supprimer" :
                    if (isset($params['jeux_id'])) {
                        $i = 0;
                        foreach ($_SESSION["cart"] as $jeux) {
                            if ($jeux->getJeuxId() == $params['jeux_id']) {
                                array_splice($_SESSION["cart"], $i, 1);
                                array_splice($_SESSION["cartImages"], $i, 1);
                                break;
                            }
                            $i++;
                        }
                        echo sizeof($_SESSION["cart"]);
                    } else {
                        $_SESSION['msg'] = "Remplissez les produit...";
                        var_dump($_SESSION['msg']);
                    }
                    break;

                default:
                    trigger_error($params["action"] . " Action invalide.");
            }
        } else {
            $_SESSION['msg'] = "Erreur";
        }
    }

}
