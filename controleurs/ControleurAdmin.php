<?php
/**
 * @file      ControleurMembres.php
 * @author    Chunliang He, Guilherme Tosin, Jansy López, Marcelo Guzmán, Oudayan Dutta
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Définit la classe pour le controleur membres
 * @details   Cette classe définit les différentes activités concernant aux membres inscrits sur le site
 */

class ControleurAdmin extends BaseControleur {
    /**
     * @brief   Méthode appelée par les controleurs
     * @details Méthode pour évaluer les "cases" du contrôleurs
     * @param   [array] $params La chaîne de requête URL ("query string") captée par le fichier Routeur.php
     * @return  L'acces aux vues, aux donnes
     */
    public function index(array $params) {
        $modeleJeux = $this->lireDAO("Jeux");
        $modeleMembres = $this->lireDAO("Membres");
        $modeleCategories = $this->lireDAO("Categories");
        $modelePlateformes = $this->lireDAO("Plateformes");
        $modeleAchat = $this->lireDao("Achat");
        $modeleLocation = $this->lireDao("Location");

        $donnees["erreur"] = "";
        $_SESSION["msg"] = "";

        if (isset($_SESSION["type"]) && ($_SESSION["type"] == 2 || $_SESSION["type"] == 3)) {

            if (isset($params["action"])) {

                switch ($params["action"]) {

                    case "afficherAdmin" :
                        $modeleMembres = $this->lireDAO("Membres");
                        $donnees['membres'] = $modeleMembres->obtenirTous("DESC");
                        foreach ($donnees['membres'] as $membre) {
                            $donnees['typeMembre'][] = $modeleMembres->obtenirRole($membre->getTypeUtilisateur());
                        }
                        $this->afficherVues("admin", $donnees);
                        break;

    //------------- Admin Membres------------------------------------------------------------------------------------------
                    case "formAdminModifierMembre";
                        $donnees = $this->formModifierMembre($params);
                        $_SESSION["params"] = $params;
                        $donnees["admin"] = true;
                        $this->afficherVues("ajoutMembre", $donnees, false);
                        break;

                    case "adminEnregistrerMembre" :
                        if ($_SESSION["params"]) {
                            $params["page"] = $_SESSION["params"]["page"];
                            $params["tri"] = $_SESSION["params"]["tri"];
                            $params["ordre"] = $_SESSION["params"]["ordre"];
                            $params["itemsParPage"] = $_SESSION["params"]["itemsParPage"];
                            unset($_SESSION["params"]);
                        }
                        $this->sauvegarderMembre($params);
                        $this->afficherMembres($params);
                        break;

                    case "afficherMembres" :
                        $this->afficherMembres($params);
                        break;

                    case "validerMembre" :
                        if (isset($params['membre_id'])) {
                            $modeleMembres->validerMembre($params['membre_id']);
                        }
                        $this->afficherMembres($params);
                        break;

                    case "bannirMembre" :
                        if (isset($params['membre_id'])) {
                            $modeleMembres->bannirMembre($params['membre_id']);
                        }
                        $this->afficherMembres($params);
                        break;

                    case "reactiverMembre" :
                        if (isset($params['membre_id'])) {
                            $modeleMembres->reactiverMembre($params['membre_id']);
                        }
                        $this->afficherMembres($params);
                        break;

                    case "promouvoirMembre" :
                        if ($_SESSION["type"] == 3) {
                            if (isset($params['membre_id'])) {
                                $modeleMembres->promouvoirMembre($params['membre_id']);
                            }
                            $this->afficherMembres($params);
                        }
                        break;

                    case "retrograderMembre" :
                        if ($_SESSION["type"] == 3) {
                            if (isset($params['membre_id'])) {
                                $modeleMembres->retrograderMembre($params['membre_id']);
                            }
                        }
                        $this->afficherMembres($params);
                        break;

    //------------- Admin jeux------------------------------------------------------------------------------------------
                    case "afficherJeux" :
                        $this->afficherJeux($params);
                        break;

                    case "formAdminModifierJeu" :
                        $donnees = $this->formModifierJeu($params);
                        $_SESSION["params"] = $params;
                        $donnees["admin"] = true;
                        // echo "<pre>";
                        // var_dump($donnees);
                        // echo "</pre>";
                        $this->afficherVues("ajoutJeux", $donnees, false);
                        break;

                    case "adminEnregistrerJeu" :
                        if ($_SESSION["params"]) {
                            $params["page"] = $_SESSION["params"]["page"];
                            $params["tri"] = $_SESSION["params"]["tri"];
                            $params["ordre"] = $_SESSION["params"]["ordre"];
                            $params["itemsParPage"] = $_SESSION["params"]["itemsParPage"];
                            unset($_SESSION["params"]);
                        }
                        $this->sauvegarderJeu($params);
                        $this->afficherJeux($params);
                        break;

                    case "validerJeu" :
                        if (isset($params['jeux_id'])) {
                            $modeleJeux->validerJeu($params['jeux_id']);
                        }
                        $this->afficherJeux($params);
                        break;

                    case "activerJeu" :
                        if (isset($params['jeux_id'])) {
                            $modeleJeux->activerJeu($params['jeux_id']);
                        }
                        $this->afficherJeux($params);
                        break;

                    case "desactiverJeu" :
                        if (isset($params['jeux_id'])) {
                            $modeleJeux->desactiverJeu($params['jeux_id']);
                        }
                        $this->afficherJeux($params);
                        break;

                    case "bannirJeu" :
                        if (isset($params['jeux_id'])) {
                            $modeleJeux->bannirJeu($params['jeux_id']);
                        }
                        $this->afficherJeux($params);
                        break;

                    case "debannirJeu" :
                        if (isset($params['jeux_id'])) {
                            $modeleJeux->debannirJeu($params['jeux_id']);
                        }
                        $this->afficherJeux($params);
                        break;

    //--------------Admin gérer les transactions--------------------------------------------------------------------------
                    case "afficherLocations" :
                        $this->afficherLocations($params);
                        break;

                    case "activerLocation":
                        if(isset($params['location_id'])){
                            $modeleLocation->activerLocation($params['location_id']);
                        }
                        $this->afficherLocations($params);
                        break;

                    case "desactiverLocation":
                        if(isset($params['location_id'])){
                            $modeleLocation->desactiverLocation($params['location_id']);
                        }
                        $this->afficherLocations($params);
                        break;

                    case "afficherAchats" :
                        $this->afficherAchats($params);
                        break;

                    case "activerAchat":
                        if(isset($params['achat_id'])){
                            $modeleAchat->activerAchat($params['achat_id']);
                            $achat = $modeleAchat->lireAchatParId($params['achat_id']);
                            $modeleJeux->desactiverJeu($achat->getJeuxId());
                            $modeleJeux->activerVente($achat->getJeuxId());
                        }
                        $this->afficherAchats($params);
                        break;

                    case "desactiverAchat":
                        if(isset($params['achat_id'])){
                            $modeleAchat->desactiverAchat($params['achat_id']);
                            $achat = $modeleAchat->lireAchatParId($params['achat_id']);
                            $modeleJeux->activerJeu($achat->getJeuxId());
                            $modeleJeux->annulerVente($achat->getJeuxId());
                        }
                        $this->afficherAchats($params);
                        break;

    //--------------Admin gérer les menus--------------------------------------------------------------------------
                    case "afficherMenuCategories" :
                        $this->afficherMenuCategories($params);
                        break;

                    case "sauvegarderCategorie" :
                        if (isset($params['categorie_id']) && $params['categorie_id'] != "" && isset($params['categorie']) && $params['categorie'] != "" && ($_SESSION["type"] == 2 || $_SESSION["type"] == 3)) {
                            $categorie = new Categories($params['categorie_id'], $params['categorie']);
                            $modeleCategories->sauvegarder($categorie);
                        }
                        else {
                            $_SESSION["msg"] = "Remplissez tous les champs...";
                        }
                        $this->afficherMenuCategories($params);
                        break;

                    case "activerCategorie":
                        if(isset($params['categorie_id'])){
                            $modeleCategories->activerCategorie($params['categorie_id']);
                        }
                        $this->afficherMenuCategories($params);
                        break;

                    case "desactiverCategorie":
                        if(isset($params['categorie_id'])){
                            $modeleCategories->desactiverCategorie($params['categorie_id']);
                        }
                        $this->afficherMenuCategories($params);
                        break;

                    case "afficherMenuPlateformes" :
                        $this->afficherMenuPlateformes($params);
                        break;
    
                    case "sauvegarderPlateforme" :
                        if (isset($params['plateforme_id']) && $params['plateforme_id'] != "" && isset($params['plateforme']) && $params['plateforme'] != "" && isset($_SESSION["id"]) && ($_SESSION["type"] == 2 || $_SESSION["type"] == 3)) {
                            $plateforme = new Plateformes($params['plateforme_id'], $params['plateforme']);
                            $modelePlateformes->sauvegarder($plateforme);
                        }
                        else {
                            $_SESSION["msg"] = "Remplissez tous les champs...";
                        }
                        $this->afficherMenuPlateformes($params);
                        break;

                    case "activerPlateforme":
                        if(isset($params['plateforme_id'])){
                            $modelePlateformes->activerPlateforme($params['plateforme_id']);
                        }
                        $this->afficherMenuPlateformes($params);
                        break;

                    case "desactiverPlateforme":
                        if(isset($params['plateforme_id'])){
                            $modelePlateformes->desactiverPlateforme($params['plateforme_id']);
                        }
                        $this->afficherMenuPlateformes($params);
                        break;

                    default:
                        $this->afficherMembres($params);
                }
            } else {
                header("location:index.php");
            }

        }
        else {
            header("location:index.php");
        }

    }


