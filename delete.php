<?php
require('session.php');
require('user.php');

$user = new User();

if (!$user->isLoggedIn()){
    header('location: login.php');
    exit;
}

$id = $_GET['id'];
try {
    $mongodb = new Mongo();
    $articleCollection = $mongodb->blogphp->articulo;
} catch (MongoConnectionException $e) {
    die('No se ha podido conectar a MongoDB ' . $e->getMessage());
}
$articleCollection->remove(array('_id' => new MongoId($id)));
/*borrar documento(s) de la coleccion peliculas en la que el genero es drama
 * $peliculas->remove(array('genero' => 'drama') );
 */
/* Argumento opcional safe, configurado a true el control del programa espera por una respuesta de la base de datos.
 * $collection->remove(array(‘nombreusuario' => 'juan'), array('safe' => True))
 */

/*Argumento opcional timeout. Configurar un tiempo de espera máximo para la acción de borrado
 * $collection->remove(array('userid' => 267), array('safe' => True, 'timeout' => 200)); 
 */

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
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="blogpost.php">Crear Entrada</a></li>
                    <li class="selected"><a href="dashboard.php">Ver Entradas</a></li>
                </ul>
            </div>
        </div><!-- END MENU -->
        
        <div class="center_content">
            <div id="contentarea">
            <div id="innercontentarea">
                <h1>Eliminando Entrada Blog</h1>
                <p>Artículo Borrado.
                    <a href="dashboard.php">¿Volver a Ver Entradas?</a>
                </p>
            </div>
        </div>

            <div class="clear"></div>
        </div><!--end of center content-->

        <?php
        include 'comunes/footer.php';
        ?>
    </div>
</body>
</html>
