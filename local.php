<?php

    require_once('confirmaAcesso.php');
    require_once('conexao.php');
    confAccess();

    if(isset($_POST['txtPredio'])){
        $sql_insert = "INSERT INTO local (predio) VALUES ('{$_POST['txtPredio']}');";
        $insert = mysqli_query($conexao, $sql_insert);
    }

   
    if(isset($_POST['txtUpPredio']) && $_POST['txtUpPredio'] != ""){
        $sql_update = "UPDATE local SET predio = '{$_POST['txtUpPredio']}' WHERE id = {$_POST['upId']};";
        $update = mysqli_query($conexao, $sql_update);
    }
    
    if(isset($_POST['idDel'])){
        $sql_delete = "DELETE FROM local WHERE id = {$_POST['idDel']}";
        $delete = mysqli_query($conexao, $sql_delete);
    }

    $sql_select = "SELECT * FROM local;";
    $rs = mysqli_query($conexao,$sql_select);



?>


<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Local</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<div class="text-center">
<br>
<h1>Local<h1>
    </div>
    <div class="container">
        <input type="button" id="btVoltar" name ="btVoltar" 
               class="btn btn-warning" value="Voltar"
               onclick="javascript:location.href='conserto.php'">
               </div>
        <br>
        <div class="container">
    <div style="overflow: auto; width: 100%; height: 300px; border:solid 1px">
        <table class="table table-sm table-striped">
            <tr>    
                <th colspan=13>Prédio</th>
            </tr>
            <?php while ($linha = mysqli_fetch_array($rs)){
                ?>
                    <tr>
                        <td><?php echo $linha['predio']?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <form method=POST action=updateLocal.php>
                            <input type="hidden" name="predio" value="<?php echo $linha['predio']; ?>">
                            <input type="hidden" name="id" value="<?php echo $linha['id']; ?>">
                            <input type="submit" id="btAlter" name ="btAlter" 
                            class="btn btn-primary" value="Alterar">
                            </form>
                        </td>
                        <td>
                            <form method=POST action=local.php>
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
        <br>
        <div class="text-center">
            <h1>Cadastrar novo local</h1>
            <form id="frmNovoEstagiario" nome="frmNovoEstagiario" method="POST" action="local.php">
                <div class="form-group">
                        <label class="col-md-1" for = "lblLocal">Local</label>
                        <input class="text-center col-md-4" type="text" 
                               name = "txtPredio" placeholder="Informe o nome do local">
                </div>
                <input type="submit" id="btEnviar" name ="btEnviar" 
                       class="btn btn-success" value="Gravar">
                <input type="reset" id="btLimpar" name ="btLimpar" 
                       class="btn btn-warning" value="Limpar">
            </form>
        </div>

</body>
</html>