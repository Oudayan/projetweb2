<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>GameXchange - Jeux Vidéos d'occasion</title>
    <meta charset="utf-8">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>

    <!--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    
    <link rel="stylesheet" href="css/styleChat.css" type="text/css" />
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="js/scriptChat.js"></script>
        <script type="text/javascript"> 
        $(document).ready(function () {
            setInterval('chat.update()', 1000);
        })
               
        </script>
    -->

</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top">
    <div class="container-fluid">

        <ul>

            <li class="logo"><a href="index.php?Jeux&action=derniers"><img src="images/logo.png" height="60"
                                                                           class="logo" title="GameXchange"
                                                                           alt="GameXchange Logo"></a></li>

            <li class="item"><a class="navbar-brand" href="index.php?Jeux&action=derniers"></a></li>


            <li class="item">
                <a class="navbar-brand" href="#">
                    <i class="fa d-inline fa-lg"></i>
                    <b>Acheter</b>
                </a>
            </li>

            <li class="item">
                <a class="navbar-brand" href="#">
                    <i class="fa d-inline fa-lg"></i>
                    <b>Vendre</b>
                </a>
            </li>


            <li class="item">
                <a class="navbar-brand" href="#">
                    <i class="fa d-inline fa-lg"></i>
                    <b>Louer</b>
                </a>
            </li>
            <li>

            <li class="nav-item pr-4 item">
                <form class="m-0">
                    <input class="form-control mr-1" type="text" placeholder="Chercher pour jeux">
                    <button class="btn btn-secondary" type="submit"><i class="fas fa-search"></i></button>
                </form>

            </li>
            <li>  <?php if (isset($_SESSION["courriel"])) {
                    echo 'Bonjour '. $_SESSION["prenom"];
                } ?>
            </li>
            <li class="item">
                <?php if (isset($_SESSION["courriel"])) { ?>
                    <a href="index.php?Membres&action=logout" id="btn-logout"
                       class="btn navbar-btn text-white btn-secondary">
                        <i class="far fa-user-circle"></i> Se déconnecter</a>
                <?php } else { ?>
                    <a id="btn-login" class="btn navbar-btn text-white btn-secondary">
                        <i class="far fa-user-circle"></i> Se connecter</a>
                <?php } ?>

            </li>

            <li class="toggle-item">
                <div class="btn-toggle">
                    <div class="bar"></div>
                    <div class="bar-center"></div>
                    <div class="bar"></div>
                </div>
            </li>

        </ul>


        <!--div class="collapse navbar-collapse text-center justify-content-end" id="btn-navbar">
            <ul class="navbar-nav">
                
            </ul>
            
        </div-->
    </div>
</nav>


<div class="text-center bg-dark ">
    <?php if (isset($_SESSION["msg"])) {
        echo '<h1>' . $_SESSION["msg"] . '</h1>';
    } ?>
</div>

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
                        <input type="text" class="form-control" id="usrname" placeholder="Courriel" name="courriel" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="psw" placeholder="Mot de passe" name="mot_de_passe" required>
                    </div>
                    <div class="checkbox">

                        <label><input type="checkbox" value="" checked>  Se souvenir de moi></label>

                    </div>
                    <button type="submit" class="btn btn-success btn-block"><i class="fas fa-sign-in-alt"></i> Se
                        connecter
                    </button>
                    <div class="pt-2">
                        Mot de passe <a class="font-weight-bold" href="#">oublié?</a>
                    </div>
                </form>
            </div>
            <!-- Footer du modal -->
            <div class="modal-footer">
                <div class="text-center  ">
                    <?php if (isset($_SESSION["msg"])) {
                        echo  $_SESSION["msg"];
                    } ?>
                </div>
                <button type="submit" class="btn btn-danger btn-default float-right" data-dismiss="modal"><i
                            class="fas fa-times"></i> Canceller
                </button>

            </div>
        </div>
    </div>
</div>
<!--        <div id="page-wrap">-->
<!---->
<!--            <div id="title-chat">-->
<!--                <p>Chat</p>-->
<!--                <button class="minimize">▼</button>-->
<!--            </div>-->
<!--            <p id="name-area"></p>-->
<!--            <div id="chat-wrap"><div id="chat-area"></div></div>-->
<!--            <form id="send-message-area">-->
<!--                <p style="color:#000;">Votre message: </p>-->
<!--                <textarea id="sendie" maxlength = '100' ></textarea>-->
<!--                -->
<!--            </form>-->
<!---->
<!--        </div>-->
