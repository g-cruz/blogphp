<?php

$id = $_POST['articulo_id'];

try{
    
    $mongodb = new Mongo();
    $articleCollection = $mongodb->blogphp->articulo;

} catch (MongoConnectionException $e) {
    
    die('Failed to connect to MongoDB '.$e->getMessage());
}

$article = $articleCollection->findOne(array('_id' => new MongoId($id)));

$comments = (isset($article['comentario'])) ? $article['comentario'] : array();

$comment = array(
                    /*'name' => $_POST['commenter_name'], 
                    'email' => $_POST['commenter_email'],*/
                    'texto' => $_POST['texto'],
                    'fecha' => new MongoDate()
                );
                
array_push($comments, $comment);

$articleCollection->update(array('_id' => new MongoId($id)), array('$set' => array('comentario' => $comments)));

header('Location: blog.php?id='.$id);

/* Consultar documento embebido por el método de subobjetos.
 * $usuarios->find(array('direccion' => array('ciudad' => 'Alcamuz', 'provincia' => 'Murcia'))) ;
 */

/*
 * Consultar documento embebido mediante notación dot
 * $usuarios->find(array(‘direccion.provincia' => ‘Murcia'));
 */