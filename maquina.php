<?php

    require_once('confirmaAcesso.php');
    require_once('conexao.php');
    confAccess();

    if(isset($_POST['txtProcessador']) || isset($_POST['txtMemRam']) || isset($_POST['txtMemRam']) || isset($_POST['txtHd']) || isset($_POST['txtHd'])){
        $sql_insert = "INSERT INTO maquina (patrimonio, processador, mem_ram, hd, mac) 
        VALUES ('{$_POST['txtPatrimonio']}', '{$_POST['txtProcessador']}', '{$_POST['txtMemRam']}', '{$_POST['txtHd']}','{$_POST['txtMac']}');";
        $insert = mysqli_query($conexao, $sql_insert);
    }

    if(isset($_POST['txtUpProcessador']) || isset($_POST['txtUpMemRam']) || isset($_POST['txtUpMemRam']) || isset($_POST['txtUpHd']) || isset($_POST['txtUpMac'])){
        $sql_update = "UPDATE maquina SET processador = '{$_POST['txtUpProcessador']}', mem_ram = '{$_POST['txtUpMemRam']}', hd = '{$_POST['txtUpHd']}', mac = '{$_POST['txtUpMac']}'
        WHERE patrimonio = {$_POST['upPatrimonio']};";
        $update = mysqli_query($conexao, $sql_update);
    }
    
    if(isset($_POST['patrimonioDel'])){
        echo "Passei pelo IF";
        $sql_delete = "DELETE FROM maquina WHERE patrimonio = {$_POST['patrimonioDel']}";
        $delete = mysqli_query($conexao, $sql_delete);
    }

    
    $rs = mysqli_query($conexao,"SELECT * FROM maquina;");

    


?>


<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Máquinas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<div class="text-center">
<br>
    <h1>Máquinas<h1>
    </div>
    <div class="container">
        <input type="button" id="btVoltar" name ="btVoltar" 
               class="btn btn-warning" value="Voltar"
               onclick="javascript:location.href='conserto.php'">
               </div>
               <div class="text-center">
        <input type="button" id="btAd" name ="btRelatorio" 
               class="btn btn-primary" value="Relatórios"
               onclick="javascript:location.href='historicoMaq.php'">
               </div>
        <br><br>
        <div class="container">
    <div style="overflow: auto; width: 100%; height: 300px; border:solid 1px">
        <table class="table table-sm table-striped">
        <tr>    
            <th>Patrimônio</th>
            <th>Processador</th>
            <th>Memórioa RAM</th>
            <th>HD</th>
            <th colspan=3>MAC</th>
        </tr>
        <?php while ($linha = mysqli_fetch_array($rs)){
            ?>
                <tr>
                    <td><?php echo $linha['patrimonio'] ?></td>
                    <td><?php echo $linha['processador'] ?></td>
                    <td><?php echo $linha['mem_ram'] ?></td>
                    <td><?php echo $linha['hd'] ?></td>
                    <td><?php echo $linha['mac'] ?></td>
                    <td>
                        <form method=POST action=updateMaquina.php>
                            <input type="hidden" name="patrimonio" value="<?php echo $linha['patrimonio']; ?>">
                            <input type="hidden" name="processador" value="<?php echo $linha['processador']; ?>">
                            <input type="hidden" name="mem_ram" value="<?php echo $linha['mem_ram']; ?>">
                            <input type="hidden" name="hd" value="<?php echo $linha['hd']; ?>">
                            <input type="hidden" name="mac" value="<?php echo $linha['mac']; ?>">
                            <input type="submit" id="btAlter" name ="btAlter" 
                            class="btn btn-primary" value="Alterar">
                        </form>
                    </td>
                    <td>
                            <form method=POST action=maquina.php>
                            <input type="hidden" name="patrimonioDel" value="<?php echo $linha['patrimonio']; ?>">
                            <input type="submit" id="btDelete" name ="btDelete" 
                            class="btn btn-secondary" value="Deletar">
                            </form>
                    </td>
                        
                </tr>
            <?php
        }?>
        </table>
        </div>
        </div>
        <br>
        <div class="text-center">
        <div class="container">
        
            <h1>Cadastrar nova Máquina</h1>
            </div>
            <form id="frmNovoEstagiario" nome="frmNovoEstagiario" method="POST" action="maquina.php">
                <div class="container">
                        <label class="text-center col-md-2" for = "lblPatrimonio">Patrimônio</label>
                        <input class="text-center col-md-6" type="text" 
                               name = "txtPatrimonio" placeholder="Informe o patrimônio da máquina">
                               <br>
                        <label class="col-md-2" for = "lblProcessador">Processador</label>
                        <input class="text-center col-sm-6" type="text" 
                               name = "txtProcessador" placeholder="Informe o processador da máquina">
                               <br>
                        <label class="text-center col-md-2" for = "lblMemRam">Memória RAM</label>
                        <input class="text-center col-md-6" type="text" 
                               name = "txtMemRam" placeholder="Informe a memória RAM da máquina">
                               <br>
                        <label class="text-center col-md-2" for = "lblHd">HD</label>
                        <input class="text-center col-md-6" type="text" 
                               name = "txtHd" placeholder="Informe o tamanho do HD da máquina">
                               <br>
                        <label class="text-center col-md-2" for = "lblMac">MAC</label>
                        <input class="text-center col-md-6" type="text" 
                               name = "txtMac" placeholder="Informe o MAC da máquina">
                               <br>
                </div>
                <div class="text-center">
                <input type="submit" id="btEnviar" name ="btEnviar" 
                       class="btn btn-success" value="Gravar">

                <input type="reset" id="btLimpar" name ="btLimpar" 
                       class="btn btn-warning" value="Limpar">
                       </div>
            </form>
        </div>
        </div>

</body>
</html>