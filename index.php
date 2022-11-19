<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/estilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <title>Listagem de Jogos</title>
</head>
<body>
    <?php
        //chamando e abrindo o banco
        require_once "funcoes/banco.php";
        require_once "funcoes/login.php";
        //chamando a função para caso de fotos indisponiveis
        require_once "funcoes/funcoes.php";
        //criando a variavel para ordenar a busca por categorias
        $ordem = $_GET['o'] ?? "n";
        //criando a variavel para ordenar a busca por categorias no campo pesquisar
        $chave = $_GET['c'] ?? "";
    ?>
    <div id="corpo">
        <?php include_once "topo.php";?>
        <h1>Escolha Seu Jogo</h1>
        <form method="get" id="pesquisa" action="index.php">
        Ordenar: 
        <!--passando parametros para ordenar a buscar por categoria-->
        <a href="index.php?o=n&c=<?php echo $chave; ?>">Nome</a> | 
        <a href="index.php?o=p&c=<?php echo $chave; ?>">Produtora </a>| 
        <a href="index.php?o=n1&c=<?php echo $chave; ?>">Nota Alta</a> | 
        <a href="index.php?o=n2&c=<?php echo $chave; ?>">Nota Baixa</a> | 
        <a href="index.php">Mostrar Todos</a> |
        Pesquisar: <input type="text" name="c" size="10" maxlength="40"/>
            <input type="submit" value="ok"/>
        </form>
        <table class="listagem">
            <?php
               $myQuery = "select j.cod, j.nome, g.genero, p.produtora, j.capa from jogos j join generos g on j.genero = g.cod join produtoras p on j.produtora = p.cod ";
               // busca por categoria passando a chave como parametro
               if(!empty($chave)){
                  $myQuery .= "WHERE j.nome like '%$chave%' OR p.produtora like '%$chave%' OR g.genero like '%$chave%' ";
               }
               //verificando a ordenação da busca por categoria
                switch($ordem){
                    case "p":
                        $myQuery .= "ORDER BY p.produtora";
                        break;
                    case "n1":
                        $myQuery .= "ORDER BY j.nota DESC";
                        break;
                    case "n2":
                        $myQuery .= "ORDER BY j.nota ASC";
                        break;
                    default:
                        $myQuery .= "ORDER BY j.nome";
                        break;
                }
                $busca = $banco->query($myQuery);
                if(!$busca){
                    echo "<tr><td>Erro de busca</tr>";
                } else{
                    if ($busca->num_rows == 0){
                        echo "<tr><td>Nenhum Registro encontrado!";
                    } else {
                        while($reg=$busca->fetch_object()){
                            $indisp = photo($reg->capa); // chamando a funçao para caso de fotos indosponiveis 
                            echo "<tr><td><img src='$indisp'class='foto-mini'/><td><a href='detalhes.php?cod=$reg->cod'>$reg->nome</a> "; //chamando aqui a pagina de detalhes.php onde estao os detalhes dos jogos passando o parametro $reg->cod
                            echo " <br>($reg->genero) ";
                            echo "$reg->produtora";
                            if(admin()){
                                echo "<td>";
                                echo "<span class='material-symbols-outlined'>add_circle</span> ";
                                echo "<span class='material-symbols-outlined'>edit</span> ";
                                echo "<span class='material-symbols-outlined'>delete</span>";
                            } elseif(editor()){
                                echo "<td>";
                                echo "<span class='material-symbols-outlined'>edit</span>";
                             
                            }
                            
                        }
                    }
                }
            ?>
        </table>
    </div>
    <?php include_once "rodape.php";?>
    <!--fechando o banco-->
</body>
</html>
<!--somente ate a criação dos trs e tds junto com seus estilos em css é a primeira parte-->
<!---->
<!--a segunda parte trata-se do script para a ligação com o banco de dados usando o modulo mysqli e fazendo a chamada do funcoes.php/banco
nesta requisição foi usado o REQUIRE_ONCE para que se o arquivo ja tiver sido importado ele não importa novamente
se tivesse sido usado o INCLUDE se por acaso desse erro ele so mostraria um warning e seguiria ao contrario do REQUIRE_ONCE para todo o serviço-->
