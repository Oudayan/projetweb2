
<?php
$messagesEnvoyes = $donnees["messagesEnvoyes"];
$messagesRecu = $donnees["messagesRecu"];
?>
<input type="hidden" id="membre_id" value="<?= isset($_SESSION["id"]) ? $_SESSION["id"] : ""?>"/>
<div class="container">
    <div class="h3 mt-5 mb-5" style="display:flex;">

        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Messages</a>
            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Envoyés</a>
        </div>
        <div class="tab-content ml-3" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <ul class="list-message">
                    <?php
                    $i=0;
                    foreach ($messagesRecu as $message) {
                        ?>
                        <li>
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?= $message->getMsg_Id(); ?>"> 
                                <b><?= $donnees['expediteurs'][$i]->getPrenom() . " " . $donnees['expediteurs'][$i]->getNom() ?> <?= $message->getMsg_Date(); ?>  <?= $message->getSujet(); ?></b><br/>
                                <p><?= $message->getMessage(); ?></p>
                            </a>
                        </li>
                        <div class="modal fade" id="exampleModal<?= $message->getMsg_Id(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <input type="hidden" id="destinataire_id<?= $message->getMsg_Id(); ?>" value="<?= $message->getMembre_Id(); ?>"/>
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $message->getSujet(); ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><?= $donnees['expediteurs'][$i]->getPrenom() . " " . $donnees['expediteurs'][$i]->getNom() ?></p>
                                        <p><?= $message->getMsg_Date(); ?></p>
                                        <p><?= $message->getMessage(); ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="close1<?= $message->getMsg_Id(); ?>" class="btn btn-secondary hidden" data-dismiss="modal">Close</button>
                                        <button type="button" id="close2<?= $message->getMsg_Id(); ?>" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="buttonRepondre<?= $message->getMsg_Id(); ?>">Répondre</button>

                                    </div>
                                    <div id="fcontacto<?= $message->getMsg_Id(); ?>" class="contacter-annoceur mx-auto hidden">
                                        <div class="contacter-annoceur mx-auto">
                                            <div class="hidden">
                                                <p>
                                                    <input name="sujet" id="sujet<?= $message->getMsg_Id(); ?>" type="text" size="22" value="Re: <?= $message->getSujet(); ?>" tabindex="1" />
                                                </p>
                                            </div>
                                            <div>
                                                <p>
                                                    <textarea name="message" id="message<?= $message->getMsg_Id(); ?>" cols="40" rows="4" tabindex="5" placeholder="votre message... (*)"></textarea>
                                                </p>
                                            </div>
                                            <p>
                                            <div class="alert alert-danger hidden" role="alert">
                                                (*) Champs requis
                                            </div>
                                            <button id="envoyer-contacter<?= $message->getMsg_Id(); ?>">Envoyer Message <i class="fa fa-paper-plane"></i></button>
                                            </p>

                                        </div>
                                    </div>
                                    <br />
                                    <script>
                                        $("#buttonRepondre<?= $message->getMsg_Id(); ?>").click(function () {
                                            $("#fcontacto<?= $message->getMsg_Id(); ?>").show();
                                        });
                                        $("#close1<?= $message->getMsg_Id(); ?>").click(function () {
                                            location.reload();
                                        });
                                        $(".close").click(function () {
                                            location.reload();
                                        });
                                        $("#envoyer-contacter<?= $message->getMsg_Id(); ?>").click(function () {
                                            if ($("#sujet<?= $message->getMsg_Id(); ?>").val() == "" || $("#message<?= $message->getMsg_Id(); ?>").val() == "") {
                                                $(".alert").show();
                                                $(".alert").alert();
                                            } else {
                                                $(".alert").hide();
                                                request = $.ajax({
                                                    url: "index.php?Messagerie&action=formAjoutMessage",
                                                    type: "post",
                                                    data: {
                                                        membre_id: $("#membre_id").val(),
                                                        destinataire_id: $("#destinataire_id<?= $message->getMsg_Id(); ?>").val(),
                                                        sujet: $("#sujet<?= $message->getMsg_Id(); ?>").val(),
                                                        message: $("#message<?= $message->getMsg_Id(); ?>").val()
                                                    }
                                                });
                                                request.done(function (response, textStatus, jqXHR) {
                                                    bootoast.toast({
                                                        message: 'message envoyé correctement!',
                                                        type: 'success',
                                                        position: 'top-center'

                                                    });
                                                    $("#close1<?= $message->getMsg_Id(); ?>").show();
                                                    $("#close2<?= $message->getMsg_Id(); ?>").hide();
                                                    
                                                    $("#fcontacto<?= $message->getMsg_Id(); ?>").hide();
                                                });
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <?php $i++; 
                    } ?>
                </ul>
            </div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <ul class="list-message">
                    <?php
                    foreach ($messagesEnvoyes as $message) {
                        ?>
                        <li>
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?= $message->getMsg_Id(); ?>"> 
                                <b><?= $message->getMembre_Id(); ?><?= $message->getMsg_Date(); ?>  <?= $message->getSujet(); ?></b></br>
                                <p><?= $message->getMessage(); ?></p>
                            </a>
                        </li>
                        <div class="modal fade" id="exampleModal<?= $message->getMsg_Id(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $message->getSujet(); ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><?= $message->getMembre_Id(); ?></p>
                                        <p><?= $message->getMsg_Date(); ?></p>
                                        <p> <?= $message->getMessage(); ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </ul>
            </div> 
        </div> 
    </div>
</div>
