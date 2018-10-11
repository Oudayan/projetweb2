<?php?>
<div class="py-5 text-white bg-form">
    <div class="container">
        <div class="row">
            <div class="align-self-center p-5 col-md-6">
                <h1 class="mb-4"><?= isset($donnees['membre']) ? "Modifier mon profil" : "S'inscrire"?></h1>
                <?php
                    if(isset($donnees['membre'])){
                        $id = $donnees['membre']->getMembreId();
                        $courriel = $donnees['membre']->getCourriel();
                        $mdp = $donnees['membre']->getMotDePasse();
                        $nom = $donnees['membre']->getNom();
                        $prenom = $donnees['membre']->getPrenom();
                        $adresse = $donnees['membre']->getAdresse();
                        $telephone = $donnees['membre']->getTelephone();
                    }
                    else
                    {
                        $id = 0;
                        $courriel = $mdp = $nom = $prenom = $adresse = $telephone = "";
                    }
                ?>
                <form action="index.php?Membres&action=enregistrerMembre" method="POST" id="formMembre">
                    <input type="text" hidden name="membre_id" value="<?=$id?>">
                    <div class="form-group">
                        <label for="email">Courriel :</label><span id="mailErreur" class="ml-2"></span>
                        <input type="email" class="form-control" id="email" name="courriel" value="<?=$courriel?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mot de passe :</label><span id="mdpErreur" class="ml-2"></span>
                        <input type="password" class="form-control" id="pwd" name="mot_de_passe" value="<?=$mdp?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="confimerMotDePasse">Confirmer mot de passe:</label><span id="cmdpErreur" class="ml-2"></span>
                        <input type="password" class="form-control" id="confimerMotDePasse" name="confirm_mdp" value="<?=$mdp?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom:</label><span id="nomErreur" class="ml-2"></span>
                        <input type="text" class="form-control" id="nom" name="nom" value="<?=$nom?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom:</label><span id="prenomErreur" class="ml-2"></span>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="<?=$prenom?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse:</label><span id="adresseErreur" class="ml-2"></span>
                        <input type="text" class="form-control" id="adresse" name="adresse" value="<?=$adresse?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="telephone">Téléphone:</label><small class="ml-2">xxx-xxx-xxxxx</small><span id="phoneErreur" class="ml-2"></span>
                        <input type="text" class="form-control" id="telephone" name="telephone" value="<?=$telephone?>" placeholder=""> 
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg" id="btnValidation" disabled><?= isset($donnees['membre']) ? "Modifier" : "S'inscrire"?></button>
                </form>
            </div>
            <div class="col-md-6 p-0 carousel-membre">
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
                            echo '<a href="index.php?Jeux&action=afficherJeu&JeuxId=' . $donnees['trois'][$i]->getJeuxId() . '"><img class="d-block w-100" src="' . $donnees['imagesTrois'][$i]->getCheminPhoto() . '" alt="' . $donnees["trois"][$i]->getTitre() . '"></a>';
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

