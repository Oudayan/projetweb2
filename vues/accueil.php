<div class="py-3 text-white bg-dark parallax">
    <div class="container">
        <div class="row contact-form">
            <div class="align-self-center col-md-6">
                <div class="col text-center justify-content-center align-self-center">
                    <h1 class="pb-3">Bienvenue à GameXchange</h1>
                    <h5 class="pt-5 pb-5">La plus grande plateforme d'achat, vendre et d'échange de jeux vidéos du Canada !</h5>
                    <?php
                    if (isset($_SESSION["id"])) {
//                        echo '<a class="mt-5">Bienvenu(e). Vous êtes connecté ! </a></div>';
                        echo '<button class="btn btn-success mt-5 disabled">Bienvenu(e). Vous êtes connecté(e) !</button></div>';
                    } else {
                        echo '<button id="btn-inscription" type="button" class="btn btn-outline-danger mt-5" data-toggle="modal" data-target="#modal-inscription">S\'INSCRIRE MAINTENANT !</button></div>';
                    }
                    ?>
                    <!--Affichage la message -->
                    <div class="text-center mt-3  ">
                        <?php
                        if (isset($_SESSION["msg"])) {
                            echo '<h5>' . $_SESSION["msg"] . '</h5>';
                        }
                        ?>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modal-inscription" role="dialog">
                    <div class="modal-dialog">
                        <!-- Contenu du formulaire MODAL de connexion d'utilisateur-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4><i class="fas fa-gamepad"></i> Inscription</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" style="padding:40px 50px;">
                                <form action="index.php?Membres&action=enregistrerMembre" method="POST">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="prenom" placeholder="Prénom" name="prenom" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nom" placeholder="Nom" name="nom" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="courriel" placeholder="Courriel" name="courriel" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="mot_de_passe" placeholder="Mot de passe" name="mot_de_passe" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="confirm_mdp" placeholder="Confirmez le mot de passe" name="confirm_mdp" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="adresse" placeholder="Adresse" name="adresse" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" class="form-control" id="phone" placeholder="Téléphone ~ exemple : 514-456-7890" name="telephone" required>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block"><i class="fas fa-sign-in-alt"></i> S'inscrire</button>

                                    <input type="text" hidden name="membre_id" value="null">
                                    <input type="text" hidden name="type_utilisateur_id" value="1">
                                </form>
                                <div class="pt-1">* Tous les champs sont obligatoires</div>
                            </div>
                            <!-- Footer du modal -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger btn-default float-right" data-dismiss="modal"><i class="fas fa-times"></i> Canceller</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 p-0">
                    <div class="carousel slide" data-ride="carousel" data-interval="3000">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img src="images/01.jpg" alt="premier slide" class="d-block img-fluid w-100">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block img-fluid w-100" alt="image-jeu" src="images/02.jpg" data-holder-rendered="true">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block img-fluid w-100" alt="image-jeu" src="images/03.jpg" data-holder-rendered="true">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-light">
        <div class="container">
            <h1 class="text-center bg-info mt-2">NOUVEAUTÉS</h1>
            <div class="row">
                <?php
                $counter = count($donnees['derniers']);

                for ($i = 0; $i <= $counter - 1; $i++) {
                    ?>
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow cardjeux">
                            <a href="index.php?Jeux&action=afficherJeu&JeuxId=<?= $donnees['derniers'][$i]->getJeuxId() ?>">
                                <img class="card-img-top" src="<?= $donnees['images'][$i]->getCheminPhoto() ?>" alt="Card image cap">
                            </a>
                            <div class="card-body">
                                <p class="card-text"><?= $donnees['derniers'][$i]->getTitre() ?></p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="index.php?Jeux&action=afficherJeu&JeuxId=<?= $donnees['derniers'][$i]->getJeuxId() ?>" class="btn btn-sm btn-outline-secondary">Détails</a>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="AcheterJeux('<?= $donnees['derniers'][$i]->getJeuxId() ?>')"><?= ($donnees["derniers"][$i]->getLocation() == 1 ? "Louer" : "Acheter") ?></button>
                                    </div>
                                    <small class="text-muted">Prix : <?= $donnees['derniers'][$i]->getPrix() ?> $CAD</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

