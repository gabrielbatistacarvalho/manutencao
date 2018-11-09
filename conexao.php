<?php
     $conexao = mysqli_connect("localhost","wadoryu","57641971");
    if (!$conexao){
        echo "Erro ao se conectar ao MySQL <br/>";
        exit;
    }
    $nome_banco = "manutencao";
    $banco = mysqli_select_db($conexao,$nome_banco);
    if (!$banco){
        echo "Erro ao se conectar ao banco manutencao...";
        exit;
    }
?>