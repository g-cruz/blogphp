<script type="text/javascript">
    function SINO(cual) {
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
        <div>
            <h4 style="cursor:pointer;" onclick="SINO(2013);"><span id="tria_2013">►</span> 2013</h4>
            <div style="display:none;" id="2013">
                <ul>
                    <li>
                        <h4 style="cursor:pointer;" onclick="SINO('abril');"><span id="tria_abril">►</span> abril</h4>
                        <div style="display:none;" id="abril">
                            <ul>
                                <li><a href="#">Ola mundo</a></li>
                                <li>Ola mundo 2</li>
                                <li>Ola mundo 3</li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <h4 style="cursor:pointer;" onclick="SINO('marzo');"><span id="tria_marzo">►</span> marzo</h4>
                        <div style="display:none;" id="marzo">
                            <ul>
                                <li>Ola mundo</li>
                                <li>Ola mundo 2</li>
                                <li>Ola mundo 3</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div>
            <h4 style="cursor:pointer;" onclick="SINO(2012);"><span id="tria">►</span> 2012</h4>
            <div style="display:none;" id="2012">
                <ol>
                    <li>ddkdkf kfkmg</li>
                    <li>kckjf kfjf</li>
                </ol>
            </div>
        </div>
    </div>
<?php }?>
</div><!--end of right content-->