<?php

/* Projeto Módulo 2
*/


/* cadastrar um usuário padrão
function logar(){
}

function deslogar(){
}


function cadastrarUsuario(){

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

$usuarios["admin"] = $usuario;

function cadastrarUsuario($nome, $senha, $cargo){
    $usuario [0] = $senha;
    $usuario [1] = $cargo;
    $usuarios[$nome] = $usuario;
}

