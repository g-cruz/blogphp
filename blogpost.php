<?php
require('session.php');
require('user.php');

$user = new User();

if (!$user->isLoggedIn()){
    header('location: login.php');
    exit;
}

include './utilidades/util.php';
$action = (!empty($_POST['btn_submit']) && ($_POST['btn_submit'] === 'Salvar')) ? 'save_article' : 'show_form';
switch ($action) {
    case 'save_article':
        try {
            $connection = new Mongo();
            $database = $connection->selectDB('blogphp');
            $collection = $database->selectCollection('articulo');
             /* método alternativo de selección base datos colección:
             * $connection = new Mongo();
             * $collection = $connection->miblog->articles;
             */
            $article = array();
            $article['titulo'] = $_POST['titulo'];
            $article['contenido'] = $_POST['contenido'];
            $article['fecha'] = new MongoDate();
            //$article['fecha'] = new MongoDate(strtotime("2013-01-15 00:00:00"));
            
            $vfecha = date('Y-m-d H:i:s', $article['fecha']->sec);
            $article['anio'] = _anio($vfecha);
            $article['mes'] = _mes($vfecha);
            $article['dia'] = _diaN($vfecha);
            
            //$article['estado'] = 1;
            
            $collection->insert($article);
        } catch (MongoConnectionException $e) {
            die("No se ha podido conectar a la base de datos " . $e->getMessage());
        } catch (MongoException $e) {
            die('No se han podido insertar los datos ' . $e->getMessage());
        }
        /*código alternativo si queremos que el método insert espere resputesta de MongoDB:
         * try {
         * $status = $connection->insert(array('title' => 'Titulo Blog', 'content' => 'Contenido Blog'), array('safe' => True));
         * echo "Operación de inserción completada";
         * } catch (MongoCursorException $e) {
         * die("Insert ha fallado ".$e->getMessage());
         * }
         */
        
         /* Cuando hacemos un insert 'safe' podemos utilizar un parámetro timeout opcional:
         * try {
         * $collection->insert($document, array('safe' => True, 'timeout' => True));
         * } catch (MongoCursorTimeoutException $e) {
         * die('El tiempo de espera para Insert ha finalizado '.$e->getMessage());
         */
        
         /* Podemos añadir un _id personalizado con un insert:
          * $username = 'Juan';
          * try{
          * $document = array('_id' => hash('sha1', $username.time()),
          * 'user' => $username, 'visited' => 'homepage.php');
          * $collection->insert($document, array('safe' => True));
          * } catch(MongoCursorException $e) {
          * die('Failed to insert '.$e->getMessage());
          * }
          */
        break;
    case 'show_form':
    default:
}
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
                    <li class="selected"><a href="blogpost.php">Crear Entrada</a></li>
                    <li><a href="dashboard.php">Ver Entradas</a></li>
                    <li><a href="logout.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div><!-- END MENU -->
        
        <div class="center_content">
             <div id="contentarea">
            <div id="innercontentarea">
                <h1>Crear Entrada</h1>
                <?php if ($action === 'show_form'): ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <h3>T&iacute;tulo</h3>
                        <p>
                            <input type="text" name="titulo" id="titulo" />
                        </p>
                        <h3>Contenido</h3>
                        <textarea name="contenido" rows="16"></textarea>
                        <p>
                            <input type="submit" name="btn_submit" value="Salvar"/>
                        </p>
                    </form>
                <?php else: ?>
                    <p>
                        Art&iacute;culo salvado.
                        <a href="blogpost.php"> &iquest;Escribir otro?</a>
                    </p>
                <?php endif; ?>
                <br />
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