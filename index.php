<?php
require('session.php');
require('user.php');

$user = new User();

if (!$user->isLoggedIn()){
    header('location: login.php');
    exit;
}

try {
    $connection = new Mongo();
    $database = $connection->selectDB('blogphp');
    $collection = $database->selectCollection('articulo');
} catch (MongoConnectionException $e) {
    die("Fallo en la conexión a la base de datos " . $e->getMessage());
}
$cursor = $collection->find();
$cursor2 = $collection->group(
        array("anio" => 1),
        array("items" => array()),
        "function (obj, prev) { prev.items.push(obj.name); }"
        );
$count=$cursor->count();
$cursor->sort(array('fecha'=> -1));
//$cursor2->sort(array('fecha'=> -1));

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
                    <?php if($user->tipo === 'admin'){?>
                        <li><a href="blogpost.php">Crear Entrada</a></li>
                        <li><a href="dashboard.php">Ver Entradas</a></li>
                    <?php } ?>
                    <li><a href="logout.php">Cerrar Sesión</a></li
                </ul>
                <span style="margin-top: 20px;margin-right: 520px; float: right;"><b><?php echo $user->nombre; ?></b></span>
            </div>
        </div><!-- END MENU -->
        
        <div class="center_content">
            <?php
            include 'contenido/cont-izquierda.php';
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