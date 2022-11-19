<!--criada para caso as imagens não estejam disponiveis -->
<?php
    function photo ($arq){
        $thumb = "fotos/$arq";
        if(is_null($arq) || (!file_exists($thumb))){
            return "fotos/indisponivel.png";
        } else{
            return $thumb;
        }
    }

    function voltar(){
        return  "<a href='index.php'><span class='material-symbols-outlined'>arrow_back</span></a>";
    }
    function msg_sucesso($m){
        $resp = "<div class='sucesso'><span class='material-symbols-outlined'>check_circle</span> $m</div>";
        return $resp;
    }
    function msg_aviso($m){
        $resp = "<div class='aviso'><span class='material-symbols-outlined'>info</span> $m</div>";
        return $resp;
    }
    function msg_erro($m){
        $resp = "<div class='erro'><span class='material-symbols-outlined'>error</span> $m</div>";
        return $resp;
    }
?>