
                <div class="container row">
                    <label class="col-2 my-3 ml-3 pt-1 text-right">Trier&nbsp;par&nbsp;:&nbsp;</label>
                    <?php if (isset($donnees["tri"])) { ?>
                        <select class="col-4 tri form-control my-3">
                        <?php foreach ($donnees["tri"] as $valeur => $label) { ?>
                            <option value="<?= $valeur ?>"<?= isset($donnees["triSelected"]) && $donnees["triSelected"] == $valeur ? " selected" : "" ?>><?= $label ?></option>
                        <?php } ?>
                        </select>
                    <?php } else { ?>
                        <label class="col-4 my-3 mr-3 pt-1">&nbsp;ID</label>
                    <?php } ?>
                    <select class="col ordre form-control my-3 mr-3">
                        <option value="1"<?= isset($donnees["ordre"]) && $donnees["ordre"] == "1" ? " selected" : "" ?>>Ascendant</option>
                        <option value="2"<?= isset($donnees["ordre"]) && $donnees["ordre"] == "2" ? " selected" : "" ?>>Descendant</option>
                    </select>
                    <select class="col-md itemsParPage form-control m-3">
                        <option value="6"<?= $donnees["itemsParPage"] == "6" ? " selected" : "" ?>>6 items par page</option>
                        <option value="12"<?= $donnees["itemsParPage"] == "12" ? " selected" : "" ?>>12 items par page</option>
                        <option value="18"<?= $donnees["itemsParPage"] == "18" ? " selected" : "" ?>>18 items par page</option>
                        <option value="24"<?= $donnees["itemsParPage"] == "24" ? " selected" : "" ?>>24 items par page</option>
                        <option value="36"<?= $donnees["itemsParPage"] == "36" ? " selected" : "" ?>>36 items par page</option>
                        <option value="48"<?= $donnees["itemsParPage"] == "48" ? " selected" : "" ?>>48 items par page</option>  
                    </select>
                </div>
                <?php if (isset($donnees["pagination"]) && $donnees["pagination"]["totalPages"] > 1) { ?>
                    <div class="container d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <?php if ($donnees["pagination"]["totalPages"] > 2) { ?>
                                <li class="page-item<?= $donnees["pagination"]["currentPage"] == 1 ? " disabled" : "" ?>">
                                    <button class="page-link" onclick="getFirst()" aria-label="first"<?= $donnees["pagination"]["currentPage"] == 1 ? " inactive" : "" ?>>
                                        <span aria-hidden="true">&lt;&lt;</span>
                                        <span class="sr-only">First</span>
                                    </button>
                                </li>
                                <?php } ?>
                                <li class="page-item<?= $donnees["pagination"]["currentPage"] == 1 ? " disabled" : "" ?>">
                                    <button class="page-link" onclick="getPrevious()" aria-label="previous"<?= $donnees["pagination"]["currentPage"] == 1 ? " inactive" : "" ?>>
                                        <span aria-hidden="true">&lt;</span>
                                        <span class="sr-only">Previous</span>
                                    </button>
                                </li>
                                <?php for($i = $donnees["pagination"]["startPage"]; $i <= $donnees["pagination"]["endPage"]; $i++) { ?>
                                <li class="page-item<?= $i == $donnees["pagination"]["currentPage"] ? " active" : "" ?>">
                                    <button class="page-link page-click"><?= $i ?></button>
                                </li>
                                <?php } ?>
                                <li class="page-item<?= $donnees["pagination"]["currentPage"] == $donnees["pagination"]["totalPages"] ? " disabled" : "" ?>">
                                    <button class="page-link" onclick="getNext()" aria-label="Next"<?= $donnees["pagination"]["currentPage"] == $donnees["pagination"]["totalPages"] ? " inactive" : "" ?>>
                                        <span aria-hidden="true">&gt;</span>
                                        <span class="sr-only">Next</span>
                                    </button>
                                </li>
                                <?php if ($donnees["pagination"]["totalPages"] > 2) { ?>
                                <li class="page-item<?= $donnees["pagination"]["currentPage"] == $donnees["pagination"]["totalPages"] ? " disabled" : "" ?>">
                                    <button class="page-link" onclick="getLast()" aria-label="Last"<?= $donnees["pagination"]["currentPage"] == $donnees["pagination"]["totalPages"] ? " inactive" : "" ?>>
                                        <span aria-hidden="true">&gt;&gt;</span>
                                        <span class="sr-only">Last</span>
                                    </button>
                                </li>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>
                <?php } ?>
                <script type="text/javascript">

                    var url = <?= isset($donnees["url"]) ? $donnees["url"] : "'index.php';" ?>

                    var retour = <?= isset($donnees["retour"]) ? $donnees["retour"] : "'';" ?>

                    var page = <?= isset($donnees["pagination"]["currentPage"]) ? $donnees["pagination"]["currentPage"] : "1;" ?>


                    function getFirst() {
                        var itemsParPage = <?= isset($donnees["itemsParPage"]) ? $donnees["itemsParPage"] . ";" : "6;" ?>

                        var tri = <?= isset($donnees["triSelected"]) ? "'" . $donnees["triSelected"] . "';" : "0;" ?>

                        var ordre = <?= isset($donnees["ordre"]) ? "'" . $donnees["ordre"] ."';" : "2;" ?>

                        $.ajax({
                            url: url, 
                            type: 'POST',
                            dataType: 'html',
                            data: { 
                                page: 1,
                                itemsParPage: itemsParPage,
                                tri: tri,
                                ordre: ordre,
                            },
                            success: function(donnees) {
                                $(retour).empty();
                                $(retour).html(donnees);
                            }
                        });
                    }

                    function getPrevious() {
                        var itemsParPage = <?= isset($donnees["itemsParPage"]) ? $donnees["itemsParPage"] . ";" : "6;" ?>

                        var tri = <?= isset($donnees["triSelected"]) ? "'" . $donnees["triSelected"] . "';" : "0;" ?>

                        var ordre = <?= isset($donnees["ordre"]) ? "'" . $donnees["ordre"] ."';" : "2;" ?>

                        $.ajax({
                            url: url, 
                            type: 'POST',
                            dataType: 'html',
                            data: { 
                                page: page - 1,
                                itemsParPage: itemsParPage,
                                tri: tri,
                                ordre: ordre,
                            },
                            success: function(donnees) {
                                $(retour).empty();
                                $(retour).html(donnees);
                            }
                        });
                    }

                    function getNext() {
                        var itemsParPage = <?= isset($donnees["itemsParPage"]) ? $donnees["itemsParPage"] . ";" : "6;" ?>

                        var tri = <?= isset($donnees["triSelected"]) ? "'" . $donnees["triSelected"] . "';" : "0;" ?>

                        var ordre = <?= isset($donnees["ordre"]) ? "'" . $donnees["ordre"] . "'" : "2;" ?>

                        $.ajax({
                            url: url, 
                            type: 'POST',
                            dataType: 'html',
                            data: { 
                                page: page + 1,
                                itemsParPage: itemsParPage,
                                tri: tri,
                                ordre: ordre,
                            },
                            success: function(donnees) {
                                $(retour).empty();
                                $(retour).html(donnees);
                            }
                        });
                    }

                    function getLast() {
                        var itemsParPage = <?= isset($donnees["itemsParPage"]) ? $donnees["itemsParPage"] . ";" : "6;" ?>

                        var tri = <?= isset($donnees["triSelected"]) ? "'" . $donnees["triSelected"] . "';" : "0;" ?>

                        var ordre = <?= isset($donnees["ordre"]) ? "'" . $donnees["ordre"] . "'" : "2;" ?>

                        $.ajax({
                            url: url, 
                            type: 'POST',
                            dataType: 'html',
                            data: { 
                                page: <?= $donnees["pagination"]["totalPages"] ?>
                                ,
                                itemsParPage: itemsParPage,
                                tri: tri,
                                ordre: ordre,
                            },
                            success: function(donnees) {
                                $(retour).empty();
                                $(retour).html(donnees);
                            }
                        });
                    }

                    function getPage(pageNumber, itemsParPage, tri, ordre) {
                        $.ajax({
                            url: url, 
                            type: 'POST',
                            dataType: 'html',
                            data: { 
                                page: pageNumber,
                                itemsParPage: itemsParPage,
                                tri: tri,
                                ordre: ordre,
                            },
                            success: function(donnees) {
                                $(retour).empty();
                                $(retour).html(donnees);
                            }
                        });
                    }

                    $(".page-click").click(function(){
                        var pageNumber = $(this).html();
                        var itemsParPage = <?= isset($donnees["itemsParPage"]) ? $donnees["itemsParPage"] . ";" : "6;" ?>

                        var tri = <?= isset($donnees["triSelected"]) ? "'" . $donnees["triSelected"] . "';" : "0;" ?>

                        var ordre = <?= isset($donnees["ordre"]) ? "'" . $donnees["ordre"] . "';" : "2;" ?>

                        getPage(pageNumber, itemsParPage, tri, ordre);
                    });

                    $(".tri").change(function(){
                        var tri = $(this).val();
                        var ordre = $(this).next().val();
                        var itemsParPage = $(this).next().next().val();
                        // console.log(tri, ordre, itemsParPage);
                        getPage(1, itemsParPage, tri, ordre);
                    });

                    $(".ordre").change(function(){
                        var tri = $(this).prev().val();
                        var ordre = $(this).val();
                        var itemsParPage = $(this).next().val();
                        // console.log(tri, ordre, itemsParPage);
                        getPage(1, itemsParPage, tri, ordre);
                    });

                    $(".itemsParPage").change(function(){
                        var tri = $(this).prev().prev().val();
                        var ordre = $(this).prev().val();
                        var itemsParPage = $(this).val();
                        // console.log(tri, ordre, itemsParPage);
                        getPage(1, itemsParPage, tri, ordre);
                    });

                </script>

