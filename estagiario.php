<?php

    require_once('confirmaAcesso.php');
    require_once('conexao.php');
    confAccess();
    
    if(isset($_POST['txtNome']) && $_POST['txtNome'] != ""){
        $sql_insert = "INSERT INTO estagiario (nome, status) VALUES ('{$_POST['txtNome']}', 1);";
        $insert = mysqli_query($conexao, $sql_insert);
    }

    if(isset($_POST['txtUpNome']) && $_POST['txtUpNome'] != ""){
        $sql_update = "UPDATE estagiario SET nome = '{$_POST['txtUpNome']}' WHERE id = {$_POST['upId']};";
        $update = mysqli_query($conexao, $sql_update);
    }

    if(isset($_POST['idHab'])){
        $sql_updateHab = "UPDATE estagiario SET status = 1 WHERE id = {$_POST['idHab']};";
        $updateHab = mysqli_query($conexao, $sql_updateHab);
    }
    
    if(isset($_POST['idDes'])){
        $sql_updateDes = "UPDATE estagiario SET status = 0 WHERE id = {$_POST['idDes']};";
        $updateDes = mysqli_query($conexao, $sql_updateDes);
    }

    if(isset($_POST['idDel'])){
        $sql_delete = "DELETE FROM estagiario WHERE id = {$_POST['idDel']}";
        $delete = mysqli_query($conexao, $sql_delete);
    }
    $var = "";
    
    

    if(isset($_POST['btDes'])){
        $sql_select = "SELECT * FROM estagiario WHERE status = 0;";
        $var = 0;
    }elseif(isset($_POST['btHab'])){
        $sql_select = "SELECT * FROM estagiario WHERE status = 1;";
        $var = 1;
    }else{
        $sql_select = "SELECT * FROM estagiario WHERE status = 1;";
        $var = 1;
    }

    $rs = mysqli_query($conexao, $sql_select);

?>


<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Estagiários</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<div class="text-center">
<br>
<h1>Estagiários<h1>
    </div>
    <div class="container">
        <input type="button" id="btVoltar" name ="btVoltar" 
                class="btn btn-warning" value="Voltar"
                onclick="javascript:location.href='conserto.php'">
                </div>
                <div class="text-center">
                <form method=POST action=estagiario.php> 
                <tr>

                    <td>
                        <input type="submit" id="btHab" name ="btHab" 
                            class="btn btn-primary" value="Estagiários Habilitados"
                            onclick="javascript:location.href='estagiario.php'">
                            
                        <input type="submit" id="btDes" name ="btDes" 
                            class="btn btn-primary" value="Estagiários Desabilitados"
                            onclick="javascript:location.href='estagiario.php'">
                    </td>
                </tr>
                </form>
                </div>
                <br>
                <div class="container">
    <div style="overflow: auto; width: 100%; height: 300px; border:solid 1px">
        <table class="table table-sm table-striped">
            <tr>    
                <th>Nome</th>
                <th colspan=13>Status</th>
            </tr>
            <?php while ($linha = mysqli_fetch_array($rs)){
                ?>
                    <tr>
                        <td><?php echo $linha['nome'] ?></td>
                        <?php if($linha['status'] == 1){?>
                        <td>Habilitado</td>
                        <?php } 
                        else{?>
                        <td>Desabilitado</td>
                        <?php } ?>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <form method=POST action=updateEstagiario.php>
                            <input type="hidden" name="nome" value="<?php echo $linha['nome']; ?>">
                            <input type="hidden" name="id" value="<?php echo $linha['id']; ?>">
                            <input type="submit" id="btAlter" name ="btAlter" 
                            class="btn btn-primary" value="Alterar">
                            </form>
                        </td>
                        <td>
                        <?php 
                        if($var == 1){
                            ?>
                            <td>                            
                                <form method=POST action=estagiario.php>
                                    <input type="hidden" name="idDes" value="<?php echo $linha['id']; ?>">
                                    <input type="submit" id="btDesabilita" name ="btDesabilita" 
                                        class="btn btn-warning" value="Desabilitar">
                                </form>
                            </td>
                            <?php
                        }elseif($var == 0){
                            ?>
                            <td>
                                <form method=POST action=estagiario.php>
                                    <input type="hidden" name="idHab" value="<?php echo $linha['id']; ?>">
                                    <input type="submit" id="btHabilita" name ="btHabilita" 
                                        class="btn btn-success" value="Habilitar">
                                </form>
                            </td>
                        <?php } ?>
                        <td>
                            <form method=POST action=estagiario.php>
                            <input type="hidden" name="idDel" value="<?php echo $linha['id']; ?>">
                            <input type="submit" id="btDelete" name ="btDelete" 
                            class="btn btn-secondary" value="Deletar">
                            </form>
                        </td>
                    </tr>
                <?php
            }?>
        </table>
    </div>
        <div class="text-center">
        <div class="container col-md-8">
        <br>
            <h1>Cadastrar novo estagiário</h1>
            <br>
            <form id="frmNovoEstagiario" nome="frmNovoEstagiario" method="POST" action="estagiario.php">
                <div class="form-group">
                <label for = "lblNome">Nome</label>
                        <input class="text-center col-md-6" type="text" 
                               name = "txtNome" placeholder="Informe o nome do estagiário">
                </div>
                <input type="submit" id="btEnviar" name ="btEnviar" 
                       class="btn btn-success" value="Gravar">

                <input type="reset" id="btLimpar" name ="btLimpar" 
                       class="btn btn-warning" value="Limpar">

            </form>
        </div>
    </div>
</body>
</html>