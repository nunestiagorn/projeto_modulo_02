<?php

/* Projeto Módulo 2
*/
/*
function deslogar(){
}

function cadastrarVenda(){

}

function registrarLog(){

}

function verificarLog(){

}

*/


/* Uma array associativo para armazenar o nome como 
chave para outro array que armazena as informações senha e cargo
usuário: admin e senha:123123

*/

$usuario [0] = 123123;
$usuario [1] = "Administrador";
$usuarioAtivo = null;

$usuarios["admin"] = $usuario;


function cadastrarUsuario($nome, $senha, $cargo){
    global $usuarios;
    $usuario [0] = $senha;
    $usuario [1] = $cargo;
    $usuarios[$nome] = $usuario;
}

function logar($usuario, $senha){
    global $usuarios;
    if($usuarios[$usuario][0] == $senha ){
        echo "O usuário $usuario foi logado com sucesso! \n";
        return $usuario;
    }
    else{
        echo "Usuário ou senha incorretos \n";
    }
}

/*  Teste de cadastro de usuário 
cadastrarUsuario("Tiago", 121212, "Teste");
print_r($usuarios); */


while(true){

    echo "1 - Logar\n";
    echo "0 - Sair \n";
    $num = readline();
    
    switch($num){
        case 0:
            die();
        case 1:
            echo "Digite o usuário: ";
            $usuario = readline();
            echo "Digite a senha: ";
            $senha = readline();
            $usuarioAtivo = logar($usuario, $senha);
            system('clear');
        default:
            break;
    }
    while($usuarioAtivo != null){
        echo "1 - Vender \n";
        echo "2 - Cadastrar novo usuário \n";
        echo "3 - Cadastrar novo produto \n"; 
        echo "4 - Verificar Log \n";
        echo "5 - Deslogar \n";
        die();
    }
}














