<?php

    require_once('confirmaAcesso.php');
    require_once('conexao.php');
    confAccess();

    $comboMaquina = "SELECT patrimonio FROM maquina;";
    $sql_comboMaquina = mysqli_query($conexao, $comboMaquina);

    $comboLocal = "SELECT * FROM local;";
    $sql_comboLocal = mysqli_query($conexao, $comboLocal);

    $comboEstagiario = "SELECT * FROM estagiario;";
    $sql_comboEstagiario = mysqli_query($conexao, $comboEstagiario);
?>

<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>Editar Cadastro de Conserto</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <script src="main.js"></script>
    </head>
    <body>
        <div class="container col-md-8">
        <br>
            <h1>Editar Cadastro de Conserto</h1>
            <form id="frmUpConserto" nome="frmUpConserto" method="POST" action="conserto.php">
                <div class="form-group">
                    <?php
                    echo "<input type='hidden' name='upId' value='{$_POST['id']}'>";
                    ?>
                        <label for = "lblPatrimonio">Patrimônio</label>
                    <select name="cbUpMaquina" class="form-control col-md-6">
                        <?php while($dado = mysqli_fetch_assoc($sql_comboMaquina)){ ?>
                            <?php 
                            
                            echo "<option ";
                            if($_POST['patri_maq'] == $dado['patrimonio']){
                                echo "selected ";
                            }
                            echo "value=\"{$dado['patrimonio']}\"> {$dado['patrimonio']}</option>";
                            }
                            ?>
                    </select>


                        <label for = "lblLocal">Local</label>
                    <select name="cbUpLocal" class="form-control col-md-6">
                        <?php while($dado = mysqli_fetch_assoc($sql_comboLocal)){ ?>
                            <?php 
                            
                            echo "<option ";
                            if($_POST['local'] == $dado['id']){
                                echo "selected ";
                            }
                            echo "value=\"{$dado['id']}\"> {$dado['predio']}</option>";
                            }
                            ?>
                    </select>
                    
                        <label for = "lblblEstResplHd">Estagiário Responsável</label>
                    <select name="cbUpEstagiario" class="form-control col-md-6">
                        <?php while($dado = mysqli_fetch_assoc($sql_comboEstagiario)){ ?>
                            <?php 
                            
                            echo "<option ";
                            if($_POST['est_resp'] == $dado['id']){
                                echo "selected ";
                            }
                            echo "value=\"{$dado['id']}\"> {$dado['nome']}</option>";
                            }
                            ?>
                    </select>
                    <label for = "lblDefeito">Defeito</label>
                    <?php
                         echo "<input class='form-control col-md-6' type='text' name='txtUpDefeito' value='{$_POST['defeito']}'>";
                    ?>
                    <label for = "lblReparo">Reparo</label>
                    <?php
                         echo "<input class='form-control col-md-6' type='text' name='txtUpReparo' value='{$_POST['reparo']}'>";
                    ?>
                </div>
                <input type="submit" id="btEnviar" name ="btEnviar" 
                       class="btn btn-success" value="Gravar">
                <input type="reset" id="btLimpar" name ="btLimpar" 
                       class="btn btn-warning" value="Limpar">
                <input type="button" id="btCancel" name ="btCancel" 
                       class="btn btn-danger" value="Cancelar"
                       onclick="javascript:location.href='conserto.php'">
            </form>
        </div>
    </body>
</html>