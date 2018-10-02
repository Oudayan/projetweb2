
<?php

$messages = $donnees["messages"]; ?>
<div class="container">
    <div class="h3 mt-5 mb-5" style="display:flex;">

        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Nouveaux</a>
          <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Envoyés</a>
          <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Mes Messages</a>
          <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Composer</a>
        </div>
        <div class="tab-content ml-3" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
              <?php

                  foreach ($messages as $message){
              ?>
                <li><a href="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?= $message->getMsg_Id(); ?>"> <?= $message->getMsg_Date(); ?>/<?= $message->getSujet(); ?></a></li>

                <div class="modal fade" id="exampleModal<?= $message->getMsg_Id(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?= $message->getSujet();?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p><?= $message->getMsg_Date(); ?></p>
                        <p> <?= $message->getMessage();?></p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>

              <?php } ?>
            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
              <ul>
              <?php
                  foreach ($messages as $message){
              ?>
                <li><?= $message->getSujet(); ?></li>

              <?php } ?>
            </ul>
          </div>
          <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
              <div class="contacter-annoceur mx-auto">
                        <div id="c_information" class="hide">
                            <p>- - -</p>
                          </div>

                          <a>Composer un message</a> <i class="fas fa-envelope"></i>
                          <div id="fcontacto">
                          <!-- bloc de confirmation de envoy caché  -->

                          <!-- Fin de confirmation de l'envoi -->
                          <br>

                          <!-- debut de formulario -->
                          <form action="<?php echo URL; ?>messagerie/setMessage" method="post" enctype="multipart/form-data" name="contact">
                                <div>

                                    <p>
                                      <input name="message" id="message" type="text" size="22" tabindex="2" placeholder="Message" />
                                    </p>
                                    <p>
                                        <input name="sujet" id="sujet" type="text" size="22" tabindex="1" placeholder="Subjet... (*)" />
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        <textarea name="message" id="message" cols="40" rows="8" tabindex="5" placeholder="votre message... (*)"></textarea>
                                    </p>
                                </div>
                                <p>
                                    <label>(*) Champs requis</label>
                                    <input name="cenvoyer" type="submit" id="submit" tabindex="6" value="Envoyer Message" />
                                </p>
                          </form>

                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
