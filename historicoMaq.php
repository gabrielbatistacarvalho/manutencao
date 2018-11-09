<?php

    require_once('confirmaAcesso.php');
    require_once('conexao.php');
    confAccess();

    $select = "";
    $cont = 0;
    if(!empty($_POST['txtPatri'])){
    $selectPatri = "SELECT patrimonio, processador, mem_ram, hd, mac FROM maquina WHERE patrimonio = '{$_POST['txtPatri']}'";
        $select = $selectPatri;
        $cont += 1;
    }
    if(!empty($_POST['txtPros'])){
        if($cont > 0){
        $selectPros = " AND processador = '{$_POST['txtPros']}'";
            $select .= $selectPros;
            $cont += 1;
        }else{
        $selectPros = "SELECT patrimonio, processador, mem_ram, hd, mac FROM maquina WHERE processador = '{$_POST['txtPros']}'";
            $select .= $selectPros;
            $cont += 1;
        }

    }
    if(!empty($_POST['txtMemRam'])){
        if($cont > 0){
        $selectMemRam = " AND mem_ram = '{$_POST['txtMemRam']}'";
            $select .=$selectMemRam;
            $cont += 1;
        }else{
        $selectMemRam = "SELECT patrimonio, processador, mem_ram, hd, mac FROM maquina WHERE mem_ram = '{$_POST['txtMemRam']}'";
            $select .= $selectMemRam;
            $cont += 1;
        }
    }
    if(!empty($_POST['txtHd'])){
        if($cont > 0){
        $selectHd = " AND hd = '{$_POST['txtHd']}'";
            $select .= $selectHd;
            $cont += 1; 
        }else{
        $selectHd = "SELECT patrimonio, processador, mem_ram, hd, mac FROM maquina WHERE hd = '{$_POST['txtHd']}'";
            $select .= $selectHd;
            $cont += 1;
        }   
    }
    if(!empty($_POST['txtMac'])){
        if($cont > 0){
        $selectMac = " AND mac = '{$_POST['txtMac']}'";
            $select .= $selectMac;
            $cont += 1; 
        }else{
        $selectMac = "SELECT patrimonio, processador, mem_ram, hd, mac FROM maquina WHERE mac = '{$_POST['txtMac']}'";
            $select .= $selectMac;
            $cont += 1;
        }   
    }
    if($cont > 0){
        $select .= ";";
        $rs = mysqli_query($conexao, $select);
    }else{
        $rs = mysqli_query($conexao, "SELECT * FROM maquina;");
    }
    echo $select;

?>


<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Máquinas</title>
    
    <script src="main.js"></script>
</head>
<body>
<div class="container">
<div class="text-center">
    <h1>Máquinas<h1>
    </div>
        <input type="button" id="btVoltar" name ="btVoltar" 
               class="btn btn-warning" value="Voltar"
               onclick="javascript:location.href='maquina.php'">
        <br>
        <br>
        <form method="POST" action="historicoMaq.php">
            <div class="form-row">
                <div class="col">
                    <h6>Patrimônio</h6>
                    <input class="form-control col-md-9" type="text" 
                        name = "txtPatri">    
                </div>
                    <div class="col">
                    <h6>Processador</h6>
                    <input class="form-control col-md-9" type="text" 
                        name = "txtPros">    
                </div>
                    <div class="col">
                    <h6>Memória RAM</h6>
                    <input class="form-control col-md-9" type="text" 
                        name = "txtMemRam">    
                </div>
                    <div class="col">
                    <h6>HD</h6>
                    <input class="form-control col-md-9" type="text" 
                        name = "txtHd">    
                </div>
                    <div class="col">
                    <h6>MAC</h6>
                    <input class="form-control col-md-9" type="text" 
                        name = "txtMac">    
                </div>
            </div>
            <br>
            <div class="text-center">
            <input type="submit" id="btAd" name ="btRelTotal" 
               class="btn btn-primary" value="Gerar Relatório">
            </div>
            <br>
        </form>
        <div style="overflow: auto; width: 100%px; height: 300px; border:solid 1px"> 
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
                    

                     <?php
        }?>
        </table>
        </div>
        </div>
        <br>
        </body>
</html>    