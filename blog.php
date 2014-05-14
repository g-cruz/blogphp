<?php
$id = $_GET['id'];
try {
    $connection = new Mongo();
    $database = $connection->selectDB('blogphp');
    $collection = $database->selectCollection('articulo');
} catch (MongoConnectionException $e) {
    die("Failed to connect to database " . $e->getMessage());
}
$article = $collection->findOne(array('_id' => new MongoId($id)));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="style.css" />
        <title>Mi Blog</title>
    </head>
    <body>
        <div id="contentarea">
            <div id="innercontentarea">
                <h1><?php echo $article['titulo']; ?></h1>
                <p><?php echo $article['contenido']; ?></p>
                <div id="comment-section">
                    <h2>Commentarios</h2>
                    <?php if (!empty($article['comentario'])): ?>
                        <h3>Comments</h3>
                        <?php foreach ($article['comentario'] as $comment):/* echo $comment['name'] . ' says...'; */?>
                            <p><?php echo $comment['texto']; ?></p>
                            <span>
                                <?php echo date('g:i a, F j', $comment['fecha']->sec); ?>
                            </span><br/><br/><br/>
                        <?php endforeach;
                    endif;
                    ?>
                    <h3>Publica tu comentario</h3>
                    <form action="comment.php" method="post">
<!--                        <span class="input-label">Nombre</span>
                        <input type="text" name="commenter_name" class="comment-input"/>
                        <br/><br/>
                        <span class="input-label">Email</span>
                        <input type="text" name="commenter_email" class="comment-input"/>
                        <br/><br/>-->
                        <textarea name="texto" rows="5"></textarea><br/><br/>
                        <input type="hidden" name="articulo_id" value="<?php echo $article['_id']; ?>"/>
                        <input type="submit" name="btn_submit" value="Salvar"/>
                    </form>
                    <br />
                </div>
            </div>
        </div>
    </body>
</html>
