<?php?>
<div class="py-5 text-white bg-secondary">
    <div class="container">
        <div class="row">
            <div class="align-self-center p-5 col-md-6">
                <h1 class="mb-4"><?= isset($donnees['membre']) ? "Modifier mon profil" : "S'inscrire"?></h1>
                <!-- <pre>
                <?=var_dump($donnees)?>
                </pre> -->
                <?php
                    if(isset($donnees['membre'])){
                        $id = $donnees['membre']->getMembreId();
                        $type =  $donnees['membre']->getTypeUtilisateur();
                        $courriel = $donnees['membre']->getCourriel();
                        $mdp = $donnees['membre']->getMotDePasse();
                        $nom = $donnees['membre']->getNom();
                        $prenom = $donnees['membre']->getPrenom();
                        $adresse = $donnees['membre']->getAdresse();
                        $telephone = $donnees['membre']->getTelephone();
                        $valide = $donnees['membre']->getMembreValide();
                        $actif = $donnees['membre']->getMembreActif();
                    }
                    else
                    {
                        $id = $valide = 0;
                        $type = $courriel = $mdp = $nom = $prenom = $adresse = $telephone = "";
                        $actif = 1;
                    }
                ?>
                <form action="index.php?Membres&action=enregistrerMembre" method="POST">
                    <input type="text" hidden name="membre_id" value="<?=$id?>">
                    <input type="text" hidden name="type_utilisateur_id" value="<?=$type?>">
                    <div class="form-group">
                        <label for="email">Courriel :</label><span> *</span>
                        <input type="email" class="form-control" id="email" name="courriel" value="<?=$courriel?>">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mot de passe :</label>
                        <input type="password" class="form-control" id="pwd" name="mot_de_passe" value="<?=$mdp?>">
                    </div>
                    <div class="form-group">
                        <label for="confimerMotDePasse">Confirmer mot de passe:</label>
                        <input type="password" class="form-control" id="confimerMotDePasse" name="confirm_mdp" value="<?=$mdp?>">
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="<?=$nom?>">
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom:</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="<?=$prenom?>">
                    </div>

                    <div class="form-group">
                        <label for="adresse">Adresse:</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" value="<?=$adresse?>">
                    </div>
                    <div class="form-group">
                        <label for="telephone">Téléphone:</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" value="<?=$telephone?>"> 
                    </div>
                    <input type="text" hidden name="membre_valide" value="<?=$valide?>">
                    <input type="text" hidden name="membre_actif" value="<?=$actif?>">
                    <button type="submit" class="btn btn-primary"><?= isset($donnees['membre']) ? "Modifier" : "S'inscrire"?></button>
                </form>


            </div>
            <div class="col-md-6 p-0 mt-5">
                <div id="carouselTrois" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php
                        for($i = 0; $i < count($donnees['imagesTrois']); $i++)
                        {
                            if($i == 0)
                            {
                                echo "<li data-target='#carouselTrois' data-slide-to='" . $i . "' class='active'></li>";
                            }
                            else
                            {
                                echo "<li data-target='#carouselTrois' data-slide-to='" . $i . "'></li>";
                            }
                        }
                        ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php
                        for($i = 0; $i < count($donnees['imagesTrois']); $i++)
                        {
                            if($i == 0)
                            {
                                echo '<div class="carousel-item active">';
                            }
                            else
                            {
                                echo '<div class="carousel-item">';
                            }
                            echo '<img class="d-block w-100" src="' . $donnees['imagesTrois'][$i]->getCheminPhoto() . '" alt="' . $donnees["trois"][$i]->getTitre() . '">';
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselTrois" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselTrois" role="button" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>