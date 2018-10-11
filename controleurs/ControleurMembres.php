<?php
/**
 * @file      ControleurMembres.php
 * @author    Chunliang He, Guilherme Tosin, Jansy López, Marcelo Guzmán
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Définit la classe pour le controleur membres
 * @details   Cette classe définit les différentes activités concernant aux membres inscrits sur le site
 */

class ControleurMembres extends BaseControleur
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
        $_SESSION["msg"] = "";


        if (isset($params["action"])) {

            switch ($params["action"]) {

                case "afficherMembre":
                    $donnees['derniers'] = $modeleJeux->lireDerniersJeux();
                    $donnees['images'] = $modeleImages->lireDerniersImages();
                    $this->afficherVues("accueil", $donnees);
                break;

                case "formAjoutMembre":
                    $donnees = $this->troisDerniers($donnees);
                    $this->afficherVues("ajoutMembre", $donnees);
                break;

                case "formModifierMembre":
                    if(isset($_SESSION['id']))
                    {
                        if(isset($params['membreId']) && ($_SESSION['type'] == 2 || $_SESSION['type'] == 3))
                        {
                            $donnees['membre'] = $modeleMembres->obtenirParId($params['membreId']);
                        }
                        else 
                        {
                            $donnees['membre'] = $modeleMembres->obtenirParId($_SESSION['id']);
                        } 
                        $donnees = $this->troisDerniers($donnees);
                        $this->afficherVues("ajoutMembre", $donnees);
                    }
                break;

                case "enregistrerMembre" :
                    // echo "<pre>";
                    // var_dump($params);
                    // echo "</pre>";
                    // if (isset($params['membre_id']) && isset($params['type_utilisateur_id']) && isset($params["courriel"]) && isset($params["mot_de_passe"]) && $params["confirm_mdp"] && isset($params["nom"]) && isset($params["prenom"]) && isset($params["adresse"]) && isset($params["telephone"]) && isset($params['membre_valide']) && isset($params['membre_actif']))
                    if (isset($params['membre_id']) && isset($params["courriel"]) && isset($params["mot_de_passe"]) && $params["confirm_mdp"] && isset($params["nom"]) && isset($params["prenom"]) && isset($params["adresse"]) && isset($params["telephone"]))
                        {
                        // Si une modification de membre, aller xhercher les valeurs de type_utilisateu_id, membre_valide & membre_actif
                        if (isset($params['membre_id']) && $params['membre_id'] > 0) {
                            $membreUpdate = $modeleMembres->obtenirParId($params['membre_id']);
                            $type = $membreUpdate->getTypeUtilisateur();
                            $valide = $membreUpdate->getMembreValide();
                            $actif = $membreUpdate->getMembreActif();
                        }
                        else
                        {
                            // À faire: Vérification si le courriel existe déjà ans la BD
                            $type = 1;
                            $actif = 1;
                            $valide = 0;
                        }
                        // comparer les mot de passe sont pareils.
                        if($params["mot_de_passe"] == $params["confirm_mdp"])
                        {
                            // $membre_id = 0, $type_utilisateur_id = 1, $nom = "", $prenom = "", $mot_de_passe = "", $adresse = "", $telephone = "", $courriel = "", $membre_valide = 0, $membre_actif = 1)
                            $membre = new Membres($params['membre_id'], $type, $params["nom"], $params["prenom"], $params["mot_de_passe"], $params["adresse"], $params["telephone"], $params["courriel"], $valide, $actif);
                            if(isset($_SESSION['id']) && $_SESSION['id'] == $params['membre_id']){
                                $_SESSION['prenom'] = $params["prenom"];
                                $_SESSION['nomComplet'] = $params["prenom"] . " " . $params["nom"];
                            }
                            // Sauvegarde de l'objet $membre
                            $id = $modeleMembres->sauvegarde($membre);
                            $_SESSION["msg"] = "Votre profil est enregistré !";
                        }
                        else
                        {
                            $_SESSION["msg"] = "Champ requis. Le mot de passe de confirmation est différent du mot de passe saisi.";
                        }
                    }
                    else
                    {
                        $_SESSION["msg"] = "Remplissez tous les champs...";
                        // $this->afficherVues("ajouteUnMembre");
                    }
                    header("location:index.php");
                    break;

                case "verifierLogin" :
                    if (isset($params["courriel"]) && isset($params["mot_de_passe"])) {
                        $modeleMembres = $this->lireDAO("Membres");
                        $donnees = $modeleMembres->obtenirParCourriel($params["courriel"]);
                        if ($donnees) {
                            // Comparaison entre les données reçues et ceux de la BD
                            // if ($donnees->getCourriel() == $params["courriel"]  && $donnees->getMotDePasse() == md5($params["mot_de_passe"] )) {
                            if ($donnees->getCourriel() == $params["courriel"] && $donnees->getMotDePasse() == $params["mot_de_passe"]) {
                                if($donnees->getMembreValide() == 1 ){
                                    if($donnees->getMembreActif() == 1 ){
                                        $_SESSION["id"] = $donnees->getMembreId();
                                        $_SESSION["courriel"] = $params["courriel"];
                                        $_SESSION["type"] = $donnees->getTypeUtilisateur();
                                        $_SESSION["cart"] = [];
                                        $_SESSION["cartImages"] = [];
                                        $_SESSION["msg"] = "Bienvenue ! " . $donnees->getPrenom() . " ";
                                        $_SESSION['prenom'] = $donnees->getPrenom();
                                        $_SESSION['nomComplet'] = $donnees->getPrenom() . " " . $donnees->getNom();
                                    }
                                    else{
                                        $_SESSION["msg"] = "Vous êtes présentement bannis du site. Veuillez contacter l'administrateur pour plus de détails.";
                                    }
                                }
                                else
                                {
                                    $_SESSION["msg"] = "Votre compte n'est pas encore activé. Vous serez contacté par l'administrateur quand votre compte sera validé.";
                                }
                            }
                            else
                            {
                                $_SESSION["msg"] = "Le courriel ou le mot de passe ne sont pas corrects.";
                            }
                        }
                        else
                        {
                            $_SESSION["msg"] = "Ce courriel n'existe pas dans la base de données.";
                        }
                    }
                    else
                    {
                        $_SESSION["msg"] = "Veuillez remplir le courriel et le mot de passe !";
                    }
                    // Redirection selon type de membre
                    if(isset($_SESSION["type"]) && $_SESSION["type"] == 1){
                        header("location:index.php?Jeux&action=gererMesJeux");
                    }
                    else if(isset($_SESSION["type"]) && ($_SESSION["type"] == 2 || $_SESSION["type"] == 3)) {
                        header("location:index.php?Admin&action=afficherAdmin");
                    }
                    else
                    {
                        header("location:index.php");
                    }
                    break;

                case  "logout":
                    if (isset($_SESSION["id"])) {
                        unset($_SESSION["id"]);
                        setcookie("id", null, -1, '/');
                    }
                    if (isset($_SESSION["courriel"])) {
                        unset($_SESSION["courriel"]);
                        setcookie("courriel", null, -1, '/');
                    }
                    if (isset($_SESSION["type"])) {
                        unset($_SESSION["type"]);
                        setcookie("type", null, -1, '/');
                    }
                    if (isset($_SESSION["msg"])) {
                        unset($_SESSION["msg"]);
                        setcookie("msg", null, -1, '/');
                    }
                    if (isset($_SESSION["cart"])) {
                        unset($_SESSION["cart"]);
                        setcookie("cart", null, -1, '/');
                    }
                    if (isset($_SESSION["cartImages"])) {
                        unset($_SESSION["cartImages"]);
                        setcookie("cartImages", null, -1, '/');
                    }
                    header("location:index.php");
                    break;

                default:
                    header("location:index.php");
            }
        } else {
            header("location:index.php");
        }
    }

    public function troisDerniers($donnees){
        $modeleJeux = $this->lireDAO("Jeux");
        $modeleImages = $this->lireDAO("Images");
        $donnees['trois'] = $modeleJeux->lireDerniersJeux(12);
        foreach($donnees['trois'] as $derniers ){
            if ($modeleImages->lireImageParJeuxId($derniers->getJeuxId())) {
                $donnees['imagesTrois'][] = $modeleImages->lireImageParJeuxId($derniers->getJeuxId());
            }
            else {
                $donnees['imagesTrois'][] = new Images(0, $derniers->getJeuxId(), 'images/image_defaut.png');
            }
        }
        return $donnees;
    }
}