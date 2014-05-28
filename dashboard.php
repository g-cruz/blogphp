<?php
try {
    $mongodb = new Mongo();
    $articleCollection = $mongodb->blogphp->articulo;
} catch (MongoConnectionException $e) {
    die('No se ha podido conectar a MongoDB ' . $e->getMessage());
}
$currentPage = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
$articlesPerPage = 5; //número de artículos a mostrar por página
$skip = ($currentPage - 1) * $articlesPerPage;
$cursor = $articleCollection->find(array(), $fields = array('titulo', 'fecha'));
$totalArticles = $cursor->count();
$totalPages = (int) ceil($totalArticles / $articlesPerPage);
$cursor->sort(array('fecha' => -1))->skip($skip)->limit($articlesPerPage);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Blog Artista</title>
        <link rel="stylesheet" type="text/css" href="css/style2.css" />
        <link rel="shortcut icon" href="css/images/artista.png" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <style type="text/css" media="screen">
            body { font-size: 13px; }
            div#contentarea { width : 650px; }
        </style>
        <script type="text/javascript" charset="utf-8">
            function confirmDelete(articleId) {
                var deleteArticle = confirm('¿Estás seguro que quieres borrar este artículo?');
                if(deleteArticle){
                    window.location.href = 'delete.php?id='+articleId;
                }
                return;
            }
        </script>
    </head>
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
                <h1>Entradas</h1>
                <table class="articles" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th width="50%">Título</th>
                            <th width="24%">Salvado el</th>
                            <th width="*">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($cursor->hasNext()): $article = $cursor->getNext(); ?>
                            <tr>
                                <td>
                                    <?php echo substr($article['titulo'], 0, 35) . '...'; ?>
                                </td>
                                <td>
                                    <?php print date('g:i a, F j', $article['fecha']->sec); ?>
                                </td>
                                <td>
<!--                                    <a href="blog.php?id=<?php //echo $article['_id']; ?>">
                                        Ver
                                    </a>-->
                                    | <a href="edit.php?id=<?php echo $article['_id']; ?>">
                                        Editar
                                    </a>
                                    | <a href="#" onclick="confirmDelete('<?php echo $article['_id']; ?>')">
                                        Borrar
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                
            </div>
            <div id="navigation">
                <div class="prev">
                    <?php if ($currentPage !== 1): ?>
                        <a href="<?php echo $_SERVER['PHP_SELF'] . '?page=' . ($currentPage - 1); ?>">
                            Previous</a>
                    <?php endif; ?>
                </div>
                <div class="page-number">
                    <?php echo $currentPage; ?>
                </div>
                <div class="next">
                    <?php if ($currentPage !== $totalPages): ?>
                        <a href="<?php echo $_SERVER['PHP_SELF'] . '?page=' . ($currentPage + 1); ?>">
                            Next
                        </a>
                    <?php endif; ?>
                </div>
                <br class="clear"/>
            </div>
            <br />
        </div>

            <div class="clear"></div>
        </div><!--end of center content-->

        <?php
        include 'comunes/footer.php';
        ?>
    </div>
</body> 
</html>

