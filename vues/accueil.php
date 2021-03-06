            <div class="py-3 text-white bg-dark parallax">
                <div class="container p-4">
                    <div class="row contact-form">
                        <div class="align-self-center col-md-6">
                            <div class="col text-center justify-content-center align-self-center">
                                <h1 class="pb-3">Bienvenue à GameXchange</h1>
                                <?php if (isset($_SESSION["id"])) { ?>
                                    <button class="btn btn-success mt-5 disabled">Bienvenu(e). Vous êtes connecté(e) !</button></div>
                                <?php } else { ?>
                                    <a href="index.php?Membres&action=formAjoutMembre" id="btn-inscription" class="btn btn-success mt-5">S'INSCRIRE MAINTENANT !</a></div>
                                <?php } ?>
                                <!--Affichage la message -->
                                <div class="text-center text-danger mt-3">
                                    <?php if (isset($_SESSION["msg"])) { ?>
                                        <h4><?= $_SESSION["msg"] ?></h4>
                                    <?php } ?>
                                </div>
                                <h5 class="text-center pt-5 pb-5">La plus grande plateforme d'achat, de vente et d'échange de jeux vidéos du Canada !</h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div id="carouselTrois" class="carousel slide" data-ride="carousel" data-interval="3000">
                                    <?php if (count($donnees['imagesTrois']) > 1) { ?>
                                        <ol class="carousel-indicators">
                                        <?php for ($i = 0; $i < count($donnees['imagesTrois']); $i++) {
                                            if ($i == 0) { ?>
                                                <li data-target='#carouselTrois' data-slide-to='<?= $i ?>' class='active'></li>
                                            <?php } else { ?>
                                                <li data-target='#carouselTrois' data-slide-to='<?= $i ?>'></li>
                                            <?php }
                                        } ?>
                                        </ol>
                                    <?php } ?>
                                    <div class="carousel-inner">
                                    <?php for ($i = 0; $i < count($donnees['imagesTrois']); $i++) {
                                        if ($i == 0) { ?>
                                            <div class="carousel-item active">
                                        <?php } else { ?>
                                            <div class="carousel-item">
                                        <?php } ?>
                                            <a href="index.php?Jeux&action=afficherJeu&JeuxId=<?= $donnees['trois'][$i]->getJeuxId() ?>"><img class="d-block w-100" src="<?= $donnees['imagesTrois'][$i]->getCheminPhoto() ?>" alt="<?= $donnees['trois'][$i]->getTitre() ?>"></a>
                                        </div>
                                    <?php } ?>
                                    </div>
                                    <?php if (count($donnees['imagesTrois']) > 1) { ?>
                                        <a class="carousel-control-prev" href="#carouselTrois" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselTrois" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-light">
                    <div class="container">
                        <h1 class="text-center mt-2 bg-info">NOUVEAUTÉS</h1>
                        <div class="row">
                        <?php for ($i = 0; $i < count($donnees['derniers']); $i++) { ?>
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow cardjeux">
                                    <a href="index.php?Jeux&action=afficherJeu&JeuxId=<?= $donnees['derniers'][$i]->getJeuxId() ?>"><img class="card-img-top" src="<?= $donnees['images'][$i]->getCheminPhoto() ?>" alt="Card image cap"></a>
                                    <div class="card-body">
                                        <h6 class="card-text"><?= $donnees['derniers'][$i]->getTitre() ?></h6>
                                        <div class="pt-2">
                                        <p><?= $donnees["plateformeDerniers"][$i]->getPlateformeIcone() . " " . $donnees["plateformeDerniers"][$i]->getPlateforme() ?></p>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <h6><?= ($donnees["derniers"][$i]->getLocation() == 1 ? "À Louer" : "À vendre") ?></h6>
                                            </div>
                                            <small class="text-muted">Prix : <?= $donnees['derniers'][$i]->getPrix() ?> $CAD <?= $donnees["derniers"][$i]->getLocation() ? "par jour" : "" ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                        </div>
                    </div>

