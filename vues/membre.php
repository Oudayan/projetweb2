<?php
/**
 * @file      ControleurImages.php
 * @author    Guilherme Tosin, Marcelo Guzmán
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Page de vue pour les memebres
 * @details   Cette page permettre gerer les jeux de chaque membre.
 */

if(isset($_SESSION["id"]))
{
?>
  <div class="container">
    <h1 class="text-center my-3">Gestion des jeux à <?=$_SESSION['nomComplet']?></h1>
    <hr>
    <div class="row">
      <?php for ($i = 0; $i < count($donnees['jeux']); $i++) { ?>
        <div class="col-md-4">
          <div class="card cardjeux shadow p-3 mb-5 bg-white rounded">
            <img class="card-img-top" src="<?= $donnees['images'][$i]->getCheminPhoto() ?>" alt="Card image cap">
            <div class="card-body">
              <p class="card-text"><?= $donnees['jeux'][$i]->getTitre() ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="index.php?Jeux&action=formModifierJeux&JeuxId=<?= $donnees["jeux"][$i]->getJeuxId() ?>" class="btn btn-sm btn-outline-secondary">Modifier</a>
                  <?php if($donnees['jeux'][$i]->getJeuxActif()){ ?>
                  <button type="button" class="btn btn-sm btn-outline-secondary" onclick="location.href='index.php?Jeux&action=desactiverJeu&jeux_id=<?= $donnees['jeux'][$i]->getJeuxId() ?>'">Désacativer</button>
                  <?php } else { ?>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="location.href='index.php?Jeux&action=activerJeu&jeux_id=<?= $donnees['jeux'][$i]->getJeuxId() ?>'">Activer</button>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
<?php } else { ?>
<h2 class="text-center my-5 py-5">Vous devez vous connecter pour acceder à cette page</h2>
<?php } ?>
