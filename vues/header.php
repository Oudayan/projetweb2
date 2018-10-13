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
                        <?php if(isset($_SESSION["id"])){ ?>
                            <ul class="navbar-nav mx-auto">
                                <a href="index.php?Jeux&action=gererMesJeux" class="btn text-white m-1">
                                    <i class="fas fa-gamepad"></i> Mes Jeux</a>
                            </ul>
                            <ul class="navbar-nav mx-auto">
                                <a href="index.php?Membres&action=formModifierMembre" class="btn text-white m-1">
                                    <i class="fas fa-user"></i> Mon Profil</a>
                            </ul>
                            <ul class="navbar-nav mx-auto">
                                <a href="index.php?Messagerie&action=afficherMessagerie" class="btn text-white m-1">
                                    <i class="fas fa-envelope-open"></i> Messagerie</a>
                            </ul>
                            <?php if($_SESSION["type"] == 2 || $_SESSION["type"] == 3){ ?>
                                <ul class="navbar-nav mx-auto">
                                    <a href="index.php?Admin&action=afficherAdmin" class="btn text-white m-1">
                                        <i class="fas fa-cogs"></i> Admin</a>
                                </ul>
                            <?php } ?>
                        <?php } ?>
                        <ul class="navbar-nav mx-auto">
                            <a href="index.php?Jeux&action=rechercherJeux" class="btn text-white m-1"><i class="fas fa-search"></i> Rechercher Jeux</a>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item mx-1">
                                <?php if (isset($_SESSION["id"])) { ?>
                                    <a href="index.php?Membres&action=logout" id="btn-logout" class="btn btn-block navbar-btn text-white btn-primary m-1">
                                        <i class="far fa-user-circle"></i> Se déconnecter</a>
                                <?php } else { ?>
                                    <a id="btn-login" class="btn btn-block navbar-btn text-white btn-secondary m-1">
                                        <i class="far fa-user-circle"></i> Se connecter</a>
                                <?php } ?>
                            </li>
                            <!-- Cart -->
                            <li id="cart-menu-container" class="nav-item mx-1">
                                <?php include("panier.php"); ?>
                            </li>
                            <!--end shopping-cart -->
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
<!--            chunliang le 11/10/2018 pour enlever le div d`erreur de message-->
<!--            --><?php //if(isset($_SESSION["msg"]) && $_SESSION["msg"] != ""){
//                echo '<h5 class="text-warning text-center mt-1">' . $_SESSION["msg"] . '</h5>';
//            } ?>
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
                    message: 'Jeu supprimé correctement!',
                    type: 'success',
                    position: 'top-center'
                });
                request = $.ajax({
                    url: "index.php?Achat&action=supprimer",
                    type: "post",
                    data: {
                        jeux_id: id
                    }
                });
                request.done(function (response) {
                    //location.reload();
                    $('#cart-menu-container').html("");
                    $('#cart-menu-container').html(response);
                    $('#cart').trigger('click.bs.dropdown');
                });
            }
            function AjouterAuPanier(id) {
                if ($("#membre_id").val() != "") {
                    bootoast.toast({
                        message: 'Jeu ajouté correctement!',
                        type: 'success',
                        position: 'top-center'
                    });
                    request = $.ajax({
                        url: "index.php?Achat&action=ajouterAuPanier",
                        type: "post",
                        data: {
                            jeux_id: id,
                            dates: $("#datesLocation").val() ? $("#datesLocation").val() : 1
                        },
                        dataType: 'html',
                    });
                    request.done(function (response) {
                        //location.reload();
                        $('#cart-menu-container').html("");
                        $('#cart-menu-container').html(response);
                        $('#cart').trigger('click.bs.dropdown');
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