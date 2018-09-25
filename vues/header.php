<!DOCTYPE html>
<<<<<<< HEAD
<html lang="zxx">
<head>
    <title>GameXchange - Jeux Vidéos d'occasion</title>
    <meta charset="utf-8">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.html"></a>
        <a href="index.html"><img src="images/logo.png" height="60" class="logo" title="GameXchange" alt="GameXchange Logo"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#btn-navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-center justify-content-end" id="btn-navbar">
            <ul class="navbar-nav">
                <li class="nav-item pr-4">
                    <form class="form-inline m-0">
                        <input class="form-control mr-1" type="text" placeholder="Chercher pour jeux">
                        <button class="btn btn-secondary" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </li>
            </ul>
            <a id="btn-login" class="btn navbar-btn text-white btn-secondary">
                <i class="far fa-user-circle"></i> Se connecter</a>
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
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" id="usrname" placeholder="Courriel">
=======
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       
       
        <link rel="stylesheet" href="Chat/style.css" type="text/css" />
        <title></title>
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="Chat/chat.js"></script>
        <script type="text/javascript" src="Chat/script.js"></script>
        <script type="text/javascript"> 
        $(document).ready(function () {
            setInterval('chat.update()', 1000);
        })
        </script>
    <body>
        <div id="page-wrap">
            
            <p id="name-area"></p>
            
            <div id="chat-wrap"><div id="chat-area"></div></div>
            
            <form id="send-message-area">
                <p style="color:#000;">Your message: </p>
                <textarea id="sendie" maxlength = '100' ></textarea>
            </form>

        </div>
        <header class="container-fluid"> 
            <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                <div class="container">
<<<<<<< HEAD
                    <div>
                        <a class="navbar-brand" href="index.php?Recherches&action=accueil">
                            <i class="fa d-inline fa-lg"></i>
                            <b>Game Logo</b>
                        </a>
                    </div>
                    <div>
                        <a class="navbar-brand" href="#">
                            <i class="fa d-inline fa-lg"></i>
                            <b>Acheter</b>
                        </a>
                    </div>

                    
                    <div>
                        <a class="navbar-brand" href="#">
                            <i class="fa d-inline fa-lg"></i>
                            <b>Vendre</b>
                        </a>
                    </div>
                    <div>
                        <a class="navbar-brand" href="#">
                            <i class="fa d-inline fa-lg"></i>
                            <b>Louer</b>
                        </a>
                    </div>
                    <!-- <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent">
                        <span class="navbar-toggler-icon"></span>                      
                    </button>
                    <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
                        <a class="btn navbar-btn ml-2 text-white btn-secondary">S'inscrire'</a>
                    </div> -->

=======
                    <a class="navbar-brand" href="index.php?Jeux&action=derniers">
                        <i class="fa d-inline fa-lg"></i>
                        <b>Game Logo</b>
                    </a>
>>>>>>> 0df7c041245862528ec6a24a5d6ceac970a85210
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        <i class="fa d-inline fa-lg fa-user-circle-o"></i>
                        Se connecter
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <form role="form" action="index.php?Membres&action=verificationLogin" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Se connecter</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-modal-body mx-sm-1 mx-md-3 mx-lg-5">
                                        <div class="form-group row">
                                            <div class="col-md-10">
                                                <input type="text" name="courriel" class="form-control" id="courriel" placeholder="Courriel">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-10">
                                                <input type="text" name="mot_de_passe" class="form-control" id="mot_de_passe" placeholder="Mot de passe">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-10">
                                            <a href="#">Vous avez oublié votre mot de passe?</a>
                                            </div>
                                        </div>    
                                    </div>
                                    <div class="modal-footer">                                      
                                        <a href="#">S'inscrire</a>
                                        <button type="button" class="btn btn-primary">Se Connecter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
>>>>>>> f218d08d624f270dd3a14cf5754a2ca62b48944d
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="psw" placeholder="Mot de passe">
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="" checked> Se souvenir de moi</label>
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