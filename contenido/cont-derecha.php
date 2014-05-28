<script type="text/javascript">
    function SINO(cual) {
       // alert(cual);
        var elElemento = document.getElementById(cual);
        if (elElemento.style.display == '') {
            elElemento.style.display = 'none';
            $("#tria_"+cual).html("►");
        } else {
            elElemento.style.display = '';
            $("#tria_"+cual).html("▼");
        }
    }
</script> 
<div class="right_content">

    <div class="anuncio">
        <h3 style="color:#943007;">Artistas Musicales</h3>
        <hr>
        <p>Este blog esta orientado a tratar temas de artistas musicales.</p>
    </div>
<?php if($count > 0){?>
    <div class="anuncio">
        <h3 style="color:#943007;">Archivo del Blog</h3>
        <hr>     
        <?php
        //var_dump($cursor2['retval'][0]);
        //foreach ($cursor2['retval'] as $value) {
            /*$arti = $cursor2->getNext();
            $fecha = date('Y-m-d H:i:s', $arti['fecha']->sec);
             * */
        ?>
        
        <div>
            <h4 style="cursor:pointer;" onclick="SINO(2014);"><span id="tria_2014">►</span> 2014</h4>
            <div style="display:none;" id="2014">
                <ul>
                    <li>
                        <h4 style="cursor:pointer;" onclick="SINO('abril');"><span id="tria_abril">►</span> abril</h4>
                        <div style="display:none;" id="abril">
                            <ul>
                                <li>Entrada 6</li>
                                <li>Entrada 5</li>
                                <li>Entrada 4</li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <h4 style="cursor:pointer;" onclick="SINO('marzo');"><span id="tria_marzo">►</span> marzo</h4>
                        <div style="display:none;" id="marzo">
                            <ul>
                                <li>Entrada 5</li>
                                <li>Entrada 4</li>
                                <li>Entrada 3</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        
        <div>
            <h4 style="cursor:pointer;" onclick="SINO(2012);"><span id="tria_2012">►</span> 2012</h4>
            <div style="display:none;" id="2012">
                <ul>
                    <li>Entrada 2</li>
                    <li>Entrada 1</li>
                </ul>
            </div>
        </div>
        <?php /* } */?>   
    </div>
<?php }?>
</div><!--end of right content-->