<div class="left_content">

    <div class="title">Publicaciones</div>

    <?php
    while ($cursor->hasNext()):
        $article = $cursor->getNext();
        ?>
        <div class="feat_prod_box">

            <div class="prod_det_box">
                <div class="box_top"></div>
                <div class="box_center">
                    <div class="prod_title">
                        <?php
                        $date = date('Y-m-d H:i:s', $article['fecha']->sec);
                        echo strtoupper(_diaN($date) . ", " . date('d', strtotime($date)) . " de " . _mes($date) . " de " . _anio($date));
                        ?>
                    </div>
                    <hr>
                    <a href="./post.php?id=<?php echo $article['_id']; ?>"><h2><?php echo $article['titulo']; ?></h2></a>
                    <p class="details"><?php echo substr($article['contenido'], 0, 200) . '...'; ?></p>
                    <a href="./post.php?id=<?php echo $article['_id']; ?>" class="more">Más información »</a>
                    <div class="clear"></div>
                </div>

                <div class="box_bottom"></div>
            </div>    
            <div class="clear"></div>
        </div>	
    <?php endwhile; ?>   

    <div class="clear"></div>
</div><!--end of left content-->