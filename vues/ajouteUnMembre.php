<div class="py-5 text-white bg-secondary">
    <div class="container">
        <div class="row">
            <div class="align-self-center p-5 col-md-6">
                <h1 class="mb-4">S'inscrire</h1>


                <form action="index.php?Membres&action=enregistrerMembre" method="POST">
                    <div class="form-group">
                        <label for="email">Courriel :</label>
                        <input type="email" class="form-control" id="email" name="courriel">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mot de passe :</label>
                        <input type="password" class="form-control" id="pwd" name="MotDePasse">
                    </div>
                    <div class="form-group">
                        <label for="confimerMotDePasse">Confirmer mot de passe:</label>
                        <input type="password" class="form-control" id="confimerMotDePasse" name="mot_de_passe">
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-control" id="nom" name="nom">
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom:</label>
                        <input type="text" class="form-control" id="prenom" name="prenom">
                    </div>

                    <div class="form-group">
                        <label for="adresse">Adresse:</label>
                        <input type="text" class="form-control" id="adresse" name="adresse">
                    </div>
                    <div class="form-group">
                        <label for="telephone">Téléphone:</label>
                        <input type="text" class="form-control" id="telephone" name="telephone">
                    </div>

                    <input type="text" hidden name="membre_id" value="null">
                    <input type="text" hidden name="type_utilisateur_id" value="1">


                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </form>


            </div>
            <div class="col-md-6 p-0">
                <div class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img src="images/01.jpg" atl="first slide" class="d-block img-fluid w-100">
                            <!--<div class="carousel-caption">-->
                            <!--</div>-->
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid w-100" src="images/02.jpg" data-holder-rendered="true">
                            <!--<div class="carousel-caption">-->
                            <!--</div>-->
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid w-100" src="images/03.jpg" data-holder-rendered="true">
                            <!--<div class="carousel-caption">-->
                            <!--</div>-->
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carousel1" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel1" role="button" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>