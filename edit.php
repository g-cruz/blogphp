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
$id = $_REQUEST['id'];
try {
    $mongodb = new Mongo();
    $articleCollection = $mongodb->blogphp->articulo;
} catch (MongoConnectionException $e) {
    die('Failed to connect to MongoDB ' . $e->getMessage());
}
switch ($action) {
    case 'save_article':
        $article = array();
        $article['titulo'] = $_POST['titulo'];
        $article['contenido'] = $_POST['contenido'];
        $article['fecha'] = new MongoDate();
        
        $vfecha = date('Y-m-d H:i:s', $article['fecha']->sec);
        $article['anio'] = _anio($vfecha);
        $article['mes'] = _mes($vfecha);
        $article['dia'] = _diaN($vfecha);
        $articleCollection->update(array('_id' => new MongoId($id)), $article);
        /* argumentos opcionales:
         * $collection->update($criteria, $newobj, array('safe' => True));
         * $collection->update($criteria, $newobj, array('multiple' => True));
         * $collection->update($criteria, $newobj, array('safe => True, 'timeout' => 100));
         */
        
        /*Uso del flag upsert
         * $users->update(array('email' => 'jesus@illasaron.com'), 
         * array('nombre' => 'Jesus', 'apellidos'=> 'Conde'),
         * array('upsert' => True));
         */
        
        /*$document = array('nombre' => 'Alberto Calero', 'edad' => 27);
          $collection->save($document); //inserta el objeto
          $document['edad'] = 31;
          $collection->save($document); //actualiza el objeto       
         */
        
        /*uso del modificador $set para modificar un campo específico del documento
         * $articles->update(array('_id' => MongoId('4dcd2abe5981')), 
         * array('$set' => array('title' => 'Nuevo Title')));
         */
        
        /* uso del modificador $inc para guardar la información sobre el número de veces que un documentos ha sido modificado
         * $articles->update(array('_id' => MongoId('4dcd2abe5981')), 
         * array('$set' => array('content' => 'Nuevo Contenido'),
         * '$inc' => array('update_count' => 1)));
         */

        break;
    case 'show_form':
    default:
        $article = $articleCollection->findOne(array('_id' => new MongoId($id)));
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
                    <li ><a href="index.php">Inicio</a></li>
                    <li><a href="blogpost.php">Crear Entrada</a></li>
                    <li class="selected"><a href="dashboard.php">Ver Entradas</a></li>
                    <li><a href="logout.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div><!-- END MENU -->
        
        <div class="center_content">
            <div id="contentarea">
            <div id="innercontentarea">
                <h1>Editar Entrada</h1>
                <?php if ($action === 'show_form'): ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <h3>Título</h3>
                        <p><input type="text" name="titulo" id="titulo" value="<?php echo $article['titulo']; ?>"/></p>
                        <h3>Contenido</h3>
                        <textarea name="contenido" rows="16">
                            <?php echo $article['contenido']; ?>
                        </textarea>
                        <input type="hidden" name="id" value="<?php echo $article['_id']; ?>" />
                        <p>
                            <input type="submit" name="btn_submit" value="Salvar"/>
                        </p>
                    </form>
                <?php else: ?>
                    <p>
                        Articulo salvado.
                        <a href="post.php?id=<?php echo $id; ?>">
                            Leer Entrada.
                        </a>
                    </p>
                <?php endif; ?>
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