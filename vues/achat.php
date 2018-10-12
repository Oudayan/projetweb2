<div class="container">
    <div id="panierDiv">
        <h1>Panier</h1>
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
                            <a href="index.php?Jeux&action=afficherJeu&JeuxId=<?= $jeux->getJeuxId() ?>"  class="img-thumbnail" >
                                <img class="card-img-top" src="<?= $_SESSION["cartImages"][$i]->getCheminPhoto() ?>" alt="Card image cap">
                            </a>
                        </td>
                        <td class="text-center"><?= $jeux->getTitre() ?></td>
                        <td class="text-center"><?= $jeux->getPrix() ?> $CAD</td>
                        <td class="text-center"> x <?= isset($_SESSION["quantite"][$i]) ? $_SESSION["quantite"][$i] : "1" ?></td>
                        <td class="text-center"><?= isset($_SESSION["prix"][$i]) ? number_format($_SESSION["prix"][$i], 2) : $jeux->getPrix() ?> $CAD</td>
                        <td class="text-center">
                            <button id="supprimerJeuxCart<?= $jeux->getJeuxId() ?>" onclick="supprimerJeuxCart('<?= $jeux->getJeuxId() ?>')" class="btn btn-danger"><i class="fa fa-eraser"></i></button>
                        </td>
                    </tr>
                    <?php $i++;
                } ?>
                <tr>
                    <td class="totalPanier" colspan="3">Total</td>
                    <td><?= number_format($_SESSION["prixTotal"], 2) ?> $CAD</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="5"> <a href="index.php?Achat&action=payerPanier" class="btn btn-primary">Payer comptant</a></td>
                </tr>
                <tr>
                    <td colspan="5"> <a href="index.php?Achat&action=payerPanier" class="btn btn-primary">Payer par chèque</a></td>
                </tr>
                <tr>
                    <td colspan="5">
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
                    <td colspan="5"><strong>Le panier est vide</strong></td>
                </tr>
                <tr>
                    <td colspan="5"><a href="index.php?Jeux&action=rechercherJeux" class="btn btn-info m-5"><i class="fas fa-search"></i> Continuer à magasiner</a>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div id="thanks" class="hidden">
        <h1>Merci.</h1>
        <p>Votre transaction avec identifiant <span id="transId" style="color: blue;"></span> a été traitée correctement.</p>
    </div>
</div>