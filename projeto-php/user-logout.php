<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/estilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <title>Desconexão</title>
</head>
<body>
    <?php
        require_once "funcoes/banco.php";
        require_once "funcoes/funcoes.php";
        require_once "funcoes/login.php";
    ?>    
    <div id="corpo">
        <?php
            logout();
            echo msg_sucesso('Usuário desconectado com sucesso');
            echo voltar();
        ?>
    </div>

</body>
</html>