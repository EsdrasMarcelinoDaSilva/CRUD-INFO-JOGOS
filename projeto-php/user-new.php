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
    <title>Cadastro Novo Usuário</title>
</head>
<body>
    <div id="corpo">
        <?php
            if(!admin()){
                echo msg_erro('Area Restrita! Voce não é Administrador!');
            } else{
                if(!isset($_POST['usuario'])){
                    require "user-new-form.php";
                } else{
                    $usuario = $_POST['usuario'] ?? null;
                    $nome = $_POST['nome'] ?? null;
                    $senha1 = $_POST['senha1'] ?? null;
                    $senha2 = $_POST['senha2'] ?? null;
                    $tipo = $_POST['tipo'] ?? null; 

                    if($senha1 === $senha2){
                        if(empty($usuario) || empty($nome) || empty($senha1) || empty($senha2) || empty($tipo)){
                            echo msg_aviso("Todos os Campos são Obrigatórios!");
                        } else{
                            $senha = gerarHash($senha1);
                            $myQuery = "INSERT INTO usuarios (usuario, nome, senha, tipo) VALUES ('$usuario', '$nome', '$senha', '$tipo')";
                            if($banco->query($myQuery)){
                                echo msg_sucesso("Usuário $nome Cadastrado com Sucesso!");
                            } else{
                                echo msg_erro("Não foi possivel criar o Usuário $usuario. Talvez o login ja esteja sendo usado.");
                            }                     
                        }
                    }else {
                        echo msg_aviso("Senhas não conferem. Repita o procedimento.");
                    }
                }
            }
            echo voltar();
        ?>
    </div>
</body>
</html>