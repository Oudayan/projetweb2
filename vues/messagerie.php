
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
                    foreach ($messagesRecu as $message) {
                        ?>
                        <li>
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?= $message->getMsg_Id(); ?>"> 
                                <b><?= $message->getMsg_Date(); ?>  <?= $message->getSujet(); ?></b></br>
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
                                        <p><?= $message->getMsg_Date(); ?></p>
                                        <p><?= $message->getMessage(); ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="close1" class="btn btn-secondary hidden" data-dismiss="modal">Close</button>
                                        <button type="button" id="close2" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="buttonRepondre">Répondre</button>

                                    </div>
                                    <div id="fcontacto" class="contacter-annoceur mx-auto hidden">
                                        <div class="contacter-annoceur mx-auto">
                                            <div class="hidden">
                                                <p>
                                                    <input name="sujet" id="sujet" type="text" size="22" value="Re: <?= $message->getSujet(); ?>" tabindex="1" />
                                                </p>
                                            </div>
                                            <div>
                                                <p>
                                                    <textarea name="message" id="message" cols="40" rows="4" tabindex="5" placeholder="votre message... (*)"></textarea>
                                                </p>
                                            </div>
                                            <p>
                                            <div class="alert alert-danger hidden" role="alert">
                                                (*) Champs requis
                                            </div>
                                            <button id="envoyer-contacter">Envoyer Message <i class="fa fa-paper-plane"></i></button>
                                            </p>

                                        </div>
                                    </div>
                                    </br>
                                    <script>
                                        $("#buttonRepondre").click(function () {
                                            $("#fcontacto").show();
                                        });
                                        $("#close1").click(function () {
                                            location.reload();
                                        });
                                        $(".close").click(function () {
                                            location.reload();
                                        });
                                        $("#envoyer-contacter").click(function () {
                                            if ($("#sujet").val() == "" || $("#message").val() == "") {
                                                $(".alert").show();
                                                $(".alert").alert();
                                            } else {
                                                $(".alert").hide();
                                                request = $.ajax({
                                                    url: "index.php?messagerie&action=formAjoutMessage",
                                                    type: "post",
                                                    data: {
                                                        membre_id: $("#membre_id").val(),
                                                        destinataire_id: $("#destinataire_id<?= $message->getMsg_Id(); ?>").val(),
                                                        sujet: $("#sujet").val(),
                                                        message: $("#message").val()
                                                    }
                                                });
                                                request.done(function (response, textStatus, jqXHR) {
                                                    bootoast.toast({
                                                        message: 'message envoyé correctement!',
                                                        type: 'success',
                                                        position: 'top-center'

                                                    });
                                                    $("#close1").show();
                                                    $("#close2").hide();
                                                    
                                                    $("#fcontacto").hide();
                                                });
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </ul>
            </div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <ul class="list-message">
                    <?php
                    foreach ($messagesEnvoyes as $message) {
                        ?>
                        <li>
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?= $message->getMsg_Id(); ?>"> 
                                <b><?= $message->getMsg_Date(); ?>  <?= $message->getSujet(); ?></b></br>
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
