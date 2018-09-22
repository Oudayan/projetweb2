<div class="py-5 text-white bg-secondary">
    <div class="container">
        <div class="row">
            <div class="align-self-center p-5 col-md-6">
                <h1 class="mb-4">S'inscrire</h1>

                <form action="/action_page.php">
                    <div class="form-group">
                        <label for="email">Courriel :</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mot de passe :</label>
                        <input type="password" class="form-control" id="pwd">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Confirmer mot de passe:</label>
                        <input type="password" class="form-control" id="pwd">
                    </div>
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


<div class="album py-2 bg-light">

    <div class="container">
        <h1 class="text-center bg-info mt-2">NOUVEAUTÉS</h1>
        <div class="row">


            <?php

            $counter = count($donnees['derniers']);
//            var_dump($donnees['images']);

            for ($i = 0; $i <= $counter -1; $i++) {


                echo    '<div class="col-md-4">';
                echo        '<div class="card mb-4 box-shadow">';
                echo            '<img class="card-img-top" src="images/thumb01.jpg" alt="Card image cap">';
                echo            '<div class="card-body">';
                echo                '<p class="card-text">' . $donnees['derniers'][$i]->getTitre() . '</p>';
                echo                '<div class="d-flex justify-content-between align-items-center">';
                echo                    '<div class="btn-group">';
                echo                        '<button type="button" class="btn btn-sm btn-outline-secondary">Détails</button>';
                echo                        '<button type="button" class="btn btn-sm btn-outline-secondary">Acheter</button>';
                echo                    '</div>';
                echo                    '<small class="text-muted">Prix : ' . $donnees['derniers'][$i]->getPrix() . ' $CAD</small>';
                echo                '</div>';
                echo           '</div>';
                echo        '</div>';
                echo    '</div>';

            }

            ?>
        </div>
    </div>
</div>