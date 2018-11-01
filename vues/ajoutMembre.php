            <div class="py-5 text-white bg-form">
                <div class="container">
                    <?php if (isset($donnees['admin'])) { ?>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn close" onclick="getPage(<?= $_SESSION['params']['page'] . ', ' . $_SESSION['params']['itemsParPage'] . ', \'' . $_SESSION['params']['tri'] . '\', ' . $_SESSION['params']['ordre']?>)"><h2>&times;</h2></button>
                    </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-lg-6 align-self-center px-5">
                            <h2 class="mb-4"><?= isset($donnees['membre']) ? "Modifier mon profil" : "S'inscrire"?></h2>
                            <?php if (isset($donnees['membre'])) {
                                $id = $donnees['membre']->getMembreId();
                                $courriel = $donnees['membre']->getCourriel();
                                $mdp = "_0987654321Aa";
                                $nom = $donnees['membre']->getNom();
                                $prenom = $donnees['membre']->getPrenom();
                                $adresse = $donnees['membre']->getAdresse();
                                $telephone = $donnees['membre']->getTelephone();
                            }
                            else {
                                $id = 0;
                                $courriel = $mdp = $nom = $prenom = $adresse = $telephone = "";
                            } ?>
                            <form action="index.php?Membres&action=enregistrerMembre" method="POST" id="formMembre">
                                <input type="text" hidden name="membre_id" id="membreId" value="<?=$id?>">
                                <div class="form-group">
                                    <label for="email">Courriel :</label><span id="mailErreur" class="ml-2"></span>
                                    <input type="email" class="form-control" id="email" name="courriel" value="<?=$courriel?>" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Mot de passe :</label><span id="mdpErreur" class="ml-2"></span>
                                    <input type="password" class="form-control password" id="pwd" name="mot_de_passe" value="<?=$mdp?>" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="confimerMotDePasse">Confirmer mot de passe:</label><span id="cmdpErreur" class="ml-2"></span>
                                    <input type="password" class="form-control password" id="confimerMotDePasse" name="confirm_mdp" value="<?=$mdp?>" placeholder="">
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
                                    <label for="telephone">Téléphone:</label><small class="ml-2">xxx-xxx-xxxx</small><span id="phoneErreur" class="ml-2"></span>
                                    <input type="text" class="form-control" id="telephone" name="telephone" value="<?=$telephone?>" placeholder=""> 
                                </div>
                                <div id="btnDiv" class="d-flex justify-content-start">
                                <?php if (!isset($donnees["admin"])) { ?> 
                                    <button type="submit" class="btn btn-success btn-lg mt-4" id="btnValidation" disabled><?= isset($donnees['membre']) ? "Modifier" : "S'inscrire"?></button>
                                <?php } ?>
                                </div>
                            </form>
                            <?php if (isset($donnees["admin"])) {
                                if (isset($_SESSION['params'])) { ?>
                                <button class="btn btn-secondary btn-lg mt-4" onclick="getPage(<?= $_SESSION['params']['page'] . ', ' . $_SESSION['params']['itemsParPage'] . ', \'' . $_SESSION['params']['tri'] . '\', ' . $_SESSION['params']['ordre']?>)">Annuler</button>
                                <?php } ?>
                                <button class="btn btn-success btn-lg mt-4" id="btnValidation" onclick="sauvegarderMembre()" disabled>Modifier</button>
                            <?php } ?>
                        </div>
                        <div class="col-lg-6 px-5 carousel-membre">
                            <div id="carouselTrois" class="carousel slide" data-ride="carousel" data-interval="3000">
                                <?php if (count($donnees['imagesTrois']) > 1) { ?>
                                    <ol class="carousel-indicators">
                                    <?php for ($i = 0; $i < count($donnees['imagesTrois']); $i++) {
                                        if ($i == 0) { ?>
                                            <li data-target='#carouselTrois' data-slide-to='<?= $i ?>' class='active'></li>
                                        <?php } else { ?>
                                            <li data-target='#carouselTrois' data-slide-to='<?= $i ?>'></li>
                                        <?php }
                                    } ?>
                                    </ol>
                                <?php } ?>
                                <div class="carousel-inner">
                                <?php for ($i = 0; $i < count($donnees['imagesTrois']); $i++) {
                                    if ($i == 0) { ?>
                                        <div class="carousel-item active">
                                    <?php } else { ?>
                                        <div class="carousel-item">
                                    <?php } ?>
                                        <a href="index.php?Jeux&action=afficherJeu&JeuxId=<?= $donnees['trois'][$i]->getJeuxId() ?>"><img class="d-block w-100" src="<?= $donnees['imagesTrois'][$i]->getCheminPhoto() ?>" alt="<?= $donnees['trois'][$i]->getTitre() ?>"></a>
                                    </div>
                                <?php } ?>
                                </div>
                                <?php if (count($donnees['imagesTrois']) > 1) { ?>
                                    <a class="carousel-control-prev" href="#carouselTrois" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselTrois" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>

                var courrieChk = false; 
                var mdpChk = false;
                var cmdpChk = false;
                var nomChk = false;
                var prenomChk = false;
                var adresseChk = false;
                var telephoneChk = false;

                var input = document.getElementById("myInput");
                var text = document.getElementById("text");
                
                function chkEmail() {
                    var courriel = $('#email').val();
                    var courrielReg = /^[a-z-0-9_+.-]+\@([a-z0-9-]+\.)+[a-z0-9]{2,7}$/i;
                    if (courriel !="" && courrielReg.test(courriel) ) {
                        $('#mailErreur').text("");
                        courrieChk = true;
                    }
                    else if (courriel == "") {
                        courrieChk = false;
                        $('#email').attr("placeholder", "Entrez votre courriel");
                    }
                    else {
                        $('#mailErreur').text("Insérer une vraie adresse courriel");
                        $('#mailErreur').css('color', 'red');
                        courrieChk = false;
                    }
                }

                function chkPwd() {
                    var mdp = $('#pwd').val();
                    var pwdReg = /.+/g;
                    if (mdp != "" && pwdReg.test(mdp)) {
                        $('#mdpErreur').text("");
                        mdpChk = true; 
                    }
                    else if (mdp == "") {
                        mdpChk = false;
                        $('#pwd').attr("placeholder", "Entrez votre mot de passe");
                    }
                    else {
                        mdpChk = false;
                        $('#mdpErreur').text("Insérer une mot de passe");
                        $('#mdpErreur').css('color', 'red');
                    }
                }

                function chkCpwd() {
                    var mdp = $('#pwd').val();
                    var cmdp = $('#confimerMotDePasse').val();
                    var pwdReg = /.+/g;
                    if (cmdp != "" && cmdp == mdp) {
                        $('#cmdpErreur').text("");
                        cmdpChk = true; 
                    }
                    else if (cmdp == "") {
                        cmdpChk = false;
                        $('#confimerMotDePasse').attr("placeholder", "Entrez votre mot de passe");
                    }
                    else {
                        cmdpChk = false;
                        $('#cmdpErreur').text("Les mots de passes ne sont pas égaux");
                        $('#cmdpErreur').css('color', 'red');
                    }
                }

                function chkNom() {
                    var nom = $('#nom').val();
                    var nameReg = /^([A-Z'ÀÁÂÉÈÍÓÔÙÚÛÜÇ]{1}[a-z'àáâéèêíôóúùüûç\s-]{1,30})$/g;
                    if (nom !="" && nameReg.test(nom)) {
                        $('#nomErreur').text("");
                        nomChk = true; 
                    }
                    else if (nom == "") {
                        nomChk = false;
                        $('#nom').attr("placeholder", "Entrez votre nom");
                    }
                    else {
                        nomChk = false;
                        $('#nomErreur').text("Insérez un vrai nom");
                        $('#nomErreur').css('color', 'red');
                    }
                }

                function chkPrenom() {
                    var prenom = $('#prenom').val();
                    var nameReg = /^([A-Z'ÀÁÂÉÈÍÓÔÙÚÛÜÇ]{1}[a-z'àáâéèêíôóúùüûç\s-]{1,30})$/g;
                    if (prenom != "" && nameReg.test(prenom)) {
                        $('#prenomErreur').text("");
                        prenomChk = true; 
                    }
                    else if (prenom == "") {
                        prenomChk = false;
                        $('#prenom').attr("placeholder", "Entrez votre prénom");
                    }
                    else {
                        prenomChk = false;
                        $('#prenomErreur').text("Insérez un vrai prénom");
                        $('#prenomErreur').css('color', 'red');
                    }
                }

                function chkAdresse() {
                    var adresse = $('#adresse').val();
                    var adresseReg = /^[0-9\s,\.\#'-][a-zA-Z'áàâäéèêëíìîïóòöôúùüûÁÀÄÂÉÈËÊÍÌÏÎÓÒÖÔÚÙÛÜ[0-9\s,\.\#'-]*$/g
                    if (adresse !="" && adresseReg.test(adresse)) {
                        $('#adresseErreur').text("");
                        adresseChk = true;
                    }
                    else if (adresse == "") {
                        adresseChk = false;
                        $('#adresse').attr("placeholder", "Entrez votre adresse");
                    }
                    else {
                        adresseChk = false;
                        $('#adresseErreur').text("Insérez une vraie adresse");
                        $('#adresseErreur').css('color', 'red');
                    }
                }

                function chkPhone() {
                    var telephone = $('#telephone').val();
                    var telephoneReg = /^\(?([2-9][0-9]{2})\)?[-.]([2-9][0-9]{2})[-.]([0-9]{4})$/;
                    if (telephone !="" && telephoneReg.test(telephone)) {
                        $('#phoneErreur').text("");
                        telephoneChk = true; 
                    }
                    else if (telephone == "") {
                        telephoneChk = false;
                        $('#telephone').attr("placeholder", "Entrez votre téléphone");
                    }
                    else {
                        telephoneChk = false;
                        $('#phoneErreur').text("Insérez un vrai numéro de téléphone");
                        $('#phoneErreur').css('color', 'red');
                    }
                }

                function chkCaps(event, target) {
                    if (event.getModifierState("CapsLock")) {
                        $(target).hide;
                    }
                    else {
                        $(target).hide;
                    }
                }

                function checkFormMembre() {
                    chkEmail();
                    chkPwd();
                    chkCpwd();
                    chkNom();
                    chkPrenom();
                    chkAdresse();
                    chkPhone();
                    if (courrieChk == true && cmdpChk == true && nomChk == true && prenomChk == true && adresseChk == true && telephoneChk == true){
                        $('#btnValidation').prop('disabled', false);
                    }
                    else {
                        $('#btnValidation').prop('disabled', true);
                    }
                }

                $('#formMembre').on('mousemove', function() {
                    checkFormMembre();
                });

                $('#formMembre input').on('blur', function() {
                    checkFormMembre();
                });

                // $('input.password').keyup(function(e) {
                //     e.preventDefault();
                //     if (e.originalEvent.getModifierState("CapsLock")) {
                //         $('#mdpErreur').text("CAPS LOCK IS ON!!!");
                //     }
                //     else {
                //         $('#mdpErreur').text("");
                //     }
                // });

            </script>