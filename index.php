<?php

$arquivoLog = 'arquivo_log.txt';

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
$produto [4] = "Arroz";

$produtos = null;

$produtos["1"] = $produto;

$vendasTotais = 0;

/* Funções do sistema */

function cadastrarUsuario($nome, $senha, $cargo){
    
    global $usuarios;
    if(array_key_exists($nome, $usuarios)){
        echo "O usuário já existe, tente novamente! \n";
        $msg = "Tentou registrar um usuário que já existe";
        registrarLog($msg);
    }
    else{
        $usuario [0] = $senha;
        $usuario [1] = $cargo;
        $usuarios[$nome] = $usuario;
        $msg = "Usuário $nome cadastrado";
        registrarLog($msg);
    }
}

function logar($usuario, $senha){
    global $usuarios;
    if($usuarios[$usuario][0] == $senha ){
        echo "O usuário $usuario foi logado com sucesso! \n";
        return $usuario;
        echo "----------------------------------------";
    }
    else{
        echo "Usuário ou senha incorretos \n";
        $msg = "Tentativa de login falhou!";
        echo "----------------------------------------";
    }
}

function cadastrarProduto($idProduto, $quantProduto, $precoProduto, $tamProduto, $marcaProduto, $nomeProduto){
    global $produtos;
    global $usuarioAtivo;
    if(array_key_exists($idProduto, $produtos)){
        echo "Esse produto já foi cadastrado! \n";
        $msg = "Erro ao cadastrar, produto já cadastrado pelo usuário!";
        registrarLog($msg);
        echo "----------------------------------------";
    }
    else{
        $produto [0] = $quantProduto;
        $produto [1] = $precoProduto;
        $produto [2] = $tamProduto;
        $produto [3] = $marcaProduto;
        $produto [4] = $nomeProduto;
        $produtos[$idProduto] = $produto;

        $msg = "Produto cadastrado pelo usuário!";
        registrarLog($msg);
        echo "----------------------------------------";
    }
}
function editarValor($id){
    global $produtos;
    global $usuarioAtivo;

    if(array_key_exists($id, $produtos)){
        echo "Digite o novo valor para o produto: \n";
        $novoValor = readline();

        if($novoValor > 0){
            $produtos[$id][1] = $novoValor;
            echo "Valor do produto alterado! \n";
            $msg = "O valor do produto foi alterado!";
            registrarLog($msg);
            echo "----------------------------------------";
        }
        else{
            echo "Não pode ser um valor negativo! \n";
            $msg = "Tentou cadastrar um valor negativo!";
            registrarLog($msg);
            echo "----------------------------------------";
        }
    }
    else{
        echo "Esse produto não esta cadastrado!\n";
        $msg = "Tentou editar item não cadastrado!";
        registrarLog($msg);
        echo "----------------------------------------";
    }
}

function editarQuant($id){
    global $produtos;
    global $usuarioAtivo;

    if(array_key_exists($id, $produtos)){
        echo "Digite a nova quantidade do produto em estoque: \n";
        $novoValor = readline();

        if($novoValor >= 0){
            $produtos[$id][0] = $novoValor;

            echo "Quantidade do produto alterada! \n";
            $msg = "A quantidade de produto em estoque foi atualizada!";
            registrarLog($msg);
            echo "----------------------------------------";
        }
        else{
            echo "Não pode ser quantidade negativa! \n";
            $msg = "Tentou cadastrar quantidade negativa!";
            registrarLog($msg);
            echo "----------------------------------------";
        }
    }
    else{
        echo "Esse produto não esta cadastrado!\n";
        $msg = "Tentou editar item não cadastrado!";
        registrarLog($msg);
        echo "----------------------------------------";
    }
}

function deletarProduto($id){
    global $produtos;
    global $usuarioAtivo;

    if(array_key_exists($id, $produtos)){
        unset($produtos[$id]);
        echo "Produto deletado com sucesso! \n";
        $msg = "Produto deletado do sistema!";
        registrarLog($msg);
        echo "----------------------------------------";
    }
    else{
        echo "Esse produto não esta cadastrado! \n";
        $msg = "Tentou deletar um item que não esta cadastrado!";
        registrarLog($msg);
        echo "----------------------------------------";
    }
}

