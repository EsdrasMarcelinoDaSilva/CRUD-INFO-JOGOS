<!--aqui é a pagina de detalhes do jogo-->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/estilo.css">
    <!--buscando icone do google-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <title>Detalhes</title>
</head>
<body>
    <?php
        require_once "funcoes/banco.php";
        require_once "funcoes/funcoes.php";
        require_once "funcoes/login.php";
    ?>    
    <div id="corpo">
        <?php include_once "topo.php";?>
       <!--fazendo a busca do codigo do jogo na url-->
        <?php
            $codigo = $_GET['cod'] ?? 0;
            $busca = $banco->query("select * from jogos where cod='$codigo'");
        ?>
        <!---->
        <h1>Detalhes Do Jogo</h1>
        <table id="detalhes">
            <!--verificando se a busca ocorreu-->
            <?php
                if(!$busca){
                    echo "<tr><td>Busca falhou";
                } else{
                    if($busca->num_rows == 1){
                        $reg = $busca->fetch_object();
                        $foto = photo($reg->capa);
                        echo "<tr><td rowspan='3'><img src='$foto'class='full'/>"; // criando o objeto $foto para receber a função photo com parametro da capa que é a imagem de cada jogo
                        echo "<td><h2>$reg->nome</h2>";
                        echo "Nota:".number_format($reg->nota, 1). "/10.0";
                        //edição do jogo para usuario tipo
                        if(admin()){
                            echo " <span class='material-symbols-outlined'>add_circle</span> ";
                            echo " <span class='material-symbols-outlined'>edit</span> ";
                            echo " <span class='material-symbols-outlined'>delete</span> ";
                        } elseif(editor()){
                            echo " <span class='material-symbols-outlined'>edit</span> ";
                        }
                        //--------------------------------
                        echo "<tr><td>$reg->descricao";
                    } else{
                        echo "<tr><td>Nenhum registro encontrado!";
                    }
                }
            ?>
        </table>
        <!--inserindo icone do google-->
       <?php echo voltar() ?>
    </div>
    <?php include_once "rodape.php";?>
</body>
</html>