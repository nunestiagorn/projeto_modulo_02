<?php

/* Projeto Módulo 2
*/
/*
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
    if(array_key_exists($nome, $usuarios)){
        echo "O usuário já existe, tente novamente! \n";
    }
    else{
    $usuario [0] = $senha;
    $usuario [1] = $cargo;
    $usuarios[$nome] = $usuario;

    print_r($usuarios);
    }
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
    $escolha1 = readline();
    
    switch($escolha1){
        case 0:
            die();
        case 1:
            echo "Digite o usuário: ";
            $usuario = readline();
            echo "Digite a senha: ";
            $senha = readline();
            $usuarioAtivo = logar($usuario, $senha);
            echo"\n \n \n \n \n \n \n \n \n \n \n \n";                             
            break;
        default:
            break;
    }
    while($usuarioAtivo != null){
        
        echo "1 - Vender \n";
        echo "2 - Cadastrar novo usuário \n";
        echo "3 - Cadastrar novo produto \n"; 
        echo "4 - Verificar Log \n";
        echo "5 - Deslogar \n";

        $escolha2 = readline();

        echo"\n \n \n \n \n \n \n \n \n \n \n \n";     
        
        
        switch($escolha2){
            case 1:
                //chamar função venda e registrar no log
                break;
            case 2:
                //cadastrar novo usuário e registrar log
                echo"Registrando novo usuário! \n";
                echo"Digite o login do usuário: \n";
                $loginCadastro = readline();

                echo"Digite a senha do usuário: \n";
                $senhaCadastro = readline();

                echo"Confirme a senha: \n";
                $senhaCadastro2 = readline();

                if($senhaCadastro == $senhaCadastro2){
                    echo"Digite o cargo do usuário: \n";
                    $cargoCadastro = readline();
                    cadastrarUsuario($loginCadastro, $senhaCadastro, $cargoCadastro);
                    break;
                }
                else{
                    echo"Senhas diferentes! Tente novamente. \n";
                    break;
                }
                
                
                
            case 3:
                //Cadastrar novo produto e registrar log
                break;
            case 4:
                //verificar log
                break;
            case 5:
                // registrar log
                echo "Tem certeza que deseja deslogar? \n";
                echo "1 - Sim \n";
                echo "2 - Não \n";
                $escolha3 = readline();

                if($escolha3 == 1){
                    $usuarioAtivo = null;
                }

                echo"\n \n \n \n \n \n \n \n \n \n \n \n"; 
                break;
            default:
                echo "Operação inválida";
                break;
        }
    }
}














