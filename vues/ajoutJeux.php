<?php
/**
 * @file      ajoutJeux.php
 * @author    Guilherme Tosin, Marcelo Guzmán
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Fichier de vue pour l'ajout de jeu
 * @details   Cette vue permettre l'insertion de nouveaux jeux dans la BD
 */

if(isset($_SESSION['id']))
{

    if(isset($donnees['jeu']))
    {
        $titre = $donnees['jeu']->getTitre();
        $prix = $donnees['jeu']->getPrix();
        $concepteur = $donnees['jeu']->getConcepteur();
        if($donnees['jeu']->getLocation()){
            $location = "checked";
            $vendre = "";
        }
        else
        {
            $location = "";
            $vendre = "checked"; 
        } 
        $plateforme_id = $donnees['jeu']->getPlateformeId();
        $description = $donnees['jeu']->getDescription();

    }
    else
    {
        $titre = $prix = $concepteur = $location = $vendre = $plateforme_id = $description = "";
    }

    //var_dump($donnees['categoriesJeu']);
    for ($i = 0; $i < count($donnees['categories']); $i++)
    {
        $categorie[$i] = "";
        if (isset($donnees['categoriesJeu']))
        {
            for ($j = 0; $j < count($donnees['categoriesJeu']); $j++) {
                if ($donnees['categories'][$i]->getCategorieId() == $donnees['categoriesJeu'][$j]->getCategorieId()) {
                    $categorie[$i] = " checked";
                }
            }
            //var_dump($donnees['categoriesJeu'][$donnees['categoriesJeu'][$i]->getCategorieId()]);
        }
    }
    // var_dump($donnees['jeu']);
?>
    <div class="container">
        <div class="d-flex-row justify-content-between">
            <div class="d-flex justify-content-center">
                <h1 class="my-3 jeu-titre"><?=isset($donnees['jeu']) ? 'Modifier un jeu' : 'Ajouter un jeu'?></h1>
            </div>
            <form action="index.php?Jeux&action=enregistrerJeux" method="POST">
                <input type="hidden" name="jeux_id" id="jeux_id" value="<?= (isset($donnees['jeu']) ? $donnees['jeu']->getJeuxId() : 0) ?>">
                <input type="hidden" name="membre_id" id="membre_id" value="<?=$_SESSION['id']?>">
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label for="pwd">Titre :</label>
                        <input type="text" class="form-control" id="titre" name="titre" value="<?=$titre?>"> 
                    </div>
                    
                    <div class="col-lg-4">
                        <label for="pwd">Prix :</label>
                        <input type="text" class="form-control" id="prix" name="prix" value="<?=$prix?>">
                    </div>
                    
                    <div class="col-lg-4">
                        <label for="pwd">Concepteur :</label>
                        <input type="text" class="form-control" id="concepteur" name="concepteur" value="<?=$concepteur?>">
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <fieldset class="col-lg-4">
                        <legend>Vous voulez mettre votre jeu à :</legend>
                        <div>
                            <input type="radio" id="louer" name="location" value="1" <?= $location ?>/>
                            <label for="louer">Louer </label>
                        </div>
                        <div>
                            <input type="radio" id="vendre" name="location" value="0" <?= $vendre ?>/>
                            <label for="vendre">Vendre</label>
                        </div>
                    </fieldset>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label>Type de plateforme</label>
                        <select class="form-control" name="plateforme_id">
                            <?php
                            for($i = 0; $i < count($donnees['plateforme']); $i++)
                            {
                                echo "<option value='". $donnees['plateforme'][$i]->getPlateformeId() . "' " . ($donnees['plateforme'][$i]->getPlateformeId() == $plateforme_id ? 'selected' : '') . ">" . $donnees['plateforme'][$i]->getPlateforme() . "</option>";
                            }
                            ?>
                        </select>
                    </div>  
                </div>
                <hr>
                <div class="form-group row">
                    <label class="ml-3">Categories :</label>
                    <div class="d-flex flex-wrap justify-content-between">   
                        <?php
                            for($i = 0; $i < count($donnees['categories']); $i++)
                            {
                                echo "<div class='col-lg-3'>";
                                    echo "<input type='checkbox' name='categorie[]' value='" . $donnees['categories'][$i]->getCategorieId() . "'" . $categorie[$i] . ">";
                                    echo "<label class='ml-2'>" . $donnees['categories'][$i]->getCategorie() . "</label><br>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label>Description :</label>
                        <textarea name="description" rows="8" cols="60"><?=$description?></textarea>
                    </div> 
                </div>
                <hr>
                <!-- <pre>
                <?php //var_dump($donnees['images']); ?>
                </pre> -->
                <div id="groupeImages"class="form-group row">
                    <div id="imageBox1" class="col-md-3">
                        <label class="text-center">Image 1</label><br>
                        <div id="image1">
                            <?php
                                if(isset($donnees['images'][0])) {
                                    echo "<input type='text' id='inputImage1' name='cheminsImages[]' value='" .  $donnees['images'][0]->getCheminPhoto() . "' hidden />";
                                    echo "<img src='" . $donnees['images'][0]->getCheminPhoto() . "' class='img-fluid'>";
                                }
                                else {
                                    echo "<input type='text' id='inputImage1' name='cheminsImages[]' hidden />";
                                }
                            ?>
                        </div>
                        <div class='d-flex flex-wrap justify-content-center'>
                            <input type="file" id="upload1" class="ml-5" onchange="upload(this, 1)"/>
                            <button type='button' class='btn btn-outline-danger btn-sm mt-2 invisible' onclick="deleteImage(1)">Effacer</button>
                        </div>
                    </div> 
                    <div id="imageBox2" class="col-md-3 <?= isset($donnees['images'][0]) ? '' : 'invisible' ?>">
                        <label class="text-center">Image 2</label><br>
                        <div id="image2">
                            <?php
                                if(isset($donnees['images'][1])) {
                                    echo "<input type='text' id='inputImage2' name='cheminsImages[]' value='" .  $donnees['images'][1]->getCheminPhoto() . "' hidden />";
                                    echo "<img src='" . $donnees['images'][1]->getCheminPhoto() . "' class='img-fluid'>";
                                }
                                else {
                                    echo "<input type='text' id='inputImage2' name='cheminsImages[]' hidden />";
                                }
                            ?>
                        </div>
                        <div class='d-flex flex-wrap justify-content-center'>
                            <input type="file" id="upload2" class="ml-5" onchange="upload(this, 2)">
                            <button type='button' class='btn btn-outline-danger btn-sm mt-2 invisible' onclick="deleteImage(2)">Effacer</button>
                        </div>
                    </div>
                    <div id="imageBox3" class="col-md-3 <?= isset($donnees['images'][1]) ? '' : 'invisible' ?>">
                        <label class="text-center">Image 3</label><br>
                        <div id="image3">
                            <?php
                                if(isset($donnees['images'][2])) {
                                    echo "<input type='text' id='inputImage3'name='cheminsImages[]' value='" .  $donnees['images'][2]->getCheminPhoto() . "' hidden />";
                                    echo "<img src='" . $donnees['images'][2]->getCheminPhoto() . "' class='img-fluid'>";
                                }
                                else {
                                    echo "<input type='text' id='inputImage3' name='cheminsImages[]' hidden />";
                                }                        
                            ?>
                        </div>
                        <div class='d-flex flex-wrap justify-content-center'>
                            <input type="file" id="upload3" class="ml-5" onchange="upload(this, 3)">
                            <button type='button' class='btn btn-outline-danger btn-sm mt-2 invisible' onclick="deleteImage(3)">Effacer</button>
                        </div>
                    </div>
                    <div id="imageBox4" class="col-md-3 <?= isset($donnees['images'][2]) ? '' : 'invisible' ?>">
                        <label class="text-center">Image 4</label><br>
                        <div id="image4">
                            <?php
                                if(isset($donnees['images'][3])) {
                                    echo "<input type='text' id='inputImage4' name='cheminsImages[]' value='" .  $donnees['images'][3]->getCheminPhoto() . "' hidden />";
                                    echo "<img src='" . $donnees['images'][3]->getCheminPhoto() . "' class='img-fluid'>";
                                }
                                else {
                                    echo "<input type='text' id='inputImage4' name='cheminsImages[]' hidden />";
                                }
                            ?>
                        </div>
                        <div class='d-flex flex-wrap justify-content-center'>
                            <input type="file" id="upload4" class="ml-5" onchange="upload(this, 4)">
                            <button type='button' class='btn btn-outline-danger btn-sm mt-2 invisible' onclick="deleteImage(4)">Effacer</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-around my-5">
                    <a href="index.php?Jeux&action=derniers"><button type="button" class="btn-lg btn-outline-dark">Annuler</button></a>
                    <input type="submit" class="btn btn-lg btn-outline-success" value="Sauvegarder">
                </div>
                          
            </form>
        </div>
    </div>
<?php
}
else{
    echo "Vous n'avez pas la permission d'acceder à cette page";
}
?>
<script>
    function upload(input, id){
        // console.log(input.files[0].name);
        // console.log(input.id[0]);
        // for(i=0;i<20;i++){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            /* reader.onload = function (e) {
                $('#photo'+input.id)
                    .attr('src', e.target.result);
            }; */
            formData = new FormData();
            formData.append('files[]', input.files[0]);  
            $.ajax({
                url: "index.php?Images&action=sauvegardeFichiersImages&Id=" + id ,
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                // async: false,
                dataType:"html",
                success: function(data) {
                    $('#image' + id).html(data);
                    $('#imageBox' + (id + 1)).removeClass("invisible");
                }
            });

        };

    }; 

    function deleteImage(id){
        var cheminImage = $('#inputImage' + id).val();
        console.log(cheminImage);
        if (cheminImage) {

            $.ajax({
                url: "index.php?Images&action=deleteFichierImage&Id=" + id ,
                method: "POST",
                data: {
                    idd: id,
                    path: cheminImage
                },
                dataType:"html",
                success: function(data) {
                    $('#image' + id).html(data);
                    $('#image' + (id + 1)).removeClass("invisible");
                }
            });

        };

    }; 


    var updateDelete = function() {
        var cheminsImages = $("[id^=inputImage]");
        var boutonsEffacer = $('.btn-outline-danger'); 
        for(var i = 0; i < cheminsImages.length; i++){
            //console.log(cheminsImages[i].value);
            if(cheminsImages[i].value != ""){
                $(boutonsEffacer[i]).removeClass("invisible")
                //console.log(boutonsEffacer[i]);
            }
        }
    };

    $('#groupeImages').ready(function(){
        updateDelete();
    });

    $('#groupeImages').mouseover(function(){
        updateDelete();
    });
    //console.log($("[id^=inputImage]"));
  
</script>
