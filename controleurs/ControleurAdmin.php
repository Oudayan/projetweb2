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
        $modelePlatformes = $this->lireDAO("Plateformes");
        $modeleLocation = $this->lireDao("Location");


        $donnees["erreur"] = "";
        $_SESSION["msg"] = "";

        if (isset($params["action"])) {

            switch ($params["action"]) {

                case "afficherAdmin" :
                    $this->afficherAdmin();
                    break;

                case "validerMembre" :
                    if (isset($params['membre_id'])) {
                        $modeleMembres->validerMembre($params['membre_id']);
                    }
                    $this->afficherAdmin(1);
                    break;

                case "bannirMembre" :
                    if (isset($params['membre_id'])) {
                        $modeleMembres->bannirMembre($params['membre_id']);
                    }
                    $this->afficherAdmin(1);
                    break;

                case "reactiverMembre" :
                    if (isset($params['membre_id'])) {
                        $modeleMembres->reactiverMembre($params['membre_id']);
                    }
                    $this->afficherAdmin(1);
                    break;

                case "promouvoirMembre" :
                    if (isset($params['membre_id'])) {
                        $modeleMembres->promouvoirMembre($params['membre_id']);
                    }
                    $this->afficherAdmin(1);

                    break;

                case "demouvoirMembre" :
                    if (isset($params['membre_id'])) {
                        $modeleMembres->demouvoirMembre($params['membre_id']);
                    }

                    $this->afficherAdmin(1);
                    break;

//------------- Admin jeux------------------------------------------------------------------------------------------
                case "validerJeu" :
                    if (isset($params['jeux_id'])) {//
                        $modeleJeux->validerJeu($params['jeux_id']);
                    }
                    $this->afficherAdmin(2);
                    break;

                case "activerJeu" :
                    if (isset($params['jeux_id'])) {
                        $modeleJeux->activerJeu($params['jeux_id']);
                    }
                    $this->afficherAdmin(2);
                    break;

                case "desactiverJeu" :
                    if (isset($params['jeux_id'])) {
                        $modeleJeux->desactiverJeu($params['jeux_id']);
                    }
                    $this->afficherAdmin(2);
                    break;

                case "bannirJeu" :
                    if (isset($params['jeux_id'])) {
                        $modeleJeux->bannirJeu($params['jeux_id']);
                    }
                    $this->afficherAdmin(2);
                    break;

                case "debannirJeu" :
                    if (isset($params['jeux_id'])) {
                        $modeleJeux->debannirJeu($params['jeux_id']);
                    }
                    $this->afficherAdmin(2);
                    break;

//--------------Admin gérer les menus--------------------------------------------------------------------------
                case "sauvegarderCategorie" :
                    if (isset($params['categorie_id']) && isset($params['categorie']) && isset($_SESSION["id"]) && ($_SESSION["type"] == 2 || $_SESSION["type"] == 3)) {
                        $uneCategorie = new Categories($params['categorie_id'], $params['categorie']);
                        $modeleCategories->sauvegarder($uneCategorie);
                    }
                    else {
                        $_SESSION["msg"] = "Remplissez tous les champs...";
                    }
                    $this->afficherAdmin(4);
                    break;

                case "sauvegarderPlateforme" :
                    if (isset($params['plateforme_id']) && isset($params['plateforme']) && isset($_SESSION["id"]) && ($_SESSION["type"] == 2 || $_SESSION["type"] == 3)) {
                        $unePlatforme = new Plateformes($params['plateforme_id'], $params['plateforme']);
                        $modelePlatformes->sauvegarder($unePlatforme);
                    }
                    else {
                        $_SESSION["msg"] = "Remplissez tous les champs...";
                    }
                    $this->afficherAdmin(4);
                    break;

                default:
                    $this->afficherAdmin();
            }
        } else {
            header("location:index.php");

        }
    }

    public function afficherAdmin($tab = 1)
    {
        $modeleJeux = $this->lireDAO("Jeux");
        $modelePlateformes = $this->lireDAO("Plateformes");
        $modeleCategories = $this->lireDAO("Categories");
        $modeleMembres = $this->lireDAO("Membres");
        $modeleLocation = $this->lireDao("Location");
        $modeleAchat = $this->lireDao("Achat");
        $modeleTypePaiement = $this->lireDao("TypePaiement");

        $donnees["tab"] = $tab;
        $donnees['membres'] = $modeleMembres->obtenirTous();
        foreach ($donnees['membres'] as $membre) {
            $donnees['typeMembre'][] = $modeleMembres->obtenirRole($membre->getTypeUtilisateur());
        }
        $donnees['jeux'] = $modeleJeux->lireTousLesJeux();
        $donnees = $this->chercherImages($donnees);
        foreach ($donnees['jeux'] as $jeu) {
            $donnees['membreJeu'][] = $modeleMembres->obtenirParId($jeu->getMembreId());
        }
        $donnees['locations'] = $modeleLocation->lireToutesLesLocations();
        for ($i = 0; $i < count($donnees['locations']); $i++) {
            $donnees['membreLocation'][$i] = $modeleMembres->obtenirParId($donnees['locations'][$i]->getMembreId());
            $donnees['jeuLocation'][$i] = $modeleJeux->lireJeuParId($donnees['locations'][$i]->getJeuxId());
            $donnees['proprietaireJeuLocation'][$i] = $modeleMembres->obtenirParId($donnees['jeuLocation'][$i]->getMembreId());
            $donnees['typePaiementLocation'][$i] = $modeleTypePaiement->lireTypePaiementParId($donnees['locations'][$i]->getTypePaiementId());
        }
        $donnees['achats'] = $modeleAchat->lireTousLesAchats();
        for ($i = 0; $i < count($donnees['achats']); $i++) {
            $donnees['membreAchat'][$i] = $modeleMembres->obtenirParId($donnees['achats'][$i]->getMembreId());
            $donnees['jeuAchat'][$i] = $modeleJeux->lireJeuParId($donnees['achats'][$i]->getJeuxId());
            $donnees['proprietaireJeuAchat'][$i] = $modeleMembres->obtenirParId($donnees['jeuAchat'][$i]->getMembreId());
            $donnees['typePaiementAchat'][$i] = $modeleTypePaiement->lireTypePaiementParId($donnees['achats'][$i]->getTypePaiementId());
        }

        $donnees['categories'] = $modeleCategories->lireToutesCategories();
        $donnees['plateformes'] = $modelePlateformes->lireToutesPlateformes();


//         echo "<pre>";
////         var_dump($donnees);
//         var_dump($donnees['categories']);
//         echo "</pre>";
        $this->afficherVues("admin", $donnees);
    }

    private function chercherImages($donnees, $jeux = "jeux", $images = "")
    {
        $modeleImages = $this->lireDAO("Images");
        foreach ($donnees[$jeux] as $jeu) {
            if ($modeleImages->lireImageParJeuxId($jeu->getJeuxId())) {
                $donnees['images' . $images][] = $modeleImages->lireImageParJeuxId($jeu->getJeuxId());
            } else {
                $donnees['images' . $images][] = new Images(0, $jeu->getJeuxId(), 'images/image_defaut.png');
            }
        }
        return $donnees;
    }
}


?>






































