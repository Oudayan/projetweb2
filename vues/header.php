<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>

<body>
<nav class="navbar navbar-expand-md navbar-dark sticky-top" id="navheader">
    <div class="container"> <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar12">
            <span class="navbar-toggler-icon" ></span>
        </button>
        <a href="index.php?Jeux&action=derniers"><img src="images/logo.png" height="60" class="logo" title="GameXchange" alt="GameXchange Logo"></a>

        <div class="collapse navbar-collapse" id="navbar12"> <a class="navbar-brand d-none d-md-block" href="#">
            </a>
            <ul class="navbar-nav mx-auto">
                <?php
                if(isset($_SESSION["courriel"])) {
                    echo "<li id='annoce' class=\"nav-item\"><a href='index.php?Jeux&action=formAjoutJeux'class=\"nav-link\">Annoncer</a></li>";
                    echo "<li class=\"nav-item\"><a class=\"nav-link\">Messagerie</a></li>";
                } ?>

            </ul>
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"> <a class="nav-link" href="index.php?Jeux&action=rechercherJeux">Chercher</a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"> <a class="nav-link" href="#"><?php
                        if(isset($_SESSION["courriel"])) {
                            echo 'Bonjour, ' . $_SESSION["prenom"];
                        } ?></a>
                </li>

                <?php if (isset($_SESSION["courriel"])) { ?>
                    <a href="index.php?Membres&action=logout" id="btn-logout" class="btn navbar-btn text-white btn-primary">
                        <i class="far fa-user-circle"></i> Se déconnecter</a>
                <?php } else { ?>
                    <a id="btn-login" class="btn navbar-btn text-white btn-secondary">
                        <i class="far fa-user-circle"></i> Se connecter</a>
                <?php } ?>
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
                        <label><input type="checkbox" value="" checked>  Se souvenir de moi></label>
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
<!--        <div id="page-wrap">-->
<!--            <div id="title-chat">-->
<!--                <p>Chat</p>-->
<!--                <button class="minimize">▼</button>-->
<!--            </div>-->
<!--            <p id="name-area"></p>-->
<!--            <div id="chat-wrap"><div id="chat-area"></div></div>-->
<!--            <form id="send-message-area">-->
<!--                <p style="color:#000;">Votre message: </p>-->
<!--                <textarea id="sendie" maxlength = '100' ></textarea>-->
<!--            </form>-->

<!--        </div>-->


