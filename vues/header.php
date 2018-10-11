<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GameXchange</title>
        <meta name="description" content="Plateforme de location et de vente de jeux vidéos entre membres">
        <meta name="keywords" content="jeu, jeux, video, videos, vidéo, vidéos, jeu video, jeux videos, jeu vidéo, jeux vidéos, location, achat, vente, locations, achats, ventes, location entre membres, locations entre membres, achat entre membres, achats entre membres, vente entre membres, ventes entre membres">
        <link rel="stylesheet" href="css/bootstrap.min.css" >
        <link rel="stylesheet" href="css/bootoast.css" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/daterangepicker.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="js/bootoast.js"></script>
        <script type="text/javascript" src="js/moment.min.js"></script>
        <script type="text/javascript" src="js/daterangepicker.js"></script>
    </head>
    <body> 
        <header>
            <input type="hidden" id="membre_id" value="<?= isset($_SESSION["id"]) ? $_SESSION["id"] : "" ?>"/>
            <nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="navheader">
                <div class="container-fluid"> 
                    <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar12">
                        <span class="navbar-toggler-icon" ></span>
                    </button>
                    <a href="index.php?Jeux&action=derniers"><img src="images/logo.png" height="60" class="logo" title="GameXchange" alt="GameXchange Logo"></a>
                    <div class="collapse navbar-collapse" id="navbar12"> 
                        <!-- <a class="navbar-brand d-none d-md-block" href="#"></a> -->
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item"><a href="index.php?Jeux&action=rechercherJeux" class="nav-link">Rechercher</a></li>
                        </ul>
                        <?php if(isset($_SESSION["id"])){ ?>
                            <ul class="navbar-nav mx-auto">
                                <li id="annoce" class="nav-item"><a href="index.php?Jeux&action=gererMesJeux" class="nav-link">Gérer mes&nbsp;jeux</a></li>
                            </ul>
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item"><a href="index.php?Membres&action=formModifierMembre" class="nav-link">Gérer mon&nbsp;profil</a></li>
                            </ul>
                            <?php if($_SESSION["type"] == 2 || $_SESSION["type"] == 3){ ?>
                                <ul class="navbar-nav mx-auto">
                                    <li id="annoce" class="nav-item"><a href="index.php?Admin&action=afficherAdmin" class="nav-link">Admin</a></li>
                                </ul>
                            <?php } ?>
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item"><a href="index.php?Messagerie&action=afficherMessagerie" class="nav-link" >Messagerie</a></li>
                            </ul>
                        <?php } ?>
                        <ul class="navbar-nav">
