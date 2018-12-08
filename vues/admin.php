<?php if (isset($_SESSION["type"]) && ($_SESSION["type"] == 3 || $_SESSION["type"] == 4)) { ?>
    <h1 class="text-center my-3">Adminstration</h1>
    <div class="container-fluid">
        <div class="row mt-2 mb-3 my-2">
            <div class="d-flex flex-column nav nav-pills col-xl-3 border rounded text-center my-1 p-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <h3 class="mt-1 mb-3">Navigation</h3>
                <a class="nav-link mb-1 active" id="membres-tab" data-toggle="pill" href="#membres" role="tab" aria-controls="v-pills-membres" aria-selected="true">Gérer les membres</a>
                <a class="nav-link my-1" id="jeux-tab" data-toggle="pill" href="#jeux" role="tab" aria-controls="v-pills-jeux" aria-selected="false">Gérer les jeux</a>
                <a class="nav-link my-1" id="transactions-tab" data-toggle="pill" href="#transactions" role="tab" aria-controls="v-pills-transactions" aria-selected="false">Gérer les transactions</a>
                <a class="nav-link my-1" id="evaluations-tab" data-toggle="pill" href="#evaluations" role="tab" aria-controls="v-pills-evaluations" aria-selected="false">Gérer les évaluations et commentaires</a>
                <a class="nav-link my-1" id="menus-tab" data-toggle="pill" href="#menus" role="tab" aria-controls="v-pills-menus" aria-selected="false">Gérer les menus</a>
            </div>
            <div class="col-xl-9 tab-content my-1" id="tabContent">
                <!-- Onglet pour gérer les membres-->
                <div class="tab-pane fade show active table-responsive border rounded p-2" id="membres" role="tabpanel" aria-labelledby="v-pills-membres-tab">
                </div>
                <!-- Onglet pour gérer les jeux-->
                <div class="tab-pane fade table-responsive border rounded p-2" id="jeux" role="tabpanel" aria-labelledby="v-pills-jeux-tab">
                </div>
                <!-- Onglets pour gérer les transactions-->
                <div class="tab-pane fade" id="transactions" role="tabpanel" aria-labelledby="v-pills-transactions-tab">
                    <nav>
                        <div id="nav-transactions-tab" class="nav nav-tabs row mx-0" role="tablist">
                            <a class="nav-item nav-link col-6 active" id="nav-locations-tab" data-toggle="tab" href="#locations-tab" role="tab" aria-controls="nav-locations-tab" aria-selected="true"><h3>Locations</h3></a>
                            <a class="nav-item nav-link col-6" id="nav-achats-tab" data-toggle="tab" href="#achats-tab" role="tab" aria-controls="nav-achats-tab" aria-selected="false"><h3>Achats</h3></a>
                        </div>
                    </nav>
                    <div id="nav-transactions-tabContent" class="tab-content border border-top-0 rounded-bottom p-2">
                        <!--Tableau de location-->
                        <section id="locations-tab" class="tab-pane fade show active" role="tabpanel" aria-labelledby="nav-locations-tab">
                        </section>
                        <!--Tableau d`achat-->
                        <section id="achats-tab" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-achats-tab">
                        </section>
                    </div>
                </div>
                <!-- Onglet pour gérer les évaluations -->
                <div class="tab-pane fade table-responsive border rounded p-2" id="evaluations" role="tabpanel" aria-labelledby="v-pills-evaluations-tab">
                </div>
                <!-- Onglets pour gérer les menus -->
                <div class="tab-pane fade" id="menus" role="tabpanel" aria-labelledby="v-pills-menus-tab">
                    <nav>
                        <div id="nav-menus-tab" class="nav nav-tabs row mx-0" role="tablist">
                            <a class="nav-item nav-link col-6 active" id="nav-categories-tab" data-toggle="tab" href="#categories-tab" role="tab" aria-controls="categories-tab" aria-selected="true"><h3>Catégories</h3></a>
                            <a class="nav-item nav-link col-6" id="nav-plateformes-tab" data-toggle="tab" href="#plateformes-tab" role="tab" aria-controls="plateformes-tab" aria-selected="false"><h3>Plateformes</h3></a>
                        </div>
                    </nav>
                    <div id="nav-menus-tabContent" class="tab-content border border-top-0 rounded-bottom p-2">
                        <!-- Catégories -->
                        <section id="categories-tab" class="tab-pane fade show active" role="tabpanel" aria-labelledby="nav-categories-tab">
                        </section>
                        <!-- Plateformes -->
                        <section id="plateformes-tab" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-plateformes-tab">
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } else { ?>
    <h3 class='text-center my-5'>Vous n'avez pas les permissions pour acceder à cette page!!!</h3>
<?php } ?>

<script type="text/javascript">

    $(document).ready(function() {
        afficherAdminMembres();
    });

    $("#membres-tab").click(function() {
        afficherAdminMembres();
    });

    $("#jeux-tab").click(function() {
        afficherAdminJeux();
    });

    $("#transactions-tab").click(function() {
        afficherAdminLocations();
    });

    $("#nav-locations-tab").click(function() {
        afficherAdminLocations();
    });

    $("#nav-achats-tab").click(function() {
        afficherAdminAchats();
    });

    $("#menus-tab").click(function() {
        afficherAdminMenuCategories();
    });

    $("#nav-categories-tab").click(function() {
        afficherAdminMenuCategories();
    });

    $("#nav-plateformes-tab").click(function() {
        afficherAdminMenuPlateformes();
    });

    $("#evaluations-tab").click(function() {
        afficherAdminEvaluations();
    });


    var page = <?= isset($donnees["page"]) ? $donnees["page"] . ";" : "1;" ?>

    // Fonctions Ajax pour admin des membres

    function afficherAdminMembres() {
        $.ajax({
            url: 'index.php?Admin', 
            type: "POST",
            data: { 
                action: "afficherMembres",
                page: 1,
                itemsParPage: $("#membres .itemsParPage").val(),
                tri: $("#membres .tri").val(),
                ordre: $("#membres .ordre").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#membres").empty();
                $("#membres").html(donnees);
            }
        });
    }

    function updateMembre(id, action, type) {
        $.ajax({
            url: 'index.php?Admin', 
            type: "POST",
            data: { 
                action: action,
                membre_id: id,
                type: type,
                page: page,
                itemsParPage: $("#membres .itemsParPage").val(),
                tri: $("#membres .tri").val(),
                ordre: $("#membres .ordre").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#membres").empty();
                $("#membres").html(donnees);
            }
        });
    }

    function modifierMembre(id) {
        $.ajax({
            url: 'index.php?Admin',
            type: "POST",
            data: { 
                action: 'formAdminModifierMembre',
                membre_id: id,
                page: page,
                itemsParPage: $("#membres .itemsParPage").val(),
                tri: $("#membres .tri").val(),
                ordre: $("#membres .ordre").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#membres").empty();
                $("#membres").html(donnees);
            }
        });
    }

    function sauvegarderMembre() {
        $.ajax({
            url: "index.php?Admin",
            method: "POST",
            data: { 
                action: "adminEnregistrerMembre",
                membre_id: $("#membreId").val(),
                courriel: $("#email").val(),
                mot_de_passe: $("#pwd").val(),
                confirm_mdp: $("#confimerMotDePasse").val(),
                nom: $("#nom").val(),
                prenom: $("#prenom").val(),
                adresse: $("#adresse").val(),
                telephone: $("#telephone").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#membres").empty();
                $("#membres").html(donnees);
            }
        });
    }

    // Fonctions Ajax pour admin des jeux

    function afficherAdminJeux() {
        $.ajax({
            url: "index.php?Admin", 
            type: "POST",
            data: { 
                action: "afficherJeux",
                page: 1,
                itemsParPage: $("#jeux .itemsParPage").val(),
                tri: $("#jeux .tri").val(),
                ordre: $("#jeux .ordre").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#jeux").empty();
                $("#jeux").html(donnees);
            }
        });
    }

    function updateJeu(id, action) {
        $.ajax({
            url: "index.php?Admin", 
            type: "POST",
            data: { 
                action: action,
                jeux_id: id,
                page: page,
                itemsParPage: $("#jeux .itemsParPage").val(),
                tri: $("#jeux .tri").val(),
                ordre: $("#jeux .ordre").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#jeux").empty();
                $("#jeux").html(donnees);
            }
        });
    }

    function modifierJeu(id) {
        $.ajax({
            url: 'index.php?Admin',
            type: "POST",
            data: { 
                action: 'formAdminModifierJeu',
                JeuxId: id,
                page: page,
                itemsParPage: $("#jeux .itemsParPage").val(),
                tri: $("#jeux .tri").val(),
                ordre: $("#jeux .ordre").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#jeux").empty();
                $("#jeux").html(donnees);
            }
        });
    }

    function sauvegarderJeu() {
        var inputCategories = $("#categories input");
        var categories = [];
        var cnt = 0
        for (var i = 0; i < inputCategories.length; i++) {
            if (inputCategories[i].checked) {
                categories[cnt] = inputCategories[i].value;
                cnt++;
            }
        }
        var cheminsImages = [];
        var inputImages = $("[id^=inputImage]");
        var cnt = 0
        for (var i = 0; i < inputImages.length; i++) {
            if (inputImages[i].value != "") {
                cheminsImages[cnt] = inputImages[i].value;
                cnt++;
            }
        }
        $.ajax({
            url: "index.php?Admin",
            method: "POST",
            data: { 
                action: "adminEnregistrerJeu",
                jeux_id: $("#jeux_id").val(),
                titre: $("#titre").val(),
                prix: $("#prix").val(),
                concepteur: $("#concepteur").val(),
                location: $("input:radio[name='location']:checked").val(),
                plateforme_id: $("#plateforme_id").val(),
                categorie: categories,
                description: $("#description").val(),
                cheminsImages: cheminsImages,
            },
            dataType: "html",
            success: function(donnees) {
                $("#jeux").empty();
                $("#jeux").html(donnees);
            }
        });
    }

    // Fonctions Ajax pour admin des locations

    function afficherAdminLocations() {
        $.ajax({
            url: "index.php?Admin", 
            type: "POST",
            data: { 
                action: "afficherLocations",
                page: 1,
                itemsParPage: $("#locations-tab .itemsParPage").val(),
                tri: $("#locations-tab .tri").val(),
                ordre: $("#locations-tab .ordre").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#locations-tab").empty();
                $("#locations-tab").html(donnees);
            }
        });
    }

    function updateLocation(id, action) {
        $.ajax({
            url: "index.php?Admin", 
            type: "POST",
            data: { 
                action: action,
                location_id: id,
                page: page,
                itemsParPage: $("#locations-tab .itemsParPage").val(),
                tri: $("#locations-tab .tri").val(),
                ordre: $("#locations-tab .ordre").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#locations-tab").empty();
                $("#locations-tab").html(donnees);
            }
        });
    }

    // Fonctions Ajax pour admin des achats

    function afficherAdminAchats() {
        $.ajax({
            url: "index.php?Admin", 
            type: "POST",
            data: { 
                action: "afficherAchats",
                page: 1,
                itemsParPage: $("#achats-tab .itemsParPage").val(),
                tri: $("#achats-tab .tri").val(),
                ordre: $("#achats-tab .ordre").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#achats-tab").empty();
                $("#achats-tab").html(donnees);
            }
        });
    }

    function updateAchat(id, action) {
        $.ajax({
            url: "index.php?Admin", 
            type: "POST",
            data: { 
                action: action,
                achat_id: id,
                page: page,
                itemsParPage: $("#achats-tab .itemsParPage").val(),
                tri: $("#achats-tab .tri").val(),
                ordre: $("#achats-tab .ordre").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#achats-tab").empty();
                $("#achats-tab").html(donnees);
            }
        });
    }

    // Fonctions Ajax pour admin du menu Catégories

    function afficherAdminMenuCategories() {
        $.ajax({
            url: "index.php?Admin", 
            type: "POST",
            data: { 
                action: "afficherMenuCategories",
                page: 1,
                itemsParPage: $("#categories-tab .itemsParPage").val(),
                tri: $("#categories-tab .tri").val(),
                ordre: $("#categories-tab .ordre").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#categories-tab").empty();
                $("#categories-tab").html(donnees);
            }
        });
    }

    function updateCategorie(id, action) {
        $.ajax({
            url: "index.php?Admin", 
            type: "POST",
            data: { 
                action: action,
                categorie_id: id,
                page: page,
                itemsParPage: $("#categories-tab .itemsParPage").val(),
                tri: $("#categories-tab .tri").val(),
                ordre: $("#categories-tab .ordre").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#categories-tab").empty();
                $("#categories-tab").html(donnees);
            }
        });
    }

    function modifierCategorie(id, categorie) {
        $("#categories-tab h5 span").html("Modifier une plateforme");
        $("#categories-tab label").html("Modifier plateforme");
        $("#categories-tab input[type='number']").val(id);
        $("#categories-tab input:text").val(categorie);
    }

    function nouvelleCategorie() {
        $("#categories-tab h5 span").html("Ajouter une plateforme");
        $("#categories-tab label").html("Nouvelle plateforme");
        $("#categories-tab input[type='number']").val(0);
        $("#categories-tab input:text").val("");
    }

    function sauvegarderCategorie() {
        $('#categoriesModal').modal('hide');
        $(document.body).removeClass("modal-open");
        $(".modal-backdrop").remove();
        $.ajax({
            url: "index.php?Admin", 
            type: "POST",
            data: { 
                action: "sauvegarderCategorie",
                categorie_id: $("#categories-tab input[type='number']").val(),
                categorie: $("#categories-tab input:text").val(),
                page: page,
                itemsParPage: $("#categories-tab .itemsParPage").val(),
                tri: $("#categories-tab .tri").val(),
                ordre: $("#categories-tab .ordre").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#categories-tab").empty();
                $("#categories-tab").html(donnees);
            }
        });
    }

    // Fonctions Ajax pour admin du menu Plateformes

    function afficherAdminMenuPlateformes() {
        $.ajax({
            url: "index.php?Admin", 
            type: "POST",
            data: { 
                action: "afficherMenuPlateformes",
                page: 1,
                itemsParPage: $("#plateformes-tab .itemsParPage").val(),
                tri: $("#plateformes-tab .tri").val(),
                ordre: $("#plateformes-tab .ordre").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#plateformes-tab").empty();
                $("#plateformes-tab").html(donnees);
            }
        });
    }

    function updatePlateforme(id, action) {
        $.ajax({
            url: "index.php?Admin", 
            type: "POST",
            data: { 
                action: action,
                plateforme_id: id,
                page: page,
                itemsParPage: $("#plateformes-tab .itemsParPage").val(),
                tri: $("#plateformes-tab .tri").val(),
                ordre: $("#plateformes-tab .ordre").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#plateformes-tab").empty();
                $("#plateformes-tab").html(donnees);
            }
        });
    }

    function modifierPlateforme(id, plateforme, icone) {
        $("#plateformes-tab h5 span").html("Modifier une plateforme");
        $("#plateformes-tab input[type='number']").val(id);
        $("#plateformes-tab input[name='plateforme']").val(plateforme);
        $("#plateformes-tab input[name='plateforme_icone']").val(icone);
    }

    function nouvellePlateforme() {
        $("#plateformes-tab h5 span").html("Ajouter une plateforme");
        $("#plateformes-tab input[type='number']").val(0);
        $("#plateformes-tab input[name='plateforme']").val("");
        $("#plateformes-tab input[name='plateforme_icone']").val("");
    }

    function sauvegarderPlateforme() {
        $("#plateformesModal").modal("hide")
        $(document.body).removeClass("modal-open");
        $(".modal-backdrop").remove();
        $.ajax({
            url: "index.php?Admin", 
            type: "POST",
            data: { 
                action: "sauvegarderPlateforme",
                plateforme_id: $("#plateformes-tab input[type='number']").val(),
                plateforme: $("#plateformes-tab input[name='plateforme']").val(),
                plateforme_icone: $("#plateformes-tab input[name='plateforme_icone']").val(),
                page: page,
                itemsParPage: $("#plateformes-tab .itemsParPage").val(),
                tri: $("#plateformes-tab .tri").val(),
                ordre: $("#plateformes-tab .ordre").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#plateformes-tab").empty();
                $("#plateformes-tab").html(donnees);
            }
        });
    }

    // Fonctions Ajax pour admin des évaluations

    function afficherAdminEvaluations() {
        $.ajax({
            url: 'index.php?Admin', 
            type: "POST",
            data: { 
                action: "afficherEvaluations",
                page: 1,
                itemsParPage: $("#evaluations .itemsParPage").val(),
                tri: $("#evaluations .tri").val(),
                ordre: $("#evaluations .ordre").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#evaluations").empty();
                $("#evaluations").html(donnees);
            }
        });
    }

    function updateEvaluation(id, action, type) {
        $.ajax({
            url: 'index.php?Admin', 
            type: "POST",
            data: { 
                action: action,
                evaluation_id: id,
                type: type,
                page: page,
                itemsParPage: $("#evaluations .itemsParPage").val(),
                tri: $("#evaluations .tri").val(),
                ordre: $("#evaluations .ordre").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#evaluations").empty();
                $("#evaluations").html(donnees);
            }
        });
    }

    function modifierEvaluation(jeton) {
        $.ajax({
            url: 'index.php?Admin',
            type: "POST",
            data: { 
                action: 'formAdminModifierEvaluation',
                jeton: jeton,
                page: page,
                itemsParPage: $("#evaluations .itemsParPage").val(),
                tri: $("#evaluations .tri").val(),
                ordre: $("#evaluations .ordre").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#evaluations").empty();
                $("#evaluations").html(donnees);
            }
        });
    }

    function sauvegarderEvaluation() {
        $.ajax({
            url: "index.php?Admin",
            method: "POST",
            data: { 
                action: "adminEnregistrerEvaluation",
                jeton: $("#jeton").val(),
                evaluationJeu: $("input:radio[name='evaluationJeu']:checked").val(),
                commentaireJeu: $("#commentaireJeu").val(),
                evaluationMembre: $("input:radio[name='evaluationMembre']:checked").val(),
                commentaireMembre: $("#commentaireMembre").val(),
            },
            dataType: "html",
            success: function(donnees) {
                $("#evaluations").empty();
                $("#evaluations").html(donnees);
            }
        });
    }

</script>
