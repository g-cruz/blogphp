<div class="left_content">

    <div class="title">Información</div>
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
                <a href="#"><h2><?php echo $article['titulo']; ?></h2></a>
                <p class="details"><?php echo $article['contenido']; ?></p>
                <br />
                <div id="comment-section">
                    <h2 style="color:#943007;">Comentarios</h2>
                    <?php if (!empty($article['comentario'])): ?>
                        <?php foreach ($article['comentario'] as $comment):/* echo $comment['name'] . ' says...'; */ ?>
                            
                            <span>
                                <?php 
                                $date = date('Y-m-d H:i:s', $comment['fecha']->sec);
                                echo strtolower("<b>".$comment['autor']."</b> ".date('d', strtotime($date)) . " de " . _mes($date) . " de " . _anio($date).", ".date('g:i a', $comment['fecha']->sec)); 
                                ?>
                            </span>
                            <p><?php echo $comment['texto']; ?></p>
                            <br/><br/>
                            <?php
                        endforeach;
                    endif;
                    ?>
                            <h3 style="color:#943007;">Publicar un comentario</h3>
                    <form action="comment.php" method="post">
                        <span class="input-label">Autor</span>
                        <br />
                        <input type="text" name="autor" class="comment-input" style="width: 80%;" />
                        <br />
                        <textarea name="texto" rows="5" style="width: 80%;"></textarea><br/><br/>
                        <input type="hidden" name="articulo_id" value="<?php echo $article['_id']; ?>"/>
                        <input type="submit" name="btn_submit" value="Publicar"/>
                    </form>
                    <br />
                </div>
                <div class="clear"></div>
            </div>

            <div class="box_bottom"></div>
        </div>    
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>