<script>
    var courriel = $('#email').val();
    var mdp = $('#pwd').val();
    var cmdp = $('#confimerMotDePasse').val();
    var nom = $('#nom').val();
    var prenom = $('#prenom').val();
    var adresse = $('#adresse').val();
    var telephone = $('#telephone').val();

    var courrieChk = false; 
    var mdpChk = false;
    var cmdpChk = false;
    var nomChk = false;
    var prenomChk = false;
    var adresseChk = false;
    var telephoneChk = false;
    

    $('#email').keyup(function(){
        
        var courriel = $('#email').val();
        var courrielReg = /^[a-z-0-9_+.-]+\@([a-z0-9-]+\.)+[a-z0-9]{2,7}$/i;
        if( courriel == ""){
            courrieChk = false;
            $('#email').attr("placeholder", "Entrez votre courriel");
        }
        else if( !courrielReg.test(courriel)){
            courrieChk = false;
            $('#mailErreur').text("Insérer une vraie adresse courriel");
            $('#mailErreur').css('color', 'red');
        }
        else{
            $('#mailErreur').text("");
            courrieChk = true; 
        }
        
    });

    $('#pwd').keyup(function(){
        
        var mdp = $('#pwd').val();
        var pwdReg = /.+/g;
        if( mdp == ""){
            mdpChk = false;
            $('#pwd').attr("placeholder", "Entrez votre mot de passe");
        }
        else if( !pwdReg.test(mdp)){
            mdpChk = false;
            $('#mdpErreur').text("Insérer une mot de passe");
            $('#mdpErreur').css('color', 'red');
        }
        else{
            $('#mdpErreur').text("");
            mdpChk = true; 
        }
    });

    $('#confimerMotDePasse').keyup(function(){
        
        var mdp = $('#pwd').val();
        var cmdp = $('#confimerMotDePasse').val();
        var pwdReg = /.+/g;
        if( cmdp == ""){
            cmdpChk = false;
            $('#confimerMotDePasse').attr("placeholder", "Entrez votre mot de passe");
        }
        else if( cmdp != mdp){
            cmdpChk = false;
            $('#cmdpErreur').text("Les mots de passes ne sont pas égaux");
            $('#cmdpErreur').css('color', 'red');
        }
        else{
            $('#cmdpErreur').text("");
            cmdpChk = true; 
        }
    });

    $('#nom').keyup(function(){
        
        var nom = $('#nom').val();
        var nameReg = /^([a-zA-Z'àáâéèêíôóúùüûçÀÁÂÉÈÍÓÔÙÚÛÜÇ\s-]{1,30})$/g;
        if( nom == ""){
            nomChk = false;
            $('#nom').attr("placeholder", "Entrez votre nom");
        }
        else if( !nameReg.test(nom)){
            nomChk = false;
            $('#nomErreur').text("Insérez un vrai nom");
            $('#nomErreur').css('color', 'red');
        }
        else{
            $('#nomErreur').text("");
            nomChk = true; 
        }
    });

    $('#prenom').keyup(function(){
        
        var prenom = $('#prenom').val();
        var nameReg = /^([a-zA-Z'àáâéèêíôóúùüûçÀÁÂÉÈÍÓÔÙÚÛÜÇ\s-]{1,30})$/g;
        if( prenom == ""){
            prenomChk = false;
            $('#prenom').attr("placeholder", "Entrez votre prénom");
        }
        else if( !nameReg.test(prenom)){
            prenomChk = false;
            $('#prenomErreur').text("Insérez un vrai prénom");
            $('#prenomErreur').css('color', 'red');
        }
        else{
            $('#prenomErreur').text("");
            prenomChk = true; 
        }
    });

    $('#adresse').keyup(function(){
        
        var adresse = $('#adresse').val();
        var adresseReg = /^[a-zA-Z0-9\s,\.'-]*$/g;
        if( adresse == ""){
            adresseChk = false;
            $('#adresse').attr("placeholder", "Entrez votre adresse");
        }
        else if( !adresseReg.test(adresse)){
            adresseChk = false;
            $('#adresseErreur').text("Insérez une vraie adresse");
            $('#adresseErreur').css('color', 'red');
        }
        else{
            $('#adresseErreur').text("");
            adresseChk = true; 
        }
    });

    $('#telephone').keyup(function(){
        
        var telephone = $('#telephone').val();
        var telephoneReg = /^\(?([0-9]{3})\)?[-.]([0-9]{3})[-.]([0-9]{4})$/;
        if( telephone == ""){
            telephoneChk = false;
            $('#telephone').attr("placeholder", "Entrez votre téléphone");
        }
        else if( !telephoneReg.test(telephone)){
            telephoneChk = false;
            $('#phoneErreur').text("Insérez un vrai numéro de téléphone");
            $('#phoneErreur').css('color', 'red');
        }
        else{
            $('#phoneErreur').text("");
            telephoneChk = true; 
        }
    });

    $('body').on('mousemove',function(){
        if (courrieChk = true && mdpChk == true && cmdpChk == true && nomChk == true && prenomChk == true && adresseChk == true && telephoneChk == true){
            $('#btnValidation').prop('disabled', false);
            }else{
            $('#btnValidation').prop('disabled', true);
        }
    });
</script>