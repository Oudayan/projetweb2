<?php
//var_dump($donnees);
////var_dump($donnees['membres']);
//var_dump($donnees['membres'][0]);


?>

<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"
       aria-controls="v-pills-home" aria-selected="true">Afficher les membres</a>
    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab"
       aria-controls="v-pills-profile" aria-selected="false">#</a>
    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab"
       aria-controls="v-pills-messages" aria-selected="false">#</a>
    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab"
       aria-controls="v-pills-settings" aria-selected="false">#</a>
</div>

<div class="tab-content" id="v-pills-tabContent">
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
<!--Tableau -->
        <table class="table table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Adresse</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Courriel</th>
                <th scope="col">Validation</th>
                <th scope="col">Activation</th>
                <th scope="col">Type Administration</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($donnees['membres'] as $membre) { ?>
            <tr>
                <td><?= $membre->getMembreId(); ?></td>
                <td><?= $membre->getNom() ?></td>
                <td><?= $membre->getPrenom() ?></td>
                <td><?= $membre->getAdresse(); ?></td>
                <td><?= $membre->getMembreId(); ?></td>
                <td><?= $membre->getTelephone() ?></td>
                <td><?= $membre->getCourriel() ?></td>
                <td><?= $membre->getMembreValide(); ?></td>
                <td><?= $membre->getMembreActif();?></td>
                <a href=""></a>
            </tr>
            <?php } ?>


            </tbody>
        </table>

    </div>
    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
</div>