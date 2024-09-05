<?php
/*
function cadastrarVenda(){

}

function registrarLog(){

}

function verificarLog(){

}

editar quantidade do produto dentro da funcao cadastrar produto

*/

                                                     /*  Cadastro de Usuário e produtos pré-definidos no sistema */

/* Usuários é um Array associativo que usa como chave o nome/login, dentro desse array temos outro array que na 
posição [0] leva a senha e na [1] leva o cargo do usuário no sistema. */

$usuario [0] = 123123;
$usuario [1] = "Administrador";
$usuarioAtivo = null;

$usuarios["admin"] = $usuario;

/*
    Produtos é um array assossiativo onde a chave é o nome do produto e o item é um array que leva as informações do produto
     quantidade [0], valor em float [1], peso por unidade [2] e marca [3].
*/


$produto [0] = 10;
$produto [1] = 7.99;
$produto [2] = "KG";
$produto [3] = "Tio João";
$produtos = null;

$produtos["Arroz"] = $produto;



/* Funções do sistema */

function cadastrarUsuario($nome, $senha, $cargo){
    
    global $usuarios;
    if(array_key_exists($nome, $usuarios)){
        echo "O usuário já existe, tente novamente! \n";
    }
    else{
    $usuario [0] = $senha;
    $usuario [1] = $cargo;
    $usuarios[$nome] = $usuario;

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
function cadastrarProduto($nomeProduto, $quantProduto, $precoProduto, $tamProduto, $marcaProduto){
    global $produtos;
    if(array_key_exists($nomeProduto, $produtos)){
        echo "Esse produto já foi cadastrado! \n";
    }
    else{
        $produto [0] = $quantProduto;
        $produto [1] = $precoProduto;
        $produto [2] = $tamProduto;
        $produto [3] = $marcaProduto;
        $produtos[$nomeProduto] = $produto;

    }
}


/* Menu do sistema */
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
                echo"Registrando ou alterando produto! \n";
                echo"Digite o nome do produto: \n";
                
                $nomeProduto = readline();

                echo"Digite a quantidade do produto: \n";
                $quantProduto = readline();

                echo"Digite o preço do produto usando . para dividir centavos: \n";
                $precoProduto = readline();

                echo"Digite o tamanho do produto na unidade adequada KG/G/MG/UN e etc: \n";
                $tamProduto = readline();

                echo"Digite a marca do produto: \n";
                $marcaProduto = readline();

                cadastrarProduto($nomeProduto, $quantProduto, $precoProduto, $tamProduto, $marcaProduto);
  
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

                break;
            default:
                echo "Operação inválida";
                break;
        }
    }
}














