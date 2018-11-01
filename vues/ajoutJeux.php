<?php
/**
 * @file      ajoutJeux.php
 * @author    Guilherme Tosin, Marcelo Guzmán, Oudayan Dutta
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Fichier de vue pour l'ajout de jeu
 * @details   Cette vue permettre l'insertion de nouveaux jeux dans la BD
 */

if (isset($_SESSION['id'])) {
    if (isset($donnees['jeu'])) {
        $titre = $donnees['jeu']->getTitre();
        $prix = $donnees['jeu']->getPrix();
        $concepteur = $donnees['jeu']->getConcepteur();
        if ($donnees['jeu']->getLocation()) {
            $location = "checked";
            $vendre = "";
        }
        else {
            $location = "";
            $vendre = "checked"; 
        } 
        $plateforme_id = $donnees['jeu']->getPlateformeId();
        $description = $donnees['jeu']->getDescription();
    }
    else {
        $titre = $prix = $concepteur = $location = $vendre = $plateforme_id = $description = "";
    }
    for ($i = 0; $i < count($donnees['categories']); $i++) {
        $categorie[$i] = "";
        if (isset($donnees['categoriesJeu'])) {
            for ($j = 0; $j < count($donnees['categoriesJeu']); $j++) {
                if ($donnees['categories'][$i]->getCategorieId() == $donnees['categoriesJeu'][$j]->getCategorieId()) {
                    $categorie[$i] = " checked";
                }
            }
        }
    } ?>
    <div class="container">
        <div class="d-flex-row justify-content-between">
            <div class="d-flex justify-content-center">
                <h2 class="my-3 jeu-titre"><?= isset($donnees['jeu']) ? 'Modifier un jeu' : 'Ajouter un jeu' ?></h2>
                <?php if (isset($donnees['admin'])) { ?>
                <button type="button" class="btn ml-auto px-4 border-0 text-danger" onclick="getPage(<?= $_SESSION['params']['page'] . ', ' . $_SESSION['params']['itemsParPage'] . ', \'' . $_SESSION['params']['tri'] . '\', ' . $_SESSION['params']['ordre']?>)"><h2>&times;</h2></button>
                <?php } ?>
            </div>
            <form action="index.php?Jeux&action=enregistrerJeux" method="POST">
                <input type="hidden" name="jeux_id" id="jeux_id" value="<?= isset($donnees['jeu']) ? $donnees['jeu']->getJeuxId() : 0 ?>">
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label for="pwd">Titre&nbsp;:</label>
                        <input type="text" class="form-control" id="titre" name="titre" value="<?=$titre?>" placeholder=""> 
                    </div>
                    
                    <div class="col-lg-4">
                        <label for="pwd">Prix&nbsp;:</label>
                        <input type="text" class="form-control" id="prix" name="prix" value="<?=$prix?>">
                    </div>
                    
                    <div class="col-lg-4">
                        <label for="pwd">Concepteur&nbsp;:</label>
                        <input type="text" class="form-control" id="concepteur" name="concepteur" value="<?=$concepteur?>" placeholder="">
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <legend class="col-sm-4">Mettre votre jeu&nbsp;à&nbsp;:</legend>
                    <fieldset class="col-sm-4 d-flex flex-row justify-content-between">
                        <div>
                            <input type="radio" id="louer" name="location" value="1" <?= $location ?>/>
                            <label for="louer">Louer </label>
                        </div>
                        <div>
                            <input type="radio" id="vendre" name="location" value="0" <?= $vendre ?>/>
                            <label for="vendre">Vendre</label>
                        </div>
                    </fieldset>
                    <div class="col-sm-4">
                        <label>Type de plateforme&nbsp;:</label>
                        <select class="form-control" id="plateforme_id" name="plateforme_id">
                        <?php for($i = 0; $i < count($donnees['plateforme']); $i++) {
                            echo "<option value='". $donnees['plateforme'][$i]->getPlateformeId() . "' " . ($donnees['plateforme'][$i]->getPlateformeId() == $plateforme_id ? 'selected' : '') . ">" . $donnees['plateforme'][$i]->getPlateforme() . "</option>";
                        } ?>
                        </select>
                    </div>  
                </div>
                <hr>
                <div class="form-group row">
                    <label class="ml-3">Categories de jeu&nbsp;:</label>
                    <div class="d-flex flex-wrap justify-content-between">   
                    <?php for($i = 0; $i < count($donnees['categories']); $i++) { 
                        if ($i == 0 || $i == ceil(count($donnees['categories']) / 2)) { ?>
                        <div class="col-md-6">
                            <div class="row">
                            <?php } ?>
                                <div id='categories' class='col-6'>
                                    <input type='checkbox' name='categorie[]' value='<?= $donnees['categories'][$i]->getCategorieId() . "' " . $categorie[$i] ?>>
                                    <label class='ml-2'><?= $donnees['categories'][$i]->getCategorie() ?></label><br>
                                </div>
                            <?php if ($i == ceil(count($donnees['categories']) / 2) - 1 || $i == count($donnees['categories']) - 1) { ?>
                            </div>
                        </div>
                        <?php } 
                    } ?>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="ml-3">Description&nbsp;:</label>
                    <textarea id="description" class="form-control mx-3" name="description" rows="4"><?= $description ?></textarea>
                </div>
                <hr>
                <!-- <pre>
                <?php //var_dump($donnees['images']); ?>
                </pre> -->
                <div id="groupeImages"class="form-group row">
                    <div id="imageBox1" class="col-sm-6 col-lg-3 shadow p-2 my-2 bg-white rounded">
                        <h5 class="text-center">Image 1</h5>
                        <div id="image1">
                        <?php if (isset($donnees["images"][0])) { ?>
                            <input type="text" id="inputImage1" name="cheminsImages[]" value="<?=  $donnees['images'][0]->getCheminPhoto() ?>" hidden />
                            <img src="<?= $donnees['images'][0]->getCheminPhoto() ?>" class="img-responsive">
                        <?php } else { ?>
                            <input type="text" id="inputImage1" name="cheminsImages[]" hidden />
                        <?php } ?>
                        </div>
                        <div class="d-flex flex-wrap justify-content-center">
                        <?php if (isset($donnees["images"][0]) && $donnees["images"][0] != "images/image_defaut.png") { ?>
                            <button type="button" class="btn btn-outline-danger my-2" onclick="deleteImage(1, <?= isset($donnees['images'][0]) ? $donnees['images'][0]->getPhotoJeuxId() : '' ?>)">Effacer</button>
                        <?php } else { ?>
                            <label for="upload1" class="upload my-2">
                                <i class="fas fa-file-upload"></i> Choisir image
                            </label>
                            <input type="file" id="upload1" class="hidden" onchange="upload(this, 1)"/>
                        <?php } ?>
                        </div>
                    </div>
                    <hr>
                    <div id="imageBox2" class="col-sm-6 col-lg-3 shadow p-2 my-2 bg-white rounded <?= isset($donnees['images'][0]) ? '' : 'hidden' ?>">
                        <h5 class="text-center">Image 2</h5>
                        <div id="image2">
                        <?php if (isset($donnees["images"][1])) { ?>
                            <input type="text" id="inputImage2" name="cheminsImages[]" value="<?= $donnees['images'][1]->getCheminPhoto() ?>" hidden />
                            <img src="<?= $donnees['images'][1]->getCheminPhoto() ?>" class="img-responsive">
                        <?php } else { ?>
                            <input type="text" id="inputImage2" name="cheminsImages[]" hidden />
                        <?php } ?>
                        </div>
                        <div class="d-flex flex-wrap justify-content-center">
                        <?php if (isset($donnees["images"][1]) && $donnees["images"][1] != "images/image_defaut.png") { ?>
                            <button type="button" class="btn btn-outline-danger my-2" onclick="deleteImage(2, <?= isset($donnees['images'][1]) ? $donnees['images'][1]->getPhotoJeuxId() : '' ?>)">Effacer</button>
                        <?php } else { ?>
                            <label for="upload2" class="upload my-2">
                                <i class="fas fa-file-upload"></i> Choisir image
                            </label>
                            <input type="file" id="upload2" class="hidden" onchange="upload(this, 2)"/>
                        <?php } ?>
                        </div>
                    </div>
                    <hr>
                    <div id="imageBox3" class="col-sm-6 col-lg-3 shadow p-2 my-2 bg-white rounded <?= isset($donnees['images'][1]) ? '' : 'hidden' ?>">
                        <h5 class="text-center">Image 3</h5>
                        <div id="image3">
                        <?php if (isset($donnees["images"][2])) { ?>
                            <input type="text" id="inputImage3" name="cheminsImages[]" value="<?=  $donnees['images'][2]->getCheminPhoto() ?>" hidden />
                            <img src="<?= $donnees['images'][2]->getCheminPhoto() ?>" class="img-responsive">
                        <?php } else { ?>
                            <input type="text" id="inputImage3" name="cheminsImages[]" hidden />
                        <?php } ?>
                        </div>
                        <div class='d-flex flex-wrap justify-content-center'>
                        <?php if (isset($donnees["images"][2]) && $donnees["images"][2] != "images/image_defaut.png") { ?>
                            <button type="button" class="btn btn-outline-danger my-2" onclick="deleteImage(3, <?= isset($donnees['images'][2]) ? $donnees['images'][2]->getPhotoJeuxId() : '' ?>)">Effacer</button>
                        <?php } else { ?>
                            <label for="upload3" class="upload my-2">
                                <i class="fas fa-file-upload"></i> Choisir image
                            </label>
                            <input type="file" id="upload3" class="hidden" onchange="upload(this, 3)">
                        <?php } ?>
                        </div>
                    </div>
                    <hr>
                    <div id="imageBox4" class="col-sm-6 col-lg-3 shadow p-2 my-2 bg-white rounded <?= isset($donnees['images'][2]) ? '' : 'hidden' ?>">
                        <h5 class="text-center">Image 4</h5>
                        <div id="image4">
                        <?php if (isset($donnees["images"][3])) { ?>
                            <input type="text" id="inputImage4" name="cheminsImages[]" value="<?=  $donnees['images'][3]->getCheminPhoto() ?>" hidden />
                            <img src="<?= $donnees['images'][3]->getCheminPhoto() ?>" class="img-responsive">
                        <?php } else { ?>
                            <input type="text" id="inputImage4" name="cheminsImages[]" hidden />
                        <?php } ?>
                        </div>
                        <div class='d-flex flex-wrap justify-content-center'>
                        <?php if (isset($donnees["images"][3]) && $donnees["images"][3] != "images/image_defaut.png") { ?>
                            <button type="button" class="btn btn-outline-danger my-2" onclick="deleteImage(4, <?= isset($donnees['images'][3]) ? $donnees['images'][3]->getPhotoJeuxId() : '' ?>)">Effacer</button>
                        <?php } else { ?>
                            <label for="upload4" class="upload my-2">
                                <i class="fas fa-file-upload"></i> Choisir image
                            </label>
                            <input type="file" id="upload4" class="hidden" onchange="upload(this, 4)">
                        <?php } ?>
                        </div>
                    </div>
                </div>
                <hr>
                <?php if (!isset($donnees["admin"])) { ?> 
                <div class="d-flex justify-content-around mt-2 mb-5">
                    <a href="index.php?Jeux&action=gererMesJeux"><button type="button" class="btn-lg btn-outline-secondary">Annuler</button></a>
                    <input type="submit" class="btn btn-lg btn-outline-success" value="Sauvegarder">
                </div>
                <?php } ?>
            </form>
            <?php if (isset($donnees["admin"])) { ?>
            <div class="d-flex justify-content-around my-2">
                <?php if (isset($_SESSION['params'])) { ?>
                <button class="btn btn-outline-secondary btn-lg m-2" onclick="getPage(<?= $_SESSION['params']['page'] . ', ' . $_SESSION['params']['itemsParPage'] . ', \'' . $_SESSION['params']['tri'] . '\', ' . $_SESSION['params']['ordre']?>)">Annuler</button>
                <?php } ?>
                <button class="btn btn-outline-success btn-lg m-2" id="btnValidation" onclick="sauvegarderJeu()">Sauvegarder</button>
            </div>
            <?php } ?>
        </div>
    </div>
<?php } else {
    echo "Vous n'avez pas la permission d'acceder à cette page";
} ?>
<script>
    function upload(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            formData = new FormData();
            formData.append('files[]', input.files[0]);  
            $.ajax({
                url: "index.php?Images&action=sauvegardeFichiersImages&Id=" + id ,
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType:"html",
                success: function(data) {
                    $('#image' + id).html(data);
                    $('#imageBox' + (id + 1)).removeClass("hidden");
                    updateDeleteButtons();
                }
            });
        };
    }; 

    function deleteImage(id, photoJeuxId) {
        var cheminImage = $('#inputImage' + id).val();
        var formData = new FormData();
        formData.append('files[]', cheminImage);
        console.log(cheminImage);
        if (cheminImage) {
            $.ajax({
                url: "index.php?Images&action=deleteFichierImage&Id=" + id + "&photoJeuxId=" + photoJeuxId,
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType:"html",
                success: function(data) {
                    $('#image' + id).html(data);
                    $('#image' + (id + 1)).addClass("hidden");
                    updateDeleteButtons();
                }
            });
        }
    }; 


    var updateDeleteButtons = function() {
        var cheminsImages = $("[id^=inputImage]");
        var boutonsEffacer = $('.btn-outline-danger'); 
        for (var i = 0; i < cheminsImages.length; i++) {
            if (cheminsImages[i].value != "") {
                $(boutonsEffacer[i]).removeClass("hidden");
            }
        }
    };

    $('#groupeImages').ready(function(){
        updateDeleteButtons();
    });

    // Validation

    // console.log(titre);
    // console.log(prix);
    // console.log(concepteur);
    // console.log(description);
    function chkTitre(){
        var titre = $('#titre').val();
            if (titre == "") {
            $('#titre').attr("placeholder", "Entrez le titre de jeu");
        }
    }

    function chkPrix() {
        var prix = $('#prix').val();
        if (prix == "") {
            $('#prix').attr("placeholder", "Entrez le prix de jeu");
        }
    }

    function chkConcepteur() {
        var concepteur = $('#concepteur').val();
        if (concepteur == "") {
            $('#concepteur').attr("placeholder", "Entrez le concepteur de jeu");
        }
    }

    function chkDescription() {
        var description = $('#description').val();
        if (description == "") {
            $('#description').attr("placeholder", "Entrez le description de jeu");
        }
    }
    
    $('#titre').blur(function() {
        chkTitre();
    });

    $('#prix').blur(function() {
        chkPrix();
    });

    $('#concepteur').blur(function() {
        chkConcepteur();
    });

    $('#description').blur(function() {
        chkDescription();
    });

</script>
