<?php if (isset($_SESSION["id"])) { ?>
    <div class="container">
        <h1 class="text-center my-3">Messagerie</h1>
        <input type="hidden" id="membre_id" value="<?= isset($_SESSION["id"]) ? $_SESSION["id"] : ""?>"/>
        <div class="h3 mt-5 mb-5" style="display:flex;">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Messages</a>
                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Envoyés</a>
            </div>
            <div class="tab-content ml-3" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <ul class="list-message">
                    <?php if (isset($donnees["messagesRecu"])) {
                        $i=0;
                        foreach ($donnees["messagesRecu"] as $message) {
                            ?>
                            <li>
                                <a href="" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#modal-recu<?= $message->getMsgId(); ?>"> 
                                    <b><?= $message->getSujet() . " - " . date("Y-m-d", strtotime($message->getMsgDate())) ?></b>
                                    <br>De: <?= $donnees['expediteurs'][$i]->getPrenom() . " " . $donnees['expediteurs'][$i]->getNom() ?>
                                </a>
                            </li>
                            <div class="modal fade" id="modal-recu<?= $message->getMsgId(); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-recu<?= $message->getMsgId(); ?>Label" aria-hidden="true">
                                <input type="hidden" id="destinataire_id<?= $message->getMsgId(); ?>" value="<?= $message->getMembreId(); ?>"/>
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal-recu<?= $message->getMsgId(); ?>Label">Sujet: <?= $message->getSujet(); ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <span class="text-left">De: <?= $donnees['expediteurs'][$i]->getPrenom() . " " . $donnees['expediteurs'][$i]->getNom() ?></p></span>
                                            <span class="text-right">Reçu le: <?= date("Y-m-d", strtotime($message->getMsgDate())) ?></p></span>
                                            <p>Message:</p>
                                            <p><?= $message->getMessage(); ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="close1<?= $message->getMsgId(); ?>" class="btn btn-secondary hidden" data-dismiss="modal">Close</button>
                                            <button type="button" id="close2<?= $message->getMsgId(); ?>" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="buttonRepondre<?= $message->getMsgId(); ?>">Répondre</button>
                                        </div>
                                        <div id="fcontacto<?= $message->getMsgId(); ?>" class="contacter-annoceur mx-auto hidden">
                                            <div class="contacter-annoceur mx-auto">
                                                <div class="hidden">
                                                    <p>
                                                        <input name="sujet" id="sujet<?= $message->getMsgId(); ?>" type="text" size="22" value="Re: <?= $message->getSujet(); ?>" tabindex="1" />
                                                    </p>
                                                </div>
                                                <div>
                                                    <p>
                                                        <textarea name="message" id="message<?= $message->getMsgId(); ?>" cols="40" rows="4" tabindex="5" placeholder="votre message... (*)"></textarea>
                                                    </p>
                                                </div>
                                                <p>
                                                <div class="alert alert-danger hidden" role="alert">
                                                    (*) Champs requis
                                                </div>
                                                <button id="envoyer-contacter<?= $message->getMsgId(); ?>">Envoyer Message <i class="fa fa-paper-plane"></i></button>
                                                </p>
                                            </div>
                                        </div>
                                        <br />
                                        <script>
                                            $("#buttonRepondre<?= $message->getMsgId(); ?>").click(function () {
                                                $("#fcontacto<?= $message->getMsgId(); ?>").show();
                                            });
                                            $("#close1<?= $message->getMsgId(); ?>").click(function () {
                                                location.reload();
                                            });
                                            $(".close").click(function () {
                                                location.reload();
                                            });
                                            $("#envoyer-contacter<?= $message->getMsgId(); ?>").click(function () {
                                                if ($("#sujet<?= $message->getMsgId(); ?>").val() == "" || $("#message<?= $message->getMsgId(); ?>").val() == "") {
                                                    $(".alert").show();
                                                    $(".alert").alert();
                                                } else {
                                                    $(".alert").hide();
                                                    request = $.ajax({
                                                        url: "index.php?Messagerie&action=formAjoutMessage",
                                                        type: "post",
                                                        data: {
                                                            membre_id: $("#membre_id").val(),
                                                            destinataire_id: $("#destinataire_id<?= $message->getMsgId(); ?>").val(),
                                                            sujet: $("#sujet<?= $message->getMsgId(); ?>").val(),
                                                            message: $("#message<?= $message->getMsgId(); ?>").val()
                                                        }
                                                    });
                                                    request.done(function (response, textStatus, jqXHR) {
                                                        bootoast.toast({
                                                            message: 'message envoyé correctement!',
                                                            type: 'success',
                                                            position: 'top-center'
                                                        });
                                                        $("#close1<?= $message->getMsgId(); ?>").show();
                                                        $("#close2<?= $message->getMsgId(); ?>").hide();
                                                        $("#fcontacto<?= $message->getMsgId(); ?>").hide();
                                                    });
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; 
                        } 
                    } ?>
                    </ul>
                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <ul class="list-message">
                    <?php if (isset($donnees["messagesEnvoyes"])) {
                        foreach ($donnees["messagesEnvoyes"] as $message) {
                            ?>
                            <li>
                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal-envoye<?= $message->getMsgId(); ?>"> 
                                    <b><?= $_SESSION['nomComplet']; ?><br><?= $message->getMsgDate(); ?><br><?= $message->getSujet(); ?></b><br>
                                    <p><?= $message->getMessage(); ?></p>
                                </a>
                            </li>
                            <div class="modal fade" id="modal-envoye<?= $message->getMsgId(); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-envoye<?= $message->getMsgId(); ?>Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal-envoye<?= $message->getMsgId(); ?>Label"><?= $message->getSujet(); ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><?= $_SESSION['nomComplet']; ?></p>
                                            <p><?= $message->getMsgDate(); ?></p>
                                            <p> <?= $message->getMessage(); ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } ?>
                    </ul>
                </div> 
            </div> 
        </div>
    </div>
<?php } else { ?>
    <h2 class="text-center my-5 py-5">Vous devez vous connecter pour acceder à cette page</h2>
<?php } ?>