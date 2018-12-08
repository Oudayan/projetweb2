<?php
/**
 * @file      ControleurImages.php
 * @author    Guilherme Tosin, Marcelo Guzmán
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Page de vue pour les memebres
 * @details   Cette page permettre gerer les jeux de chaque membre.
 */
		// echo "<pre>";
		// var_dump($donnees);
		// echo "</pre>";
		if (isset($_SESSION["id"])) { ?>
		<div class="container">
			<h1 class="text-center my-3">Gestion des jeux à <?= $_SESSION['nomComplet'] ?></h1>
			<hr>
			<div class="d-flex justify-content-around my-3">
				<a href="index.php?Jeux&action=formAjoutJeux" class="btn btn-outline-success btn-lg my-2">Ajouter un&nbsp;jeu</a>
			</div>
			<hr>
			<?php for ($i = 0; $i < count($donnees['jeux']); $i++) { ?>
			<section class="row py-3">
				<h2 class="col-12 text-center mb-3"> <?= $donnees['jeux'][$i]->getTitre() ?> </h2>
				<div class="col-lg-4">
					<div class="card cardjeux shadow p-3 bg-white rounded">
						<div id="carouselJeu<?= $donnees['jeux'][$i]->getJeuxId() ?>" class="carousel slide" data-ride="carousel">
							<?php if (count($donnees['images' . $donnees['jeux'][$i]->getJeuxId()]) > 1) { ?>
								<ol class="carousel-indicators">
								<?php for ($j = 0; $j < count($donnees['images' . $donnees['jeux'][$i]->getJeuxId()]); $j++) {
									if ($j == 0) { ?>
										<li data-target='#carouselJeu<?= $donnees['jeux'][$i]->getJeuxId() ?>' data-slide-to='<?= $j ?>' class='active'></li>
									<?php } else { ?>
										<li data-target='#carouselJeu<?= $donnees['jeux'][$i]->getJeuxId() ?>' data-slide-to='<?= $j ?>'></li>
									<?php }
								} ?>
								</ol>
							<?php } ?>
							<div class="carousel-inner">
							<?php for ($j = 0; $j < count($donnees['images' . $donnees['jeux'][$i]->getJeuxId()]); $j++) {
								if ($j == 0) { ?>
								<div class="carousel-item active">
								<?php } else { ?>
								<div class="carousel-item">
								<?php } ?>
									<a href="#infos<?= $donnees['jeux'][$i]->getJeuxId() ?>" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="infos<?= $donnees['jeux'][$i]->getJeuxId() ?>"><img class="d-block w-100" src="<?= $donnees['images' . $donnees['jeux'][$i]->getJeuxId()][$j]->getCheminPhoto() ?>" alt="<?= $donnees['jeux'][$i]->getTitre() ?>"></a>
								</div>
							<?php } ?>
							</div>
							<?php if (count($donnees['images' . $donnees['jeux'][$i]->getJeuxId()]) > 1) { ?>
								<a class="carousel-control-prev" href="#carouselJeu<?= $donnees['jeux'][$i]->getJeuxId() ?>" role="button" data-slide="prev">
									<span class="carousel-control-prev-icon"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control-next" href="#carouselJeu<?= $donnees['jeux'][$i]->getJeuxId() ?>" role="button" data-slide="next">
									<span class="carousel-control-next-icon"></span>
									<span class="sr-only">Next</span>
								</a>
							<?php } ?>
						</div>
						<div class="card-body">
							<div class="d-flex justify-content-center">
								<div class="btn-group">
									<button class="btn btn-sm btn-outline-info" type="button" data-toggle="collapse" data-target="#infos<?= $donnees['jeux'][$i]->getJeuxId() ?>" aria-expanded="false" aria-controls="infos<?= $donnees['jeux'][$i]->getJeuxId() ?>">Infos</button>
									<a href="index.php?Jeux&action=formModifierJeux&JeuxId=<?= $donnees['jeux'][$i]->getJeuxId() ?>" class="btn btn-sm btn-outline-primary">Modifier</a>
									<?php if($donnees['jeux'][$i]->getJeuxActif()){ ?>
									<button type="button" class="btn btn-sm btn-outline-danger" onclick="location.href='index.php?Jeux&action=desactiverJeu&jeux_id=<?= $donnees['jeux'][$i]->getJeuxId() ?>'">Désactiver</button>
									<?php } else { ?>
									<button type="button" class="btn btn-sm btn-outline-success" onclick="location.href='index.php?Jeux&action=activerJeu&jeux_id=<?= $donnees['jeux'][$i]->getJeuxId() ?>'">Activer</button>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="infos<?= $donnees['jeux'][$i]->getJeuxId() ?>" class="col-lg-8 collapse">
					<div class="row">
						<div class="col-lg-6 card info-card mx-3 p-3">
							<h4 class="text-center">Infos</h4>
							<p class="row">
								<span class="col-5 lead">Prix:</span>
								<span class="col"><?=($donnees["jeux"][$i]->getPrix())?> <small>$CAD</small> <?= $donnees["jeux"][$i]->getLocation() ? "par jour" : "" ?></span>
							</p>
							<p class="row">
								<span class="col-5">Plateforme:</span>
								<span class="col"><?= $donnees["plateforme"][$i]->getPlateformeIcone() . " " . $donnees["plateforme"][$i]->getPlateforme() ?></span>
							</p>
							<p class="row">
								<span class="col-5">Concepteur:</span>
								<span class="col"><?=($donnees["jeux"][$i]->getConcepteur())?></span>
							</p>
							<p class="row">
								<span class="col-5">Date d'ajout:</span>
								<span class="col"><?=($donnees["jeux"][$i]->getDateAjout())?></span>
							</p>
							<p class="row">
								<span class="col-5">Catégorie<?= count($donnees['categoriesJeu'][$i]) > 1 ? "s" : "" ?>:</span>
								<span class="col">
								<?php for ($j = 0; $j < count($donnees['categoriesJeu'][$i]); $j++) {
									if ($j == 0) { ?>
										<span><?= $donnees['categoriesJeu'][$i][$j]->getCategorie() ?></span>
									<?php } else { ?>
										<span> <span class="cat-symbol"><i class="fas fa-angle-right"></i></span> <?= $donnees['categoriesJeu'][$i][$j]->getCategorie() ?></span>
									<?php }
								} ?>
								</span>
							</p>
							<p class="row">
								<span class="col-5">Évaluations:</span>
								<span class="col">
								<?php if($donnees["jeux"][$i]->getEvaluationGlobale() >= 0){ ?>
									<span class="score"><span style="width: <?= ($donnees["jeux"][$i]->getEvaluationGlobale() / 5) * 100 ?>%"></span></span> <small>(<?= round($donnees["jeux"][$i]->getEvaluationGlobale(), 2) ?>/5)</small>
									<br><small><?= $donnees['nbEvaluations'][$i][0] . " " . ($donnees['nbEvaluations'][$i][0] > 1 ? "évaluations" : "évaluation") ?></small>
								<?php } else { ?>
									<span>Jeu non évalué</span>
								<?php } ?>
								</span>
							</p>
							<p class="row">
								<span class="col-5">Commentaires:</span>
								<span class="col">
									<?= $donnees['nbCommentaires'][$i][0] . " commentaire" . ($donnees['nbCommentaires'][$i][0] > 1 ? "s" : "") ?>
								</span>
							</p>
							<?php if ($donnees['nbCommentaires'][$i][0] > 0) { ?>
							<p class="d-flex justify-content-around">
								<button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#commentaires<?= $donnees['jeux'][$i]->getJeuxId() ?>">Voir <?= $donnees['nbCommentaires'][$i][0] > 1 ? "évaluations & commentaires" : "évaluation & commentaire" ?></button>
							</p>
							<div class="modal fade" id="commentaires<?= $donnees['jeux'][$i]->getJeuxId() ?>" tabindex="-1" role="dialog" aria-labelledby="commentaires<?= $donnees['jeux'][$i]->getJeuxId() ?>Title" aria-hidden="true">
								<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="commentaires<?= $donnees['jeux'][$i]->getJeuxId() ?>Title"><?= $donnees['nbCommentaires'][$i][0] > 1 ? "Commentaires" : "Commentaire" ?> sur le jeu <?= $donnees['jeux'][$i]->getTitre() ?></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<table class="table table-responsive-md">
												<thead class="thead">
													<tr>
														<th scope="col">ID</th>
														<th scope="col">Membre</th>
														<th scope="col">Date</th>
														<th scope="col">Évaluation</th>
														<th scope="col">Commentaire</th>
														<th scope="col">Status</th>
													</tr>
												</thead>
												<tbody>
												<?php for ($j = 0; $j < count($donnees["evaluations"][$i]); $j++) { 
													// if ($donnees["evaluations"][$i][$j]->getCommentaireJeu() != NULL) { ?>
													<tr class="<?= $donnees['evaluations'][$i][$j]->getEvaluationJeuActive() ? '' : 'text-danger' ?>">
														<td><?= $donnees["evaluations"][$i][$j]->getEvaluationId() ?></td>
														<td><?= $donnees["membresEvaluateurs"][$i][$j]->getPrenom() . " " . $donnees["membresEvaluateurs"][$i][$j]->getNom() ?></td>
														<td><?= $donnees["evaluations"][$i][$j]->getDateEvaluation() ?></td>
														<td><span class="score"><span style="width: <?= ($donnees["evaluations"][$i][$j]->getEvaluationJeu() / 5) * 100 ?>%"></span></span> <small>(<?= round($donnees["evaluations"][$i][$j]->getEvaluationJeu(), 2) ?>/5)</small></td>
														<td><?= $donnees["evaluations"][$i][$j]->getCommentaireJeu() ?></td>
														<td><?= $donnees["evaluations"][$i][$j]->getEvaluationJeuActive() ? "Actif" : "Annulée" ?></td>
													</tr>
													<?php // }
												} ?>
												</tbody>
											</table>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
						<div class="col-lg">
							<div class="card p-3 text-center">
								<h4>Status</h4>
								<h5><?= $donnees['status'][$i] ?></h5>
								<?php if (isset($donnees['locationsCourantes'][$i]) && count($donnees['locationsCourantes'][$i]) > 0) { ?>
								<div class="d-flex justify-content-around">
									<button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#locationsCourantes<?= $donnees['jeux'][$i]->getJeuxId() ?>">Détails</button>
									<div class="modal fade" id="locationsCourantes<?= $donnees['jeux'][$i]->getJeuxId() ?>" tabindex="-1" role="dialog" aria-labelledby="locationsCourantes<?= $donnees['jeux'][$i]->getJeuxId() ?>Title" aria-hidden="true">
										<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="locationsCourantes<?= $donnees['jeux'][$i]->getJeuxId() ?>Title">Locations courantes du jeu <?= $donnees['jeux'][$i]->getTitre() ?></h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<table class="table table-responsive-md">
														<thead class="thead">
															<tr>
																<th scope="col">ID</th>
																<th scope="col">Locataire</th>
																<th scope="col">Date location</th>
																<th scope="col">Date début</th>
																<th scope="col">Date retour</th>
																<th scope="col">Paiement</th>
																<th scope="col">Prix</th>
																<th scope="col">Status</th>
															</tr>
														</thead>
														<tbody>
														<?php for ($j = 0; $j < count($donnees["locationsCourantes"][$i]); $j++) { ?>
															<tr class="<?= $donnees['locationsCourantes'][$i][$j]->getLocationActive() ? 'text-success' : 'text-danger' ?>">
																<td><?= $donnees["locationsCourantes"][$i][$j]->getLocationId() ?></td>
																<td><?= $donnees["membreLocationsCourantes"][$i][$j]->getPrenom() . " " . $donnees["membreLocationsCourantes"][$i][$j]->getNom() ?></td>
																<td><?= $donnees["locationsCourantes"][$i][$j]->getDateLocation() ?></td>
																<td><?= date("Y-m-d", strtotime($donnees["locationsCourantes"][$i][$j]->getDateDebut())) ?></td>
																<td><?= date("Y-m-d", strtotime($donnees["locationsCourantes"][$i][$j]->getDateRetour())) ?></td>
																<td><?= $donnees["typePaiementLocationsCourantes"][$i][$j]->getTypePaiement() ?> </td>
																<td><?= $donnees["locationsCourantes"][$i][$j]->getPrixLocation() ?> <small>$CAD</small></td>
																<td><?= $donnees["locationsCourantes"][$i][$j]->getLocationActive() ? "Active" : "Annulée" ?></td>
															</tr>
														<?php } ?>
														</tbody>
													</table>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
							<?php if ((isset($donnees['achats'][$i]) && count($donnees['achats'][$i]) > 0) || (isset($donnees['historiqueLocations'][$i]) && count($donnees['historiqueLocations'][$i]) > 0)) { ?>
							<div class="card p-3">
								<h4 class="text-center mb-3">Historique</h4>
								<div class="d-flex justify-content-around">
								<?php if (isset($donnees['achats'][$i]) && count($donnees['achats'][$i]) > 0) { ?>
									<button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#historiqueAchats<?= $donnees['jeux'][$i]->getJeuxId() ?>">Achats</button>
									<div class="modal fade" id="historiqueAchats<?= $donnees['jeux'][$i]->getJeuxId() ?>" tabindex="-1" role="dialog" aria-labelledby="historiqueAchats<?= $donnees['jeux'][$i]->getJeuxId() ?>Title" aria-hidden="true">
										<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="historiqueAchats<?= $donnees['jeux'][$i]->getJeuxId() ?>Title">Historique des achats du jeu <?= $donnees['jeux'][$i]->getTitre() ?></h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<pre>
													<table class="table table-responsive-md">
														<thead class="thead">
															<tr>
																<th scope="col">ID</th>
																<th scope="col">Acheteur</th>
																<th scope="col">Date d'achat</th>
																<th scope="col">Paiement</th>
																<th scope="col">Prix</th>
																<th scope="col">Status</th>
															</tr>
														</thead>
														<tbody>
														<?php for ($j = 0; $j < count($donnees['achats'][$i]); $j++) { ?>
															<tr class="<?= $donnees['achats'][$i][$j]->getAchatActif() ? "" : "text-danger" ?>">
																<td><?= $donnees['achats'][$i][$j]->getAchatId() ?></td>
																<td><?= $donnees['membreAchat'][$i][$j]->getPrenom() . ' ' . $donnees['membreAchat'][$i][$j]->getNom() ?></td>
																<td><?= $donnees['achats'][$i][$j]->getDateAchat() ?></td>
																<td><?= $donnees['typePaiementAchat'][$i][$j]->getTypePaiement() ?> </td>
																<td><?= $donnees['achats'][$i][$j]->getPrixAchat() ?> <small>$CAD</small></td>
																<td><?= $donnees['achats'][$i][$j]->getAchatActif() ? "Actif" : "Annulé" ?></td>
															</tr>
														<?php } ?>
														</tbody>
													</table>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
								<?php } 
								if (isset($donnees['historiqueLocations'][$i]) && count($donnees['historiqueLocations'][$i]) > 0) { ?>
									<button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#historiqueLocations<?= $donnees['jeux'][$i]->getJeuxId() ?>">Locations</button>
									<div class="modal fade" id="historiqueLocations<?= $donnees['jeux'][$i]->getJeuxId() ?>" tabindex="-1" role="dialog" aria-labelledby="historiqueLocations<?= $donnees['jeux'][$i]->getJeuxId() ?>Title" aria-hidden="true">
										<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="historiqueLocations<?= $donnees['jeux'][$i]->getJeuxId() ?>Title">Historique des locations du jeu <?= $donnees['jeux'][$i]->getTitre() ?></h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<table class="table table-responsive-md">
														<thead class="thead">
															<tr>
																<th scope="col">ID</th>
																<th scope="col">Locataire</th>
																<th scope="col">Date location</th>
																<th scope="col">Date début</th>
																<th scope="col">Date retour</th>
																<th scope="col">Paiement</th>
																<th scope="col">Prix</th>
																<th scope="col">Status</th>
															</tr>
														</thead>
														<tbody>
														<?php for ($j = 0; $j < count($donnees["historiqueLocations"][$i]); $j++) { ?>
															<tr class="<?= $donnees['historiqueLocations'][$i][$j]->getLocationActive() ? '' : 'text-danger' ?>">
																<td><?= $donnees["historiqueLocations"][$i][$j]->getLocationId() ?></td>
																<td><?= $donnees["membreHistoriqueLocations"][$i][$j]->getPrenom() . " " . $donnees["membreHistoriqueLocations"][$i][$j]->getNom() ?></td>
																<td><?= $donnees["historiqueLocations"][$i][$j]->getDateLocation() ?></td>
																<td><?= date("Y-m-d", strtotime($donnees["historiqueLocations"][$i][$j]->getDateDebut())) ?></td>
																<td><?= date("Y-m-d", strtotime($donnees["historiqueLocations"][$i][$j]->getDateRetour())) ?></td>
																<td><?= $donnees["typePaiementHistoriqueLocations"][$i][$j]->getTypePaiement() ?> </td>
																<td><?= $donnees["historiqueLocations"][$i][$j]->getPrixLocation() ?> <small>$CAD</small></td>
																<td><?= $donnees["historiqueLocations"][$i][$j]->getLocationActive() ? "Active" : "Annulée" ?></td>
															</tr>
														<?php } ?>
														</tbody>
													</table>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
								<?php } ?>
								</div>
							</div>
							<?php }
							if (isset($donnees['locationsAVenir'][$i]) && count($donnees['locationsAVenir'][$i]) > 0) { ?>
							<div class="card p-3">
								<h4 class="text-center mb-3">Locations à venir</h4>
								<div class="d-flex justify-content-around">
									<button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#locationsAVenir<?= $donnees['jeux'][$i]->getJeuxId() ?>">Détails</button>
									<div class="modal fade" id="locationsAVenir<?= $donnees['jeux'][$i]->getJeuxId() ?>" tabindex="-1" role="dialog" aria-labelledby="locationsAVenir<?= $donnees['jeux'][$i]->getJeuxId() ?>Title" aria-hidden="true">
										<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="locationsAVenir<?= $donnees['jeux'][$i]->getJeuxId() ?>Title">Locations à venir du jeu <?= $donnees['jeux'][$i]->getTitre() ?></h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<table class="table table-responsive-md">
														<thead class="thead">
															<tr>
																<th scope="col">ID</th>
																<th scope="col">Locataire</th>
																<th scope="col">Date location</th>
																<th scope="col">Date début</th>
																<th scope="col">Date retour</th>
																<th scope="col">Paiement</th>
																<th scope="col">Prix</th>
																<th scope="col">Opérations</th>
															</tr>
														</thead>
														<tbody>
														<?php for ($j = 0; $j < count($donnees["locationsAVenir"][$i]); $j++) { ?>
															<tr class="<?= $donnees['locationsAVenir'][$i][$j]->getLocationActive() ? '' : 'text-danger' ?>">
																<td><?= $donnees["locationsAVenir"][$i][$j]->getLocationId() ?></td>
																<td><?= $donnees["membreLocationsAVenir"][$i][$j]->getPrenom() . " " . $donnees["membreLocationsAVenir"][$i][$j]->getNom() ?></td>
																<td><?= $donnees["locationsAVenir"][$i][$j]->getDateLocation() ?></td>
																<td><?= date("Y-m-d", strtotime($donnees["locationsAVenir"][$i][$j]->getDateDebut())) ?></td>
																<td><?= date("Y-m-d", strtotime($donnees["locationsAVenir"][$i][$j]->getDateRetour())) ?></td>
																<td><?= $donnees["typePaiementLocationsAVenir"][$i][$j]->getTypePaiement() ?> </td>
																<td><?= $donnees["locationsAVenir"][$i][$j]->getPrixLocation() ?> <small>$CAD</small></td>
																<td><?= $donnees["locationsAVenir"][$i][$j]->getLocationActive() ? "Active" : "Annulée" ?></td>
															</tr>
														<?php } ?>
														</tbody>
													</table>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</section>
			<hr>
			<?php } ?>
		</div>
		<?php } else { ?>
		<h2 class="text-center my-5 py-5">Vous devez vous connecter pour acceder à cette page</h2>
		<?php } ?>

		<script>

			$(window).on('load resize', function() {
				if (parseInt($(window).width()) < 992) {
					$(".collapse").collapse('hide');
				}
				else {
					$(".collapse").collapse('show');
				}
			});

		</script>