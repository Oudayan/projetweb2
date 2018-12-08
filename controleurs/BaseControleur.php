<?php
/**
 * @file    BaseControleur.php
 * @author  Oudayan Dutta
 * @version 1.0
 * @date    Septembre 2018
 * @brief   Controlleur parent
 * @details Ce controleur contient les fonctions nécessaires aux autres contrôleurs
 */

    abstract class BaseControleur {

        /**
         * @brief   Méthode qui sera appelée par les controleurs
         * @details Méthode abstraite pour traiter les "cases" des contrôleurs
         * @param   [array] $params La chaîne de requête URL ("query string") captée par le Routeur.php
         * @return  La méthode afficherVues()
         */
        public abstract function index(array $params);

        /**
         * @brief  Permet d'afficher une ou plusieurs vues partielles
         * @detail Affiche une vue si $nomVue est une chaine de charactère ou affiche plusieurs vues si $nomVue est un tableau contentant le nom des vues.
         *         Affiche toujours la/les vue(s) entre les vues partielles entete.php et piedPage.php
         * @param  [string/array]  $nomVue     Nom de la vue ou tableau contentant les noms des vues à afficher
         * @param  [array]         $donnees    Données passée à la/aux vues
         * @param  [boolean]       $complete   Vrai = entête, vue(s) & pied de page / Faux = vue(s) seulement
         * @return message d'erreur ou une vue
         */
        protected function afficherVues($nomVue, $donnees = null, $complet = true) {
            // Inclure le header pour chaque vue
            if ($complet) {
                include(RACINE . "vues/header.php");
            }
            // Si le nom de vue est une chaîne de charactère (seulement une vue partielle)
            if (is_string($nomVue)) {
                $cheminVue = RACINE . "vues/" . $nomVue . ".php";
                if (file_exists($cheminVue)) {
                    include($cheminVue);
                } else {
                    trigger_error("Erreur 404! La vue $cheminVue n'existe pas.");
                }
            } // Si le nom de vue est contenu dans une tableau (plusieurs vues partielles)
            else if (is_array($nomVue)) {
                foreach ($nomVue as $vue) {
                    $cheminVue = RACINE . "vues/" . $vue . ".php";
                    if (file_exists($cheminVue)) {
                        include($cheminVue);
                    } else {
                        trigger_error("Erreur 404! La vue $cheminVue n'existe pas.");
                    }
                }
            }
            // Inclure le footer pour chaque vue
            if ($complet) {
                include(RACINE . "vues/footer.php");
            }
        }

        /**
         * @brief       Méthode pour créer les modèles de chaque classe et connexion à la base de données
         * @details     Vérifie si le modèle existe et fait la connexion à la base de données via la méthode chercherBD() de la classe ManufactureBD.php
         * Créé l'object modèle de la classe passée en paramètre, contenant toutes le opérations "CRUD" pour cette classe.
         * @param       [string]    $nomModele      Le nom du modèle à créer
         * @return      [object]    $objetModele    L'object modèle de la classe passée en paramètre
         */
        protected function lireDAO($nomModele) {
            $classe = "Modele" . $nomModele;

            if (class_exists($classe)) {
                // Connexion à la base de données
                $BD = ManufactureBD::chercherBD(TYPEBD, NOMBD, HEBERGEUR, NOMUSAGER, MOTDEPASSE);
                // Création d'une instance de la classe Modele $classe
                $objetModele = new $classe($BD);
                if ($objetModele instanceof BaseDAO) {
                    return $objetModele;
                }
                else {
                    trigger_error("Le modèle n'est pas conforme.");
                }
            }
        }

        /**
         * @brief       Méthode pour la pagination
         * @details     Calcule la page de début et de fin à partir du nombre total d'items et de la page courante
         * @param       [string]    $totalPages     Le nombre total de pages
         * @param       [string]    $currentPage    La page courante
         * @return      [array]     $pagination     La page de début et la page de fin
         */
        protected function pagination($currentPage, $totalItems, $itemsPerPage) {
            $totalPages = ceil($totalItems / $itemsPerPage);
            if ($totalPages <= 10) {
                // Less than 10 total pages so show all
                $startPage = 1;
                $endPage = $totalPages;
            } else {
                // More than 10 total pages so calculate start and end pages
                if ($currentPage <= 6) {
                    $startPage = 1;
                    $endPage = 10;
                }
                else if ($currentPage + 4 >= $totalPages) {
                    $startPage = $totalPages - 9;
                    $endPage = $totalPages;
                }
                else {
                    $startPage = $currentPage - 5;
                    $endPage = $currentPage + 4;
                }
            }
            // calculate start and end item indexes
            $startIndex = ($currentPage - 1) * $itemsPerPage;
            $limit = $startIndex . ", " . $itemsPerPage;
            $pagination = [
                "currentPage" => $currentPage,
                "totalPages" => $totalPages,
                "startPage" => $startPage, 
                "endPage" => $endPage, 
                "limit" => $limit
            ];
            return $pagination;
        }

        protected function dateValide($date) {
            if (preg_match("/^(\d{4})-(\d{1,2})-(\d{1,2})$/", $date, $m)) {
                if (checkdate(intval($m[2]), intval($m[3]), intval($m[1]))) {
                    return true;
                }
            }
            return false;
        }

        /**
         * @brief       Méthode pour chercher l'image principale de chaque jeu
         * @details     Va chercher la première image d'un jeu si présente, sinon va insérer l'image défaut du site
         * @param       [array]     $donnees    Le tableau de données avec le(s) jeu(x)
         * @param       [string]    $jeux       Le nom du tableau de jeux dans le tableau $donnees
         * @param       [string]    $images     Le nom du tableau d'images dans le tableau $donnees
         * @return      [array]     $donnees    Le tableau de données avec le(s) jeu(x) et le tableau d'images rajouté
         */
        protected function chercherImages(Array $donnees, String $jeux = "jeux", String $images = "") {
            $modeleImages = $this->lireDAO("Images");
            if (gettype($donnees[$jeux]) == "array") {
                foreach($donnees[$jeux] as $_jeu) {
                    if ($modeleImages->lireImageParJeuxId($_jeu->getJeuxId())) {
                        $donnees["images" . $images][] = $modeleImages->lireImageParJeuxId($_jeu->getJeuxId());
                    }
                    else {
                        $donnees["images" . $images][] = new Images(0, $_jeu->getJeuxId(), "images/image_defaut.png");
                    }
                }
            }
            else if (gettype($donnees[$jeux]) == "object") {
                if ($modeleImages->lireImagesParJeuxId($donnees[$jeux]->getJeuxId())) {
                    $donnees["images" . $images] = $modeleImages->lireImagesParJeuxId($donnees[$jeux]->getJeuxId());
                }
                else {
                    $donnees["images" . $images][] = new Images(0, $donnees[$jeux]->getJeuxId(), "images/image_defaut.png");
                }
            }
            else {
                $donnees["images" . $images][] = new Images(0, $donnees[$jeux]->getJeuxId(), "images/image_defaut.png");
            }
            return $donnees;
        }

        protected function formModifierMembre($params) {
            $modeleJeux = $this->lireDAO("Jeux");
            $modeleMembres = $this->lireDAO("Membres");
            if (isset($_SESSION["id"])) {
                if (isset($params["membre_id"]) && ($_SESSION["type"] == 3 || $_SESSION["type"] == 4)) {
                    $donnees["membre"] = $modeleMembres->obtenirParId($params["membre_id"]);
                }
                else {
                    $donnees["membre"] = $modeleMembres->obtenirParId($_SESSION["id"]);
                } 
            }
            $donnees["trois"] = $modeleJeux->lireDerniersJeux(12);
            $donnees = $this->chercherImages($donnees, "trois", "Trois");
            return $donnees;
        }

        protected function sauvegarderMembre($params) {
            $modeleMembres = $this->lireDAO("Membres");
            if (isset($params['membre_id']) && trim($params['membre_id']) != "" && isset($params["courriel"]) && trim($params['courriel']) != "" && isset($params["mot_de_passe"]) && trim($params['mot_de_passe']) != "" && isset($params["confirm_mdp"]) && trim($params['confirm_mdp']) != "" && isset($params["nom"]) && trim($params['nom']) != "" && isset($params["prenom"]) && trim($params['prenom']) != "" && isset($params["adresse"]) && trim($params['adresse']) != "" && isset($params["telephone"]) && trim($params['telephone']) != "") {
                // Si une modification de membre, aller chercher les valeurs de type_utilisateu_id, membre_valide & membre_actif
                if ($params['membre_id'] > 0) {
                    $membreUpdate = $modeleMembres->obtenirParId($params['membre_id']);
                    if ($membreUpdate) {
                        $type = $membreUpdate->getTypeUtilisateur();
                        $date = $membreUpdate->getDateAjout();
                        $eval = $membreUpdate->getEvaluationGlobale();
                        $valide = $membreUpdate->getMembreValide();
                        $actif = $membreUpdate->getMembreActif();
                    }
                    else {
                        $type = 1;
                        (string)$date = date("Y-m-d H:i:s");
                        $eval = -1;
                        $actif = 1;
                        $valide = 0;
                        $_SESSION["msg"] = "Ce membre n'existe pas !";
                    }
                }
                else {
                    $type = 1;
                    (string)$date = date("Y-m-d H:i:s");
                    $eval = -1;
                    $actif = 1;
                    $valide = 0;
                }
                // comparer les mot de passe sont pareils.
                if ($params["mot_de_passe"] == $params["confirm_mdp"]) {
                    // Vérifier que le courriel n'est pas déjà pris
                    $courrielChk = true;
                    $mdpChk = true;
                    $membreExistant = $modeleMembres->obtenirParCourriel($params["courriel"]);
                    if ($membreExistant && $params['membre_id'] == 0) {
                        $courrielChk = false;
                    }
                    // Vérifier si le mot de passe contient au moins une majuscule, une minuscule, un chiffre et a une longueur de 6 à 60 charactères
                    if (!preg_match("/(?=.*[A-ZÀÂÄÇÉÈÊËÎÏÔÖÙÛÜ])(?=.*[a-zàâäçéèêëîïôöùûü])(?=.*\d)[.*\S]{6,60}/", trim($params["mot_de_passe"]))) {
                        $mdpChk = false;
                    }
                    if ($courrielChk) {
                        if ($mdpChk) {
                            // ($membre_id = 0, $type_utilisateur_id = 1, $nom = "", $prenom = "", $mot_de_passe = "", $adresse = "", $telephone = "", $courriel = "", $date_ajout = "", $evaluation_globale = -1, $alerte_email = 1, $newsletter = 0, $membre_valide = 0, $membre_actif = 1)
                            $membre = new Membres($params['membre_id'], $type, $params["nom"], $params["prenom"], md5($params["mot_de_passe"]), $params["adresse"], $params["telephone"], $params["courriel"], $date, $eval, 1, 0, $valide, $actif);
                            if (isset($_SESSION['id']) && $_SESSION['id'] == $params['membre_id']) {
                                $_SESSION['prenom'] = $params["prenom"];
                                $_SESSION['nomComplet'] = $params["prenom"] . " " . $params["nom"];
                            }
                            // Sauvegarde de l'objet $membre
                            $id = $modeleMembres->sauvegarde($membre);
                            $_SESSION["msg"] = "Votre profil est enregistré !";
                        }
                        else {
                            $_SESSION["msg"] = "Le mot de passe doint contenir au moins une majuscule, une minuscule, un chiffre et avoir une longueur de 6 à 60 charactères.";
                        }
                    }
                    else {
                        $_SESSION["msg"] = "Ce courriel est déjà pris...";
                    }
                }
                else {
                    $_SESSION["msg"] = "Le mot de passe de confirmation est différent du mot de passe saisi.";
                }
            }
            else {
                $_SESSION["msg"] = "Remplissez tous les champs...";
            }
        }

        protected function afficherJeuxMembres() {
            $modeleJeux = $this->lireDAO("Jeux");
            $modeleMembres = $this->lireDAO("Membres");
            $modelePlateformes = $this->lireDAO("Plateformes");
            $modeleCategoriesJeux = $this->lireDAO("CategoriesJeux");
            $modeleAchat = $this->lireDAO("Achat");
            $modeleLocation = $this->lireDAO("Location");
            $modeleTypePaiement = $this->lireDao("TypePaiement");
            $modeleEvaluation = $this->lireDAO("Evaluation");
            if (isset($_SESSION["id"])) {
                $donnees["jeux"] = $modeleJeux->lireJeuxParMembre($_SESSION["id"]);
                for ($i = 0; $i < count($donnees["jeux"]); $i++) {
                    $donnees["jeu" . $donnees["jeux"][$i]->getJeuxId()] = $donnees["jeux"][$i];
                    $donnees = $this->chercherImages($donnees, "jeu" . $donnees["jeux"][$i]->getJeuxId(), $donnees["jeux"][$i]->getJeuxId());
                    unset($donnees["jeu" . $donnees["jeux"][$i]->getJeuxId()]);
                    $donnees["plateforme"][$i] = $modelePlateformes->lirePlateformeParId($donnees["jeux"][$i]->getPlateformeId());
                    $donnees["categoriesJeu"][$i] = $modeleCategoriesJeux->lireCategoriesParJeuxId($donnees["jeux"][$i]->getJeuxId());
                    $donnees["achats"][$i] = $modeleAchat->lireAchatsParJeuxId($donnees["jeux"][$i]->getJeuxId());
                    for ($j = 0; $j < count($donnees["achats"][$i]); $j++) {
                        $donnees["membreAchat"][$i][$j] = $modeleMembres->obtenirParId($donnees["achats"][$i][$j]->getMembreId());
                        $donnees["typePaiementAchat"][$i][$j] = $modeleTypePaiement->lireTypePaiementParId($donnees['achats'][$i][$j]->getTypePaiementId());
                    }
                    $donnees["historiqueLocations"][$i] = $modeleLocation->lireHistoriqueLocationsParJeuxId($donnees["jeux"][$i]->getJeuxId());
                    for ($j = 0; $j < count($donnees["historiqueLocations"][$i]); $j++) {
                        $donnees["membreHistoriqueLocations"][$i][$j] = $modeleMembres->obtenirParId($donnees["historiqueLocations"][$i][$j]->getMembreId());
                        $donnees["typePaiementHistoriqueLocations"][$i][$j] = $modeleTypePaiement->lireTypePaiementParId($donnees["historiqueLocations"][$i][$j]->getTypePaiementId());
                    }
                    $donnees["locationsCourantes"][$i] = $modeleLocation->lireLocationCouranteParJeuxId($donnees["jeux"][$i]->getJeuxId());
                    for ($j = 0; $j < count($donnees["locationsCourantes"][$i]); $j++) {
                        $donnees["membreLocationsCourantes"][$i][$j] = $modeleMembres->obtenirParId($donnees["locationsCourantes"][$i][$j]->getMembreId());
                        $donnees["typePaiementLocationsCourantes"][$i][$j] = $modeleTypePaiement->lireTypePaiementParId($donnees["locationsCourantes"][$i][$j]->getTypePaiementId());
                    }
                    $donnees["locationsAVenir"][$i] = $modeleLocation->lireLocationsAVenirParJeuxId($donnees["jeux"][$i]->getJeuxId());
                    for ($j = 0; $j < count($donnees["locationsAVenir"][$i]); $j++) {
                        $donnees["membreLocationsAVenir"][$i][$j] = $modeleMembres->obtenirParId($donnees["locationsAVenir"][$i][$j]->getMembreId());
                        $donnees["typePaiementLocationsAVenir"][$i][$j] = $modeleTypePaiement->lireTypePaiementParId($donnees["locationsAVenir"][$i][$j]->getTypePaiementId());
                    }
                    // Déterminer le status du jeu
                    if ($donnees["jeux"][$i]->getJeuxValide() == 0) {
                        $status = "<span class='text-warning'>En attente de validation par l'administration</span>";
                    }
                    else if ($donnees["jeux"][$i]->getVendu() == 1) {
                        $status = "<span class='text-success'>Jeu vendu!</span>";
                    }
                    else {
                        $enLocation = false;
                        if (isset($donnees["locationsCourantes"][$i])) {
                            (string) $date = date("Y-m-d H:i:s");
                            foreach ($donnees["locationsCourantes"][$i] as $location) {
                                if (strtotime($date) >= strtotime($location->getDateDebut()) && strtotime($date) <= strtotime($location->getDateRetour()) && $location->getLocationActive()) {
                                    $enLocation = true;
                                }
                            }
                        }
                        if ($enLocation) {        
                            $status = "<span class='text-success'>Jeu en location!</span>";
                        }
                        else if ($donnees["jeux"][$i]->getJeuxBanni() == 1) {
                            $status = "<span class='text-danger'>Jeu banni</span>";
                        }
                        else if ($donnees["jeux"][$i]->getJeuxActif() == 0) {
                            $status = "<span class='text-danger'>Jeu inactif</span>";
                        }
                        else if ($donnees["jeux"][$i]->getLocation() == 1) {
                            $status = "<span class='text-info'>Jeu à louer</span>";
                        }
                        else {
                            $status = "<span class='text-info'>Jeu à vendre</span>";
                        }
                    }
                    $donnees['status'][$i] = $status;
                    $donnees['evaluations'][$i] = $modeleEvaluation->lireEvaluationsParJeu($donnees["jeux"][$i]->getJeuxId());
                    $donnees['nbEvaluations'][$i] = $modeleEvaluation->lireNbEvaluationsParJeu($donnees['jeux'][$i]->getJeuxId());
                    $donnees['nbCommentaires'][$i] = $modeleEvaluation->lireNbCommentairesParJeu($donnees['jeux'][$i]->getJeuxId());
                    foreach ($donnees['evaluations'][$i] as $evaluation) {
                        $donnees['membresEvaluateurs'][$i][] = $modeleMembres->obtenirParId($evaluation->getMembreId());
                    }
                }
            }
            else {
                $donnees['erreur'] = "Vous devez vous connecter pour acceder à cette page";
            }
            return $donnees;
        }
        
        protected function formModifierJeu($params) {
            $modeleJeux = $this->lireDAO("Jeux");
            $modelePlateformes = $this->lireDAO("Plateformes");
            $modeleCategoriesJeux = $this->lireDAO("CategoriesJeux");
            $modeleCategories = $this->lireDAO("Categories");
            if (isset($params["JeuxId"])) {
                $donnees['plateforme'] = $modelePlateformes->lireToutesPlateformesActives();
                $donnees['categories'] = $modeleCategories->lireToutesCategoriesActives();
                $donnees['categoriesJeu'] = $modeleCategoriesJeux->lireCategoriesParJeuxId($params["JeuxId"]);
                $donnees['jeu'] = $modeleJeux->lireJeuParId($params["JeuxId"]);
                $donnees = $this->chercherImages($donnees, "jeu");
            }
            else {
                $donnees["erreur"] = "Ce jeu n'existe pas.";
            }
            return $donnees;
        }

        protected function sauvegarderJeu($params) {
            $modeleJeux = $this->lireDAO("Jeux");
            $modeleImages = $this->lireDAO("Images");
            $modeleCategoriesJeux = $this->lireDAO("CategoriesJeux");
            if (isset($params['jeux_id']) && trim($params['jeux_id']) != ""  && isset($params['titre']) && trim($params['titre']) != ""  && isset($params['prix']) && trim($params['prix']) != ""  && isset($params['concepteur']) && trim($params['concepteur']) != ""  && isset($params['location']) && trim($params['location']) != ""  && isset($params['plateforme_id']) && trim($params['plateforme_id']) != "" && isset($params['categorie']) && trim($params['categorie'][0]) != "") {
                if (isset($params['jeux_id']) && $params['jeux_id'] > 0) {
                    $jeuUpdate = $modeleJeux->lireJeuParId($params['jeux_id']);
                    $membre = $jeuUpdate->getMembreId();
                    $date = $jeuUpdate->getDateAjout();
                    $eval = $jeuUpdate->getEvaluationGlobale();
                    $vendu = $jeuUpdate->getVendu();
                    $valide = $jeuUpdate->getJeuxValide();
                    $actif = $jeuUpdate->getJeuxActif();
                    $banni = $jeuUpdate->getJeuxBanni();
                }
                else {
                    $membre = $_SESSION["id"];
                    (string)$date = date("Y-m-d H:i:s");
                    $eval = -1;
                    $vendu = 0;
                    $valide = 0;
                    $actif = 1;
                    $banni = 0;
                }
                // ($jeux_id = 0, $plateforme_id = 1, $membre_id = 0, $titre = "", $prix = 0, $date_ajout = "", $concepteur = "", $description = "", $evaluation_globale= -1, $location = 0, $vendu = 0, $jeux_valide = 0, $jeux_actif = 1, $jeux_banni = 0)
                $jeu = new Jeux($params['jeux_id'], $params["plateforme_id"], $membre, $params["titre"], $params["prix"], $date, $params["concepteur"], $params["description"], $eval, $params["location"], $vendu, $valide, $actif, $banni);
                $jeux_id = $modeleJeux->sauvegarderJeux($jeu);
                if (isset($params['cheminsImages'])) {
                    $tmpDir = 'images/Jeux/tmp' . $_SESSION['id'];
                    $newDir = 'images/Jeux/' . $jeux_id;
                    if (is_dir($tmpDir)) {
                        if (is_dir($newDir)) {
                            $files = scandir($tmpDir);
                            $tmpDir .= "/";
                            $newDir .= "/";
                            foreach ($files as $file) {
                                if (in_array($file, array(".",".."))) continue;
                                // If we copied this successfully, mark it for deletion
                                if (copy($tmpDir.$file, $newDir.$file)) {
                                    $delete[] = $tmpDir.$file;
                                }
                            }
                            // Delete all successfully-copied files
                            foreach ($delete as $file) {
                                unlink($file);
                            }
                            rmdir($tmpDir);
                        }
                        else {
                            rename($tmpDir, $newDir);
                        }
                    }
                    $modeleImages->effacerImagesParJeuxId($jeux_id);
                    foreach ($params['cheminsImages'] as $cheminImage) {
                        if ($cheminImage != "") {
                            $image = new Images(0, $jeux_id, str_replace('/tmp' . $_SESSION['id'] . '/', '/' . $jeux_id . '/', $cheminImage));
                            $modeleImages->sauvegarderImage($image);
                        }
                    }
                }
                //Sauvegarder les categories de jeu
                $modeleCategoriesJeux->effacerCategoriesParJeuxId($jeux_id);
                for ($i=0; $i < count($params['categorie']); $i++) {
                    // $jeux_id = 0,$categorie_id = 0, $categorie = ""
                    $cat = new CategoriesJeux($jeux_id, $params['categorie'][$i], "test", 1);
                    //var_dump($modeleCategoriesJeux->sauvegarderCategoriesJeu($cat));
                    $modeleCategoriesJeux->sauvegarderCategoriesJeu($cat);
                }
            }
            else {
                $_SESSION['msg'] ="Remplissez tous les champs...";
            }
        }

        protected function afficherEvaluation($params) {
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
                    if (isset($_SESSION["id"]) && ($_SESSION["id"] == $donnees["membre"]->getMembreId() || $_SESSION["type"] == 3 || $_SESSION["type"] == 4)) {
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
                        if (new DateTime('NOW') <= $limite || $_SESSION["type"] == 3 || $_SESSION["type"] == 4) {
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

        protected function sauvegarderEvaluation($params) {
            $modeleEvaluation = $this->lireDAO("Evaluation");
            if (isset($params["jeton"])) {
                $evaluation = $modeleEvaluation->lireEvaluationParJeton($params["jeton"]);
                if ($evaluation) {
                    // Vérifier que le membre qui a fait la transaction ou un admin sont les seuls à accéder à l'évaluation
                    if (isset($_SESSION["id"]) && ($_SESSION["id"] == $evaluation->getMembreId() || $_SESSION["type"] == 3 || $_SESSION["type"] == 4)) {
                        (string) $date = date("Y-m-d H:i:s");
                        // ($evaluation_id = 0, $jeton = "", $jeux_id = 0, $membre_id = 0, $achat_id = 0, $location_id = 0, $commentaire_jeu = "", $commentaire_membre = "", $evaluation_jeu = -1, $evaluation_membre = -1, $date_evaluation = "", $evaluation_jeu_active = 1, $evaluation_membre_active = 1)
                        $modifierEvaluation = new Evaluation($evaluation->getEvaluationId(), 0, 0, 0, 0, 0, $params["commentaireJeu"], $params["commentaireMembre"], $params["evaluationJeu"], $params["evaluationMembre"], $date);
                        $modeleEvaluation->sauvegarde($modifierEvaluation);
                        // Mettre à jour l'évaluation globale du jeu
                        $this->updateEvaluationGlobaleJeu($evaluation);
                        // Mettre à jour l'évaluation globale du membre propriétaire du jeu
                        $this->updateEvaluationGlobaleMembre($evaluation);
                        $_SESSION["msg"]="L'évaluation a été sauvegardée avec succès!";
                        return true;
                    }
                }
                else {
                    $donnees["erreur"] = "Vous n'avez pas la permission de modifier cette évaluation.";
                }
            }
            else {
                $donnees["erreur"] = "Cette évaluation n'existe pas.";
            }
            return $donnees;
        }

        protected function updateEvaluationGlobaleJeu($evaluation) {
            $modeleEvaluation = $this->lireDAO("Evaluation");
            $modeleJeux = $this->lireDAO("Jeux");
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
        }

        protected function updateEvaluationGlobaleMembre($evaluation) {
            $modeleEvaluation = $this->lireDAO("Evaluation");
            $modeleJeux = $this->lireDAO("Jeux");
            $modeleMembres = $this->lireDAO("Membres");
            // Chercher les données du membre propriétaire du jeu
            $jeu = $modeleJeux->lireJeuParId($evaluation->getJeuxId());
            $evaluationsMembre = $modeleEvaluation->lireEvaluationsParMembre($jeu->getMembreId());
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
                // Mettre à jour l'évaluation globale du membre
                $modeleMembres->updateEvaluationMembre($jeu->getMembreId(), $evalMoyenneMembre);
            }
        }

    }

?>
