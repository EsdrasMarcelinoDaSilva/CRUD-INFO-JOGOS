<?php 
    $banco = new mysqli("127.0.0.1", "root", "", "bd_games");
        if($banco-> connect_errno){
            echo "<p>Encontrei um erro $banco->errno --> $banco->connect_error</p>";
            die();
        }

?>
<!--essa é a segunda parte do codigo-->