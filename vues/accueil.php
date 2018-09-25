<div class="py-5 text-white bg-dark parallax">
    <div class="container">
        <div class="row contact-form">
            <div class="align-self-center mb-3 col-md-6">
                <h1 class="pt-3"><span><i class="fas fa-user-plus"></i></span> S'inscrire</h1>
                <br>
                <form action="index.html">
                    <!-- Aller à la page d'action -->
                    <div class="form-group">
                        <label for="pwd">Adresse courriel :</label>
                        <input type="email" class="form-control" id="courriel">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mot de passe :</label>
                        <input type="password" class="form-control" id="pwd">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Confirmer mot de passe :</label>
                        <input type="password" class="form-control" id="pwd-confirm">
                    </div>
                    <input class="mt-4" type="submit" name="inscrire" value="S'inscrire">
                </form>
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

<div class="album py-2 bg-light">
    <div class="container">
        <h1 class="text-center bg-info mt-2">NOUVEAUTÉS</h1>
        <div class="row">
            <?php

            $counter = count($donnees['derniers']);

            for ($i = 0; $i <= $counter -1; $i++) {


                echo    '<div class="col-md-4">';
                echo        '<div class="card mb-4 box-shadow cardjeux">';
                echo            '<img class="card-img-top" src="' . $donnees['images'][$i]->getCheminPhoto() .'" alt="Card image cap">';
                echo            '<div class="card-body">';
                echo                '<p class="card-text">' . $donnees['derniers'][$i]->getTitre() . '</p>';
                echo                '<div class="d-flex justify-content-between align-items-center">';
                echo                    '<div class="btn-group">';
                echo                        '<button type="button" class="btn btn-sm btn-outline-secondary" onclick="location.href=\'index.php?Jeux&action=afficherJeu&JeuxId=' . $donnees['derniers'][$i]->getJeuxId() . ' \' ">Détails</button>';
                echo                        '<button type="button" class="btn btn-sm btn-outline-secondary">' . ($donnees['derniers'][$i]->getLocation() == 1 ? 'Louer' : 'Acheter') . '</button>';
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


