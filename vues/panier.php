        <button id="cart" class="btn btn-info btn-block dropdown-toggle text-uppercase text-white m-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-shopping-cart"> <span class="badge" id="cartQuantity"><?= isset($_SESSION["cart"]) ? sizeof($_SESSION["cart"]) : "0" ?></span></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right container container-shopping-cart" id="shopping-cart">
            <div class="shopping-cart">
                <p class="text-center text-danger mt-2"><strong><?= isset($_SESSION['msg']) ? $_SESSION['msg'] : "" ?></strong></p>
                <table class="table table-striped table-panier dropdown-item border" >
                    <thead class="thead">
                        <tr>
                            <th scope="col" colspan="2">Jeu</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Sous-total</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($_SESSION["cart"]) && sizeof($_SESSION["cart"]) > 0) {
                        $i = 0;
                        $total = 0;
                        foreach ($_SESSION["cart"] as $jeux) { ?>
                            <tr id="jeuxAchete<?= $jeux->getJeuxId() ?>">
                                <td class="text-center">
                                    <a href="index.php?Jeux&action=afficherJeu&JeuxId=<?= $jeux->getJeuxId() ?>">
                                        <img class="img-thumbnail miniature" src="<?= $_SESSION["cartImages"][$i]->getCheminPhoto() ?>" alt="<?= $jeux->getTitre() ?>">
                                    </a>
                                </td>
                                <td class="text-center"><strong><?= $jeux->getTitre() ?></strong><?= isset($_SESSION["datesLocation"][$i]) && $jeux->getLocation() ? '<p class="pt-2"><small>Du ' . $_SESSION["datesLocation"][$i] . '</small></p>' : '' ?></td>
                                <td class="text-center"><?= number_format($jeux->getPrix(), 2) ?> <small>$CAD</small></td>
                                <td class="text-center"> x <?= isset($_SESSION["quantite"][$i]) ? $_SESSION["quantite"][$i] : "1" ?></td>
                                <td class="text-center"><?= isset($_SESSION["prix"][$i]) ? number_format($_SESSION["prix"][$i], 2) : $jeux->getPrix() ?> <small>$CAD</small></td>
                                <td class="text-center">
                                    <button id="supprimerJeuxCart<?= $jeux->getJeuxId() ?>" onclick="supprimerJeuxCart('<?= $jeux->getJeuxId() ?>')" class="btn btn-danger"><i class="fa fa-eraser"></i></button>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        } ?>
                        <tr>
                            <td colspan="3">
                            <td class="totalPanier"><strong>Total</strong></td>
                            <td><?= number_format($_SESSION["prixTotal"], 2) ?> $CAD</td>
                            <td></td>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td colspan="6" class="text-center"><strong>Le panier est vide.</strong></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="dropdown-item text-right">
                    <a href="index.php?Achat&action=afficherPanier" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Check-out</a>
                </div>
            </div>
        </div>