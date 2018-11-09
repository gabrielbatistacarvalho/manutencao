<?php

    require_once('confirmaAcesso.php');
    require_once('conexao.php');
    confAccess();

    $select = "";
    $cont = 0;
    if(!empty($_POST['txtId'])){
            $selectId = "SELECT c.id, c.patri_maq, c.data_entrada, c.data_saida, c.defeito, c.reparo, e.nome, l.predio
            FROM conserto c
            INNER JOIN estagiario e on c.est_resp = e.id
            INNER JOIN local l on c.local = l.id WHERE c.id = '{$_POST['txtId']}'";
            $select = $selectId;
            $cont += 1;
    }
    if(!empty($_POST['txtMaq'])){
        if($cont > 0){
            $selectMac = " AND c.patri_maq = '{$_POST['txtMaq']}'";
            $select .= $selectMac;
            $cont += 1;
        }else{
            $selectMac = "SELECT c.id, c.patri_maq, c.data_entrada, c.data_saida, c.defeito, c.reparo, e.nome, l.predio
            FROM conserto c
            INNER JOIN estagiario e on c.est_resp = e.id
            INNER JOIN local l on c.local = l.id WHERE c.patri_maq = '{$_POST['txtMaq']}'";
            $select .= $selectMac;
            $cont += 1;
        }
    }
    if(!empty($_POST['cbLocal'])){
        if($cont > 0){
        $selectLocal = " AND c.local = '{$_POST['cbLocal']}'";
            $select .= $selectLocal;
            $cont += 1; 
        }else{
            $selectLocal = "SELECT c.id, c.patri_maq, c.data_entrada, c.data_saida, c.defeito, c.reparo, e.nome, l.predio
            FROM conserto c
            INNER JOIN estagiario e on c.est_resp = e.id
            INNER JOIN local l on c.local = l.id WHERE c.local = '{$_POST['cbLocal']}'";
            $select .= $selectLocal;
            $cont += 1;
        }   
    }
    if(!empty($_POST['cbEst'])){
        if($cont > 0){
        $selectEst = " AND c.est_resp = '{$_POST['cbEst']}'";
            $select .= $selectEst;
            $cont += 1; 
        }else{
            $selectEst = "SELECT c.id, c.patri_maq, c.data_entrada, c.data_saida, c.defeito, c.reparo, e.nome, l.predio
            FROM conserto c
            INNER JOIN estagiario e on c.est_resp = e.id
            INNER JOIN local l on c.local = l.id WHERE c.est_resp = '{$_POST['cbEst']}'";
            $select .= $selectEst;
            $cont += 1;
        }   
    }
    if(!empty($_POST['txtDataEnt'])){
        $var = inverteData($_POST['txtDataEnt']);        
        if($cont > 0){
            $selectDataEnt = " AND c.data_entrada = '{$var}'";
            $select .= $selectDataEnt;
            $cont += 1; 
        }else{
            $selectDataEnt = "SELECT c.id, c.patri_maq, c.data_entrada, c.data_saida, c.defeito, c.reparo, e.nome, l.predio
            FROM conserto c
            INNER JOIN estagiario e on c.est_resp = e.id
            INNER JOIN local l on c.local = l.id WHERE c.data_entrada = '{$var}'";
            $select .= $selectDataEnt;
            $cont += 1;
        }   
    }
    if(!empty($_POST['txtDataSai'])){
        $var = inverteData($_POST['txtDataSai']);
        if($cont > 0){
        $selectDataSai = " AND c.data_saida = '{$var}'";
            $select .= $selectDataSai;
            $cont += 1; 
        }else{
            $selectDataSai = "SELECT c.id, c.patri_maq, c.data_entrada, c.data_saida, c.defeito, c.reparo, e.nome, l.predio
            FROM conserto c
            INNER JOIN estagiario e on c.est_resp = e.id
            INNER JOIN local l on c.local = l.id WHERE c.data_saida = '{$var}'";
            $select .= $selectDataSai;
            $cont += 1;
        }   
    }
    if($cont > 0){
        $select .= " ORDER BY c.id;";
        $rs = mysqli_query($conexao, $select);
    }else{
        $selectTotal = "SELECT c.id, c.patri_maq, c.data_entrada, c.data_saida, c.defeito, c.reparo, e.nome, l.predio
                FROM conserto c
                INNER JOIN estagiario e on c.est_resp = e.id
                INNER JOIN local l on c.local = l.id ORDER BY c.id;";
        $rs = mysqli_query($conexao, $selectTotal);
    }

    $comboLocal = "SELECT * FROM local;";
    $sql_comboLocal = mysqli_query($conexao, $comboLocal);

    $comboEstagiario = "SELECT * FROM estagiario WHERE status = 1;";
    $sql_comboEstagiario = mysqli_query($conexao, $comboEstagiario);

    function inverteData($data){
        if(count(explode("/",$data)) > 1){
            return implode("-",array_reverse(explode("/",$data)));
        }elseif(count(explode("-",$data)) > 1){
            return implode("/",array_reverse(explode("-",$data)));
        }
    }

    
