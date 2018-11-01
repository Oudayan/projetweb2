<div class="container">
    <div id="panierDiv">
        <h1 class="text-center my-3">Panier d'achats</h1>
        <table class="table table-striped table-panier">
            <tr>
                <th colspan="2">Jeux</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Sous-total</th>
                <th></th>
            </tr>
            <?php
            if (isset($_SESSION["cart"]) && sizeof($_SESSION["cart"]) > 0) {
                $i = 0;
                foreach ($_SESSION["cart"] as $jeux) { ?>
                    <tr id="jeuxAchete<?= $jeux->getJeuxId() ?>">
                        <td class="text-center">
                            <a href="index.php?Jeux&action=afficherJeu&JeuxId=<?= $jeux->getJeuxId() ?>">
                                <img class="card-img-top img-thumbnail" src="<?= $_SESSION["cartImages"][$i]->getCheminPhoto() ?>" alt="Card image cap">
                            </a>
                        </td>
                        <td class="text-center"><strong><?= $jeux->getTitre() ?></strong><?= isset($_SESSION["datesLocation"][$i]) && $jeux->getLocation() ? '<p class="pt-2"><small>Du ' . $_SESSION["datesLocation"][$i] . '</small></p>' : '' ?></td>
                        <td class="text-center"><?= $jeux->getPrix() ?> $CAD</td>
                        <td class="text-center"> x <?= isset($_SESSION["quantite"][$i]) ? $_SESSION["quantite"][$i] : "1" ?></td>
                        <td class="text-center"><?= isset($_SESSION["prix"][$i]) ? number_format($_SESSION["prix"][$i], 2) : $jeux->getPrix() ?> $CAD</td>
                        <td class="text-center"><a href="index.php?Achat&action=supprimerAchat&jeux_id=<?= $jeux->getJeuxId() ?>" class="btn btn-danger"><i class="fa fa-eraser"></a></td>
                    </tr>
                    <?php $i++;
                } ?>
                <tr>
                    <td class="totalPanier" colspan="4"><strong>Total</strong></td>
                    <td><?= number_format($_SESSION["prixTotal"], 2) ?> $CAD</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="6"> <a href="index.php?Achat&action=payerPanier&transaction_id=Comptant" class="btn btn-success">Payer comptant</a></td>
                </tr>
                <tr>
                    <td colspan="6"> <a href="index.php?Achat&action=payerPanier&transaction_id=Cheque" class="btn btn-primary">Payer par chèque</a></td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div id="paypal-button-container"></div>
                        <script src="https://www.paypalobjects.com/api/checkout.js"></script>
                        <script>
                            // Render the PayPal button
                            paypal.Button.render({
                                // Set your environment
                                env: 'sandbox', // sandbox | production

                                // Specify the style of the button
                                style: {
                                    layout: 'vertical', // horizontal | vertical
                                    size: 'medium', // medium | large | responsive
                                    shape: 'rect', // pill | rect
                                    color: 'gold'       // gold | blue | silver | white | black
                                },

                                // Specify allowed and disallowed funding sources
                                //
                                // Options:
                                // - paypal.FUNDING.CARD
                                // - paypal.FUNDING.CREDIT
                                // - paypal.FUNDING.ELV
                                funding: {
                                    allowed: [
                                        paypal.FUNDING.CARD,
                                        paypal.FUNDING.CREDIT
                                    ],
                                    disallowed: []
                                },

                                // PayPal Client IDs - replace with your own
                                // Create a PayPal app: https://developer.paypal.com/developer/applications/create
                                client: {
                                    sandbox: 'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
                                    production: '<insert production client id>'
                                },

                                payment: function (data, actions) {
                                    return actions.payment.create({
                                        payment: {
                                            transactions: [
                                                {
                                                    amount: {
                                                        total: '<?= $total ?>',
                                                        currency: 'CAD'
                                                    }
                                                }
                                            ]
                                        }
                                    });
                                },

                                onAuthorize: function (data, actions) {
                                    return actions.payment.execute()
                                            .then(function (resp) {
                                                $("#transId").text(resp["id"]);
                                                request = $.ajax({
                                                    url: "index.php?achat&action=payerPanier",
                                                    type: "post",
                                                    data: {
                                                        transaction_id: resp["id"]
                                                    }
                                                });
                                                request.done(function (response) {
                                                    $("#thanks").show();
                                                    $("#panierDiv").hide();
                                                    $("#quantitePanier").val(0);
                                                    $("#cartQuantity").val(0);
                                                });
                                            });
                                }
                            }, '#paypal-button-container');
                        </script>

                    </td>
                </tr>
                <?php } else { ?>
                <tr>
                    <td colspan="6" class="my-5 py-5"><h3><?= isset($_SESSION['msg']) && $_SESSION['msg'] != '' ? $_SESSION['msg'] : 'Le panier est vide!' ?></h3></td>
                </tr>
                <tr>
                    <td colspan="6" class="my-5" py-5><a href="index.php?Jeux&action=rechercherJeux" class="btn btn-info m-5"><i class="fas fa-search"></i> Continuer à magasiner</a>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div id="thanks" class="hidden">
        <h1>Merci.</h1>
        <p>Votre transaction avec identifiant <span id="transId" style="color: blue;"></span> a été traitée correctement.</p>
    </div>
</div>