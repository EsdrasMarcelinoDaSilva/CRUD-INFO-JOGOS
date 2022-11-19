<!--criado o link de entrar pegando as variaveis de sessão declaradas em login-->
<?php 
    echo "<p class='pequeno'>";
    if(empty($_SESSION['usuario'])){
        echo "<a href='user-login.php'>Entrar</a>";
    } else{
        echo "Olá, <strong>" . $_SESSION['nome'] . "</strong> | ";
        echo "<a href='user-edit.php'>Meus Dados</a> | ";
        if(admin()){
            echo "<a href='user-new.php'>Novo Usuário</a> | ";
            echo "Novo Jogo | ";
        }
        echo " <a href='user-logout.php'>Sair</a>";
    }   
    echo "</p>";
?>