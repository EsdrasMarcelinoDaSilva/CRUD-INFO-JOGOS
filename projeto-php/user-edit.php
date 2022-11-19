<!DOCTYPE html>
<?php
require_once "funcoes/banco.php";
require_once "funcoes/funcoes.php";
require_once "funcoes/login.php";
?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/estilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <title>Edição de Dados do Usuário</title>
</head>

<body>
    <div id="corpo">
        <?php
        if (!logado()) {
            echo msg_aviso('Efetue o <a href="user-login.php">login</a> com seus Dados!');
        } else {
            if (!isset($_POST['usuario'])) {
                include "user-edit-form.php";
            } else {
                $usuario = $_POST['usuario'] ?? null;
                $nome = $_POST['nome'] ?? null;
                $tipo = $_POST['tipo'] ?? null;
                $senha1 = $_POST['senha1'] ?? null;
                $senha2 = $_POST['senha2'] ?? null;

                $myquery = "update usuarios set usuario = '$usuario', nome = '$nome'";

                if (empty($senha1) || is_null($senha1)) {
                    echo msg_aviso("Senha antiga Mantida.");
                } else {
                    if ($senha1 === $senha2) {
                        $senha = gerarHash($senha1);
                        $myquery .= ", senha='$senha'";
                    } else {
                        echo msg_erro("Senhas não conferem. Senha Anterior sera mantida.");
                    }
                }

                $myquery .= " where usuario = '" . $_SESSION['usuario'] . "'";

                if ($banco->query($myquery)){
                    echo msg_sucesso("Usuário alterado com Sucesso!");
                    logout();
                    echo msg_aviso("Por segurança, efetue o <a href='user-login.php'>login</a> novamente");
                } else{
                    echo msg_erro("Não foi possivel alterar os dados.");
                }
            }
        }
        echo voltar();
        ?>
    </div>
</body>

</html>