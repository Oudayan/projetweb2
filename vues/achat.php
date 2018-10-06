

<!-- navbar -->
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
 
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="productos.php">Sistemas Web</a>
        </div>
 
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php echo $page_title=="Products" ? "class='active'" : ""; ?> >
                    <a href="productos.php">Productos</a>
                </li>
                <li <?php echo $page_title=="Cart" ? "class='active'" : ""; ?> >
                    <a href="carro.php">
                        <?php
                        // query to count all product in cart
                        $query = "SELECT count(*) FROM cart_items WHERE user=1";
 
                        // prepare query statement
                        $stmt = $con->prepare( $query );
 
                        // execute query
                        $stmt->execute();
 
                        // get row value
                        $rows = $stmt->fetch(PDO::FETCH_NUM);
 
                        // return count
                        $cart_count=$rows[0];
                        ?>
                        Carrito <span class="badge" id="comparison-count"><?php echo $cart_count; ?></span>
                    </a>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
 
    </div>
</div>
<!-- /navbar -->
1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
26
27
28
29
30
31
32
33
34
35
36
37
38
39
40
41
42
43
44
45
46
<!-- navbar -->
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
 
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="productos.php">Sistemas Web</a>
        </div>
 
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php echo $page_title=="Products" ? "class='active'" : ""; ?> >
                    <a href="productos.php">Productos</a>
                </li>
                <li <?php echo $page_title=="Cart" ? "class='active'" : ""; ?> >
                    <a href="carro.php">
                        <?php
                        // query to count all product in cart
                        $query = "SELECT count(*) FROM cart_items WHERE user=1";
 
                        // prepare query statement
                        $stmt = $con->prepare( $query );
 
                        // execute query
                        $stmt->execute();
 
                        // get row value
                        $rows = $stmt->fetch(PDO::FETCH_NUM);
 
                        // return count
                        $cart_count=$rows[0];
                        ?>
                        Carrito <span class="badge" id="comparison-count"><?php echo $cart_count; ?></span>
                    </a>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
 
    </div>
</div>
<!-- /navbar -->