<!--                            <li class="nav-item">-->
<!--                            --><?php //if (isset($_SESSION["id"])) {
//                                //echo 'Bonjour, ' . $_SESSION["prenom"];
//                            } ?>
<!--                            </li>-->
                            <li class="nav-item mx-1">
                                <?php if (isset($_SESSION["id"])) { ?>
                                    <a href="index.php?Membres&action=logout" id="btn-logout" class="btn btn-block navbar-btn text-white btn-primary m-1">
                                        <i class="far fa-user-circle"></i> Se déconnecter</a>
                                <?php } else { ?>
                                    <a id="btn-login" class="btn btn-block navbar-btn text-white btn-secondary m-1">
                                        <i class="far fa-user-circle"></i> Se connecter</a>
                                <?php } ?>
                            </li>
                            <li class="nav-item mx-1">
                                <button id="cart" class="btn btn-info btn-block dropdown-toggle text-uppercase text-white m-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-shopping-cart"> <span class="badge" id="cartQuantity"><?= isset($_SESSION["cart"]) ? sizeof($_SESSION["cart"]) : "0" ?></span></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right container" id="shopping-cart">
                                    <div class="shopping-cart">
                                        <table class="table table-striped table-panier">
                                        <?php if (isset($_SESSION["cart"]) && sizeof($_SESSION["cart"]) > 0) {
                                            $i = 0;
                                            $total = 0;
                                            foreach ($_SESSION["cart"] as $jeux) { ?>
                                                <tr id="jeuxAchete<?= $jeux->getJeuxId() ?>" class="dropdown-item">
                                                    <td class="text-center">
                                                        <a href="index.php?Jeux&action=afficherJeu&JeuxId=<?= $jeux->getJeuxId() ?>"  class="img-thumbnail" >
                                                            <img class="card-img-top" src="<?= $_SESSION["cartImages"][$i]->getCheminPhoto() ?>" alt="Card image cap">
                                                        </a>
                                                    </td>
                                                    <td class="text-center"><?= $jeux->getTitre() ?></td>
                                                    <td class="text-center"><?= number_format($jeux->getPrix(), 2) ?> $CAD</td>
                                                    <td class="text-center"> x <?= isset($_SESSION["quantite"][$i]) ? $_SESSION["quantite"][$i] : "1" ?></td>
                                                    <td class="text-center"><?= isset($_SESSION["prix"][$i]) ? number_format($_SESSION["prix"][$i], 2) : $jeux->getPrix() ?> $CAD</td>
                                                    <td class="text-center">
                                                        <button id="supprimerJeuxCart<?= $jeux->getJeuxId() ?>" onclick="supprimerJeuxCart('<?= $jeux->getJeuxId() ?>')" class="btn btn-danger"><i class="fa fa-eraser"></i></button>
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                            } ?>
                                            <tr class="dropdown-item">
                                                <td class="totalPanier" colspan="3">Total</td>
                                                <td><?= number_format($_SESSION["prixTotal"], 2) ?> $CAD</td>
                                                <td></td>
                                            </tr>
                                        <?php } else { ?>
                                            <tr class="dropdown-item">
                                                <td colspan="5"><strong>le panier est vide</strong></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                    <div class="dropdown-item">
                                        <a href="index.php?Achat&action=afficherPanier" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Check-out</a>
                                    </div>
                                </div> <!--end shopping-cart -->
                            </li>
                            <li class="toggle-item">
                                <div class="btn-toggle">
                                    <div class="bar"></div>
                                    <div class="bar-center"></div>
                                    <div class="bar"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Modal -->
            <div class="modal fade" id="modal-login" role="dialog">
                <div class="modal-dialog">
                    <!-- Contenu du formulaire MODAL de connexion d'utilisateur-->
                    <div class="modal-content">
                        <div class="modal-header" style="padding:35px 50px;">
                            <h4><i class="fas fa-sign-in-alt"></i> Se connecter</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body" style="padding:40px 50px;">
                            <form action="index.php?Membres&action=verifierLogin" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="usrname" placeholder="Courriel" name="courriel" required value="david.hod@gmail.com">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="psw" placeholder="Mot de passe" name="mot_de_passe" required value="pacman_2018">
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" value="" checked>  Se souvenir de moi</label>
                                </div>
                                <button type="submit" class="btn btn-success btn-block"><i class="fas fa-sign-in-alt"></i> Se connecter</button>
                                <div class="pt-2">
                                    Mot de passe <a class="font-weight-bold" href="#">oublié?</a>
                                </div>
                            </form>
                        </div>
                        <!-- Footer du modal -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger btn-default float-right" data-dismiss="modal"><i class="fas fa-times"></i> Canceller</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(isset($_SESSION["msg"]) && $_SESSION["msg"] != ""){
                echo '<h5 class="text-warning text-center mt-1">' . $_SESSION["msg"] . '</h5>';
            } ?>
        </header>
        <?php
            // echo "<pre>";
            // var_dump($_SESSION["cart"], $_SESSION["cartImages"], $_SESSION["datesLocation"], $_SESSION["quantite"], $_SESSION["prix"], $_SESSION["prixTotal"]);
            // var_dump($_SESSION["datesLocation"], $_SESSION["test"], $_SESSION["quantite"], $_SESSION["prix"], $_SESSION["prixTotal"]);
            // echo "</pre>";
        ?>
        <main> <!-- fini dans footer.php -->
        <script>
            $("#cart").on("click", function () {
                if ($("#quantitePanier").val() > 0) {
                    $("#shopping-cart").fadeToggle("fast");
                }
            });
            function supprimerJeuxCart(id) {
                bootoast.toast({
                    message: 'Jeux supprimee correctement!',
                    type: 'success',
                    position: 'top-center'
                });
                request = $.ajax({
                    url: "index.php?achat&action=supprimer",
                    type: "post",
                    data: {
                        jeux_id: id
                    }
                });
                request.done(function (response) {
                    location.reload();
                });
            }
            function AjouterAuPanier(id) {
                if ($("#membre_id").val() != "") {
                    bootoast.toast({
                        message: 'Jeux Ajoutee correctement!',
                        type: 'success',
                        position: 'top-center'
                    });
                    request = $.ajax({
                        url: "index.php?achat&action=ajouterAuPanier",
                        type: "post",
                        data: {
                            jeux_id: id,
                            dates: $("#datesLocation").val() ? $("#datesLocation").val() : 1
                        }
                    });
                    request.done(function (response) {
                        location.reload();
                    });
                } else {
                    bootoast.toast({
                        message: 'Seuls les membres inscrits peuvent acheter/louer un jeux!',
                        type: 'warning',
                        position: 'top-center'
                    });
                }
            }
        </script>