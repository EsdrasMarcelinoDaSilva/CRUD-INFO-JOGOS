<?php
    echo "<footer>";
    echo "<p>Acessado por". $_SERVER['REMOTE_ADDR']. " em " . date('d/M/y')."</p>";
    echo "<p>Desenvolvido pro Esdras Marcelino da Silva &copy; 2022</p>";
    echo "</footer>";
    $banco->close();
?>