function registrarLog($mensagem){
    global $arquivoLog;
    global $usuarioAtivo;

    $dataHora = date('d/m/Y H:i:s');
    $mensagemFormatada = "[$dataHora] $mensagem, usuário: $usuarioAtivo \n";

    file_put_contents($arquivoLog, $mensagemFormatada, FILE_APPEND);
}

function verificarLog(){
    global $arquivoLog;
    global $usuarioAtivo;
    if(file_exists($arquivoLog)){
        $arquivo = file_get_contents($arquivoLog);
        echo "Log do sistema:\n";
        echo "$arquivo";
        $msg = "Verificação de log pelo usuário";
        registrarLog($msg);
        echo "----------------------------------------";
    }else{
        echo "Ainda não existe arquivo de log! \n";
        echo "----------------------------------------";
    }
}

function cadastrarVenda($idProduto, $quant){
    global $arquivoLog;
    global $produtos;
    global $usuarioAtivo;

    if(array_key_exists($idProduto, $produtos)){
        $produtos[$idProduto][0];

        $quantProduto = $produtos[$idProduto][0] - $quant;
        
        if($quantProduto >= 0){

            $msg = "Produto vendido $idProduto";
            registrarLog($msg);
            $valorVenda = $quant *  $produtos[$idProduto][1];
            echo "----------------------------------------\n";
            echo "Valor da venda: $valorVenda\n";
            $nomeProd = $produtos[$idProduto][4];
            echo "Nome do produto vendido: $nomeProd \n";
            echo "----------------------------------------\n";
            return $valorVenda;
        }
        else{
            echo "Não pode realizar a venda, não tem estoque \n";
            $msg = "Produto não foi vendido por falta de estoque";
            registrarLog($msg);
            echo "----------------------------------------";
        }
    }
    else{
        echo "Produto não cadastrado!\n";
        echo "----------------------------------------";
        $msg = "Tentou comprar item que não foi cadastrado";
        registrarLog($msg);
    }
}


//Menus
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
            $msg = "Usuário logado com sucesso!";
            registrarLog($msg);
            
            echo "----------------------------------------";
            echo "\n \n \n \n \n \n \n \n \n \n";
            break;
        default:
            break;
    }
    while($usuarioAtivo != null){
        echo "\nUsuário logado: $usuarioAtivo \n";
        echo "Valor em vendas totais: R$ $vendasTotais \n";

        echo "---------------------Menu---------------------- \n";
        echo "1 - Vender \n";
        echo "2 - Cadastrar novo usuário \n";
        echo "3 - Cadastrar novo produto \n";     
        echo "4 - Editar produto \n";
        echo "5 - Deletar produto \n";
        echo "6 - Verificar Log \n";
        echo "7 - Deslogar \n";
        echo "---------------------------------------------- \n";
        $escolha2 = readline();

       
        switch($escolha2){
            case 1:
                echo"Digite o ID do produto: \n";
                
                $idVenda = readline();

                echo"A quantidade do produto: \n";
                
                $quantVenda = readline();

                $vendasTotais += cadastrarVenda($idVenda, $quantVenda);
                echo "---------------------------------------------- \n";
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
                    $msg = "Erro ao registrar senha!";
                    registrarLog($msg);
                    break;
                }


            case 3:
                echo"Registrando! \n";

                echo"Digite o ID do produto: \n";
                
                $idProduto = readline();

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

                cadastrarProduto($idProduto, $quantProduto, $precoProduto, $tamProduto, $marcaProduto, $nomeProduto);
  
                break;
            case 4:
                echo "1 - Editar valor do produto: \n";
                echo "2 - Editar quantidade do produto: \n"; 

                $editarOpcao = readline();

                switch($editarOpcao){
                    case 1:
                            echo "Digite o ID do produto que deseja alterar o valor: \n";
                            $idAlterar = readline();
                            editarValor($idAlterar);
                        break;
                    case 2:
                             echo "Digite o ID do produto que deseja alterar a quantidade: \n";
                            $idAlterar = readline();
                            editarValor($idAlterar);
                        //editarQuant();
                        break;
                    default:
                        echo "Opção não exite!";
                        break;
                }

                break;
            case 5:
                echo "Digite o ID do produto que deseja deletar: \n";
                    $idAlterar = readline();
                    deletarProduto($idAlterar);
                break;
            case 6:
                verificarLog();
                echo "\n";
                break;
            case 7:
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














