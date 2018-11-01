                        <h5 class="text-center p-4">Achats</h5>
                        <table class="table table-responsive-md">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Titre achat</th>
                                    <th scope="col">Propriétaire</th>
                                    <th scope="col">Acheteur</th>
                                    <th scope="col">Paiement</th>
                                    <th scope="col">Date d'achat</th>
                                    <th scope="col">Opération</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php for ($i = 0; $i < count($donnees['achats']); $i++) { ?>
                                <tr class="<?= $donnees['achats'][$i]->getAchatActif() ? "" : "text-danger" ?>">
                                    <td><?= $donnees['achats'][$i]->getAchatId() ?></td>
                                    <td><?= $donnees['jeuAchat'][$i]->getTitre() ?></td>
                                    <td><?= $donnees['proprietaireJeuAchat'][$i]->getPrenom() . ' ' . $donnees['proprietaireJeuAchat'][$i]->getNom() ?></td>
                                    <td><?= $donnees['membreAchat'][$i]->getPrenom() . ' ' . $donnees['membreAchat'][$i]->getNom() ?></td>
                                    <td><?= $donnees['typePaiementAchat'][$i]->getTypePaiement() ?> </td>
                                    <td><?= $donnees['achats'][$i]->getDateAchat() ?> </td>
                                    <?php if ($donnees['achats'][$i]->getAchatActif() == 0) { ?>
                                        <td><button type="button" class="btn btn-sm btn-outline-success m-1" onclick="updateAchat(<?= $donnees['achats'][$i]->getAchatId() ?>, 'activerAchat')">Réactiver</button></td>
                                    <?php } else { ?>
                                        <td><button type="button" class="btn btn-sm btn-outline-danger m-1" onclick="updateAchat(<?= $donnees['achats'][$i]->getAchatId() ?>, 'desactiverAchat')">Annuler</button></td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
