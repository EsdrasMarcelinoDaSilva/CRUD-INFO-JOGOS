<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/estilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <title>Login de Usuário</title>
    <style>
        div#corpo{
            border: none;
            width: 270px;
            font-size: 15pt;
        }
        td{
            padding: 10px;
        }
        #botao{
            height: 30px;
            background-color:#87cefa;
            border-radius: 15px;
        }
    </style>
</head>
<body>
    <?php
        require_once "funcoes/banco.php";
        require_once "funcoes/funcoes.php";
        require_once "funcoes/login.php";
    ?>    
    <div id="corpo">
        <!--buscando dados do formulário user-login-form.php-->
        <?php
            $u = $_POST['usuario'] ?? null;
            $s = $_POST['senha'] ?? null;

            if (is_null($u) || is_null($s)){
                require "user-login-form.php";
            } else{
                $myQuery = "SELECT usuario, nome, senha, tipo FROM usuarios WHERE usuario = '$u' LIMIT 1";
                $busca = $banco->query($myQuery);
                if(!$busca){
                    echo msg_erro('Falha ao acessar o banco!');
                } else{
                    if($busca->num_rows > 0){
                        $registro = $busca->fetch_object();
                        if(testarHash($s, $registro->senha)){
                            echo msg_sucesso('Logado com Sucesso');
                            $_SESSION['usuario'] = $registro->usuario;
                            $_SESSION['nome'] = $registro->nome; 
                            $_SESSION['tipo'] = $registro->tipo;
                        } else{
                            echo msg_erro('Senha Inválida!');
                        }
                    } else{
                        echo msg_erro('Usuário não existe!');
                    }
                }
            }
            echo voltar();
        ?>
    </div>

</body>
</html>