<?php
try {
    $connection = new Mongo();
    $database = $connection->selectDB('blogphp');
    $collection = $database->selectCollection('articulo');
} catch (MongoConnectionException $e) {
    die("Fallo en la conexión a la base de datos " . $e->getMessage());
}
$cursor = $collection->find();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="style.css" />
        <title>Blog Artistas</title>
    </head>
    <body>
        <div id="contentarea">
            <div id="innercontentarea">
                <h1>Artistas Blog</h1>
                <?php
                while ($cursor->hasNext()):
                    $article = $cursor->getNext();
                    ?>
                    <h2><?php echo $article['titulo']; ?></h2>
                    <p>
    <?php echo substr($article['contenido'], 0, 200) . '...'; ?>
                    </p>
                    <a href="blog.php?id=<?php echo $article['_id']; ?>">M&aacute;s informaci&oacute;n »</a>
<?php endwhile; ?>
                <br /><br /><br />
            </div>
        </div>
    </body>
</html>

<?php
/* Ejemplo de consulta en el shell de Mongo que obtiene todos los documentos de
 * una colección llamada peliculas que tienen su campo genero configurado como
 * aventura:
 * >db.peliculas.find({"genero":"aventura"})
  { "_id" : ObjectId("4db439153ec7b6fd1c9093ec"), "nombre" : "guardianes de la noche", "genero" : "aventura", "año" : 2009 }
 */
?>