?>

<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Relatórioss</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <div class="text-center">
    <br>
    <h1>Relatórios<h1>
    </div>
    <div class="container">
    <form class=text-left> 
        <input type="button" id="btVoltar" name ="btVoltar" 
               class="btn btn-warning" value="Voltar"
               onclick="javascript:location.href='conserto.php'">
        </form>
        <br>
               <form method="POST" action="historico.php">
            <div class="form-row">
                <div class="col">
                    <h6>ID</h6>
                    <input class="form-control col-md-9" type="text" 
                        name = "txtId" placeholder="ID">    
                </div>
                <div class="col">
                    <h6>Máquina</h6>
                    <input class="form-control col-md-9" type="text" 
                        name = "txtMaq" placeholder="Patrimônio">    
                </div>
                <div class="col">
                    <h6>Local</h6>

                    <select name="cbLocal" class="form-control col-md-9">
                                <option></option>
                            <?php while($dado = mysqli_fetch_assoc($sql_comboLocal)){ ?>
                                <option value="<?php echo $dado['id'];?>"><?php echo $dado['predio']; ?></option>
                            <?php }?>
                        </select>
                      
                </div>
                <div class="col">
                    <h6>Estagiário</h6>
                    <select name="cbEst" class="form-control col-md-9"  placeholder="Patrimônio">
                                <option></option>
                            <?php while($dado = mysqli_fetch_assoc($sql_comboEstagiario)){ ?>
                                <option value="<?php echo $dado['id'];?>"><?php echo $dado['nome']; ?></option>
                            <?php }?>
                        </select>    
                </div>
                <div class="col">
                    <h6>Data de Entrada</h6>
                    <input class="form-control col-md-9" type="text" 
                        name = "txtDataEnt" placeholder="Entrada">    
                </div>
                <div class="col">
                    <h6>Data de Saída</h6>
                    <input class="form-control col-md-9" type="text" 
                        name = "txtDataSai" placeholder="Saída">    
                </div>
            </div>
            <br>
            <div class="text-center">
            <input type="submit" id="btAd" name ="btRelTotal" 
               class="btn btn-primary" value="Gerar Relatório">
               </div>
        </form>
               

            <div style="overflow: auto; width: 100%; height: 400px; border:solid 1px">
            <table class="table table-sm table-striped">
            <tr>    
                <th>ID</th>
                <th>Patrimônio</th>
                <th>Local</th>
                <th>Estagiário</th>
                <th>Data de entrada</th>
                <th>Data de saída</th>
                <th>Defeito</th>
                <th>Reparo</th>
            </tr>

<?php while ($linha = mysqli_fetch_array($rs)){
                ?>
                    <tr>
                        <td><?php echo $linha['id'] ?></td>
                        <td><?php echo $linha['patri_maq'] ?></td>
                        <td><?php echo $linha['predio'] ?></td>
                        <td><?php echo $linha['nome'] ?></td>
                        <td><?php echo inverteData($linha['data_entrada']) ?></td>
                        <td><?php echo inverteData($linha['data_saida']) ?></td>
                        <td><?php echo $linha['defeito'] ?></td>
                        <td><?php echo $linha['reparo'] ?></td>
                    </tr>

                   
                <?php
            }?>
        </table>
    </div>   
    <br><br>
    </body>
</html>