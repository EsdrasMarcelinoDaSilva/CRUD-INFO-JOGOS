<?php
 //CRIANDO VARIAVEL DE SESSÃO PARA PAGINA DE topo.php 
 //neste CRUD ao inves de usar variavéis de sessão poderia ter usado (cookies) 
session_start();

if(!isset($_SESSION['usuario'])) {
    $_SESSION['usuario'] = "";
    $_SESSION['nome'] = "";
    $_SESSION['tipo'] = "";
}   

function logado(){
    if(empty($_SESSION['usuario'])){
        return false;
    } else{
        return true;
    }
}

function logout(){
    unset($_SESSION['usuario']);
    unset($_SESSION['nome']);
    unset($_SESSION['tipo']);
}

function admin(){
    $tipo = $_SESSION['tipo'] ?? null;
    if(is_null($tipo)){
        return false;
    } else{
        if($tipo == 'admin'){
            return true;
        } else{
            return false;
        }
        
    }
}

function editor(){
    $tipo = $_SESSION['tipo'] ?? null;
    if(is_null($tipo)){
        return false;
    }  else{
        if($tipo == 'editor'){
            return true;
        } else{
            return false;
        }
        
    }
}

function gerarHash($senha){
    $txt = cripto($senha);
    $hash = password_hash($txt, PASSWORD_DEFAULT);
    return $hash;
}

function cripto($senha){
    $c = '';
    for($pos = 0; $pos < strlen($senha); $pos++ ){
        $letra = ord($senha[$pos]) + 1;
        $c .= chr($letra);
    }
    return $c;
}

function testarHash($senha, $hash){
    $ok = password_verify($senha, $hash);
    return $ok;
}
//gerando hash, criptografando e testando se corresponde
/*$original = 'ems';
echo "$original ---";
echo cripto($original)."---";
echo gerarHash($original);
echo testarHash('fnt', '$2y$10$qUFONERKNDSYhXVDSvNhPu9.Uxx9YI1TlGTBiZKprViYRJ31dkrkm')?" sim ":" não ";*/  
?>