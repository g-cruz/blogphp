<script type="text/javascript">
    function SINO(cual) {
        var elElemento = document.getElementById(cual);
        if (elElemento.style.display == '') {
            elElemento.style.display = 'none';
        } else {
            elElemento.style.display = '';
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
            <h4 style="cursor:pointer;" onclick="SINO(2013);">► 2013</h4>
            <div style="display:none;" id="2013">
                <ol>
                    <li>ddkdkf kfkmg</li>
                    <li>kckjf kfjf</li>
                </ol>
            </div>
        </div>
        <div>
            <h4 style="cursor:pointer;" onclick="SINO(2012);">► 2012</h4>
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