    private function afficherMembres($params) {
        $modeleMembres = $this->lireDAO("Membres");
        // Données pour la pagination
        $donnees["url"] = "'index.php?Admin&action=afficherMembres'";
        $donnees["retour"] = "'#membres'";
        $donnees["tri"] = ["membre_id" => "ID", "nom" => "Nom de famille", "prenom" => "Prénom", "courriel" => "Courriel", "type_utilisateur_id" => "Type de membre", "evaluation_globale" => "Évaluation", "membre_valide" => "Membre validé", "membre_actif" => "Membre actif"];
        $donnees["triSelected"] = isset($params["tri"]) ? $params["tri"] : "membre_id";
        $donnees["ordre"] = isset($params["ordre"]) ? $params["ordre"] : 2;
        $donnees["itemsParPage"] = isset($params["itemsParPage"]) ? $params["itemsParPage"] : 12;
        $page= isset($params["page"]) ? $params["page"] : 1;
        $nbMembres = $modeleMembres->obtenirNbMembres();
        $donnees["pagination"] = $this->pagination($page, $nbMembres[0], $donnees["itemsParPage"]);
        $donnees['membres'] = $modeleMembres->obtenirTous($donnees["ordre"], "`" . $donnees["triSelected"] . "`", $donnees["pagination"]["limit"]);
        foreach ($donnees['membres'] as $membre) {
            $donnees['typeMembre'][] = $modeleMembres->obtenirRole($membre->getTypeUtilisateur());
        }
        $this->afficherVues(["adminMembres", "pagination"], $donnees, false);
    }

    private function afficherJeux($params) {
        $modeleJeux = $this->lireDAO("Jeux");
        $modeleMembres = $this->lireDAO("Membres");
        // Données pour la pagination
        $donnees["url"] = "'index.php?Admin&action=afficherJeux'";
        $donnees["retour"] = "'#jeux'";
        $donnees["tri"] = ["jeux_id" => "ID", "titre" => "Titre", "membre_id" => "Propriétaire", "location" => "Type de transaction", "prix" => "Prix", "evaluation_globale" => "Évaluation", "vendu" => "Jeu vendu", "jeux_valide" => "Jeu validé", "jeux_actif" => "Jeu actif", "jeux_banni" => "Jeu banni"];
        $donnees["triSelected"] = isset($params["tri"]) ? $params["tri"] : "jeux_id";
        $donnees["ordre"] = isset($params["ordre"]) ? $params["ordre"] : 2;
        $donnees["itemsParPage"] = isset($params["itemsParPage"]) ? $params["itemsParPage"] : 12;
        $page = isset($params["page"]) ? $params["page"] : 1;
        $nbJeux = $modeleJeux->obtenirNbJeux() ? $modeleJeux->obtenirNbJeux() : 0;
        // pagination($currentPage, $totalItems, $itemsPerPage)
        $donnees["pagination"] = $this->pagination($page, $nbJeux[0], $donnees["itemsParPage"]);
        $donnees['jeux'] = $modeleJeux->lireTousLesJeux($donnees["ordre"], "`" . $donnees["triSelected"] . "`", $donnees["pagination"]["limit"]);
        $donnees = $this->chercherImages($donnees);
        foreach ($donnees['jeux'] as $jeu) {
            $donnees['membreJeu'][] = $modeleMembres->obtenirParId($jeu->getMembreId());
        }
        $this->afficherVues(["adminJeux", "pagination"], $donnees, false);
    }

    private function afficherLocations($params) {
        $modeleLocation = $this->lireDao("Location");
        $modeleJeux = $this->lireDAO("Jeux");
        $modeleMembres = $this->lireDAO("Membres");
        $modeleTypePaiement = $this->lireDao("TypePaiement");
        // Données pour la pagination
        $donnees["url"] = "'index.php?Admin&action=afficherLocations'";
        $donnees["retour"] = "'#locations-tab'";
        $donnees["tri"] = ["location_id" => "ID", "jeux_id" => "Jeux en location", "membre_id" => "Locataire", "type_paiement_id" => "Paiement", "date_location" => "Date de location", "date_debut" => "Date de début", "date_retour" => "Date de retour", "location_active" => "Opération"];
        $donnees["triSelected"] = isset($params["tri"]) ? $params["tri"] : "location_id";
        $donnees["ordre"] = isset($params["ordre"]) ? $params["ordre"] : 2;
        $donnees["itemsParPage"] = isset($params["itemsParPage"]) ? $params["itemsParPage"] : 12;
        $page = isset($params["page"]) ? $params["page"] : 1;
        $nbLocations = $modeleLocation->obtenirNbLocations();
        $donnees["pagination"] = $this->pagination($page, $nbLocations[0], $donnees["itemsParPage"]);
        $donnees['locations'] = $modeleLocation->lireToutesLesLocations($donnees["ordre"], "`" . $donnees["triSelected"] . "`", $donnees["pagination"]["limit"]);
        for ($i = 0; $i < count($donnees['locations']); $i++) {
            $donnees['membreLocation'][$i] = $modeleMembres->obtenirParId($donnees['locations'][$i]->getMembreId());
            $donnees['jeuLocation'][$i] = $modeleJeux->lireJeuParId($donnees['locations'][$i]->getJeuxId());
            $donnees['proprietaireJeuLocation'][$i] = $modeleMembres->obtenirParId($donnees['jeuLocation'][$i]->getMembreId());
            $donnees['typePaiementLocation'][$i] = $modeleTypePaiement->lireTypePaiementParId($donnees['locations'][$i]->getTypePaiementId());
        }
        $this->afficherVues(["adminLocations", "pagination"], $donnees, false);
    }

    private function afficherAchats($params) {
        $modeleAchat = $this->lireDao("Achat");
        $modeleJeux = $this->lireDAO("Jeux");
        $modeleMembres = $this->lireDAO("Membres");
        $modeleTypePaiement = $this->lireDao("TypePaiement");
        // Données pour la pagination
        $donnees["url"] = "'index.php?Admin&action=afficherAchats'";
        $donnees["retour"] = "'#achats-tab'";
        $donnees["tri"] = ["achat_id" => "ID", "jeux_id" => "Titre achat", "membre_id" => "Acheteur", "type_paiement_id" => "Paiement", "date_achat" => "Date d'achat", "achat_actif" => "Opération"];
        $donnees["triSelected"] = isset($params["tri"]) ? $params["tri"] : "achat_id";
        $donnees["ordre"] = isset($params["ordre"]) ? $params["ordre"] : 2;
        $donnees["itemsParPage"] = isset($params["itemsParPage"]) ? $params["itemsParPage"] : 12;
        $page = isset($params["page"]) ? $params["page"] : 1;
        $nbAchats = $modeleAchat->obtenirNbAchats();
        $donnees["pagination"] = $this->pagination($page, $nbAchats[0], $donnees["itemsParPage"]);
        $donnees['achats'] = $modeleAchat->lireTousLesAchats($donnees["ordre"], "`" . $donnees["triSelected"] . "`", $donnees["pagination"]["limit"]);
        for ($i = 0; $i < count($donnees['achats']); $i++) {
            $donnees['membreAchat'][$i] = $modeleMembres->obtenirParId($donnees['achats'][$i]->getMembreId());
            $donnees['jeuAchat'][$i] = $modeleJeux->lireJeuParId($donnees['achats'][$i]->getJeuxId());
            $donnees['proprietaireJeuAchat'][$i] = $modeleMembres->obtenirParId($donnees['jeuAchat'][$i]->getMembreId());
            $donnees['typePaiementAchat'][$i] = $modeleTypePaiement->lireTypePaiementParId($donnees['achats'][$i]->getTypePaiementId());
        }
        $this->afficherVues(["adminAchats", "pagination"], $donnees, false);
    }

    private function afficherMenuCategories($params) {
        $modeleCategories = $this->lireDAO("Categories");
        // Données pour la pagination
        $donnees["url"] = "'index.php?Admin&action=afficherMenuCategories'";
        $donnees["retour"] = "'#categories-tab'";
        $donnees["tri"] = ["categorie_id" => "ID", "categorie" => "Nom de catégorie", "categorie_active" => "Catégorie active"];
        $donnees["triSelected"] = isset($params["tri"]) ? $params["tri"] : "categorie";
        $donnees["ordre"] = isset($params["ordre"]) ? $params["ordre"] : 1;
        $donnees["itemsParPage"] = isset($params["itemsParPage"]) ? $params["itemsParPage"] : 12;
        $page = isset($params["page"]) ? $params["page"] : 1;
        $nbCategories = $modeleCategories->obtenirNbCategories();
        $donnees["pagination"] = $this->pagination($page, $nbCategories[0], $donnees["itemsParPage"]);
        $donnees['categories'] = $modeleCategories->lireToutesCategories($donnees["ordre"], "`" . $donnees["triSelected"] . "`", $donnees["pagination"]["limit"]);
        $this->afficherVues(["adminMenuCategories", "pagination"], $donnees, false);
    }

    private function afficherMenuPlateformes($params) {
        $modelePlateformes = $this->lireDAO("Plateformes");
        // Données pour la pagination
        $donnees["url"] = "'index.php?Admin&action=afficherMenuPlateformes'";
        $donnees["retour"] = "'#plateformes-tab'";
        $donnees["tri"] = ["plateforme_id" => "ID", "plateforme" => "Nom de plateforme", "plateforme_active" => "Plateforme active"];
        $donnees["triSelected"] = isset($params["tri"]) ? $params["tri"] : "plateforme";
        $donnees["ordre"] = isset($params["ordre"]) ? $params["ordre"] : 1;
        $donnees["itemsParPage"] = isset($params["itemsParPage"]) ? $params["itemsParPage"] : 12;
        $page = isset($params["page"]) ? $params["page"] : 1;
        $nbPlateformes = $modelePlateformes->obtenirNbPlateformes();
        $donnees["pagination"] = $this->pagination($page, $nbPlateformes[0], $donnees["itemsParPage"]);
        $donnees['plateformes'] = $modelePlateformes->lireToutesPlateformes($donnees["ordre"], "`" . $donnees["triSelected"] . "`", $donnees["pagination"]["limit"]);
        $this->afficherVues(["adminMenuPlateformes", "pagination"], $donnees, false);
    }

}

?>






































