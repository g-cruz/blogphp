<?php
include './utilidades/util.php';
$id = $_GET['id'];
try {
    $connection = new Mongo();
    $database = $connection->selectDB('blogphp');
    $collection = $database->selectCollection('articulo');
} catch (MongoConnectionException $e) {
    die("Failed to connect to database " . $e->getMessage());
}
$cursor = $collection->find();
$count=$cursor->count();
$article = $collection->findOne(array('_id' => new MongoId($id)));
?>
<?php
include 'comunes/head.php';
?>
<body>
    <div id="wrap">
        <!-- MENU -->
        <div class="header">
            <div class="logo"><a href="index.php"><img src="images/logo.gif" alt="" title="" border="0" /></a></div>            
            <div style="margin-right: 20px;float: right;"><img src="images/icon2_h.png" alt="" title="" border="0" /></div>
            <div id="menu">
                <ul>                                                                       
                    <li class="selected"><a href="index.php">Inicio</a></li>
                    <li><a href="#">Musica</a></li>
                </ul>
            </div>
        </div><!-- END MENU -->
        <div class="center_content">
            <?php
            include 'contenido/entrada.php';
            include 'contenido/cont-derecha.php';
            ?>
            <div class="clear"></div>
        </div><!--end of center content-->
        <?php
        include 'comunes/footer.php';
        ?>

    </div>
</body>
</html>