<?php

    require_once('confirmaAcesso.php');
    require_once('conexao.php');
    confAccess();

    if(isset($_POST['btFinal'])){
        $dataSaida = date('Y-m-d');
        $sql_DataSai = "UPDATE conserto SET data_saida = '{$dataSaida}' WHERE id = {$_POST['consertoFinal']};";
        $updateDataFinal = mysqli_query($conexao, $sql_DataSai);
    }

    if(!empty($_POST['cbMaquina']) && !empty($_POST['cbLocal']) && !empty($_POST['cbEstagiario']) && !empty($_POST['txtDefeito'])){
            $dataEntrada = date('Y-m-d');
            $sql_insert = "INSERT INTO conserto (patri_maq, local, est_resp, data_entrada, data_saida, defeito, reparo) 
            VALUES ('{$_POST['cbMaquina']}', '{$_POST['cbLocal']}', '{$_POST['cbEstagiario']}',
             '{$dataEntrada}',NULL,'{$_POST['txtDefeito']}', '{$_POST['txtReparo']}');";
         
         
        $insert = mysqli_query($conexao, $sql_insert);
    }

    if(!empty($_POST['cbUpMaquina']) && !empty($_POST['cbUpLocal']) && !empty($_POST['cbUpEstagiario']) && !empty($_POST['txtUpDefeito'])){
            $sql_update = "UPDATE conserto SET patri_maq = '{$_POST['cbUpMaquina']}', local = '{$_POST['cbUpLocal']}', 
            est_resp = '{$_POST['cbUpEstagiario']}', defeito = '{$_POST['txtUpDefeito']}', reparo = '{$_POST['txtUpReparo']}'
            WHERE id = {$_POST['upId']};";
        $update = mysqli_query($conexao, $sql_update);
    }
    
    if(isset($_POST['consertoDel'])){
        $sql_delete = "DELETE FROM conserto WHERE id = {$_POST['consertoDel']}";
        $delete = mysqli_query($conexao, $sql_delete);
    }

    $comboMaquina = "SELECT patrimonio FROM maquina;";
    $sql_comboMaquina = mysqli_query($conexao, $comboMaquina);

    $comboLocal = "SELECT * FROM local;";
    $sql_comboLocal = mysqli_query($conexao, $comboLocal);

    $comboEstagiario = "SELECT * FROM estagiario WHERE status = 1;";
    $sql_comboEstagiario = mysqli_query($conexao, $comboEstagiario);

    $select = "SELECT c.id, c.patri_maq, c.local, c.est_resp, c.data_entrada, c.defeito, c.reparo, e.nome, l.predio
                FROM conserto c
                INNER JOIN estagiario e on c.est_resp = e.id
                INNER JOIN local l on c.local = l.id
        WHERE c.data_saida is NULL ORDER BY c.data_entrada;";

        
    $rs = mysqli_query($conexao, $select);
    

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
    <br>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Máquinas em manutenção</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css"  href="estilo.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<div class="text-center">
    <h1>Máquinas em Manutenção<h1>
</div>

    <div class="text-center">
    <div class="container">
    <form class=text-left method=POST action=index.php>
        <input type="button" id="btAd" name ="btFechar" 
               class="btn btn-danger" value="Fechar"
               onclick="javascript:location.href='logout.php'">
    </form>
</div>
        <input type="button" id="b1tAd" name ="btGenLoc" 
               class="btn btn-primary" value="Gerenciar Locais"
               onclick="javascript:location.href='local.php'">
        <input type="button" id="btAd" name ="btGenEst" 
               class="btn btn-primary" value="Gerenciar estagiários"
               onclick="javascript:location.href='estagiario.php'">        
        <input type="button" id="btAd" name ="btGenMaq" 
               class="btn btn-primary" value="Gerenciar máquinas"
               onclick="javascript:location.href='maquina.php'">
        <td></td>
        <input type="button" id="btAd" name ="btRelatorio" 
               class="btn btn-primary" value="Relatórios"
               onclick="javascript:location.href='historico.php'">
        </div>
        <br><br>
        <div class="container">
    <div style="overflow: auto; width: 100%; height: 400px; border:solid 1px">
        <table class="table table-sm table-striped">
        
            <tr>    
                <th>ID</th>
                <th>Patrimônio</th>
                <th>Local</th>
                <th>Estagiário</th>
                <th>Entrada</th>
                <th>Defeito</th>
                <th colspan=9>Reparo</th>
            </tr>
            <?php while ($linha = mysqli_fetch_array($rs)){
                ?>
                    <tr>
                        <td><?php echo $linha['id'] ?></td>
                        <td><?php echo $linha['patri_maq'] ?></td>
                        <td><?php echo $linha['predio'] ?></td>
                        <td><?php echo $linha['nome'] ?></td>
                        <td><?php echo inverteData($linha['data_entrada']) ?></td>
                        <td><?php echo $linha['defeito'] ?></td>
                        <td><?php echo $linha['reparo'] ?></td>
                        <td>
                            <form method=POST action=conserto.php>
                                <input type="hidden" name="consertoFinal" value="<?php echo $linha['id']; ?>">
                                <input type="submit" id="btFinal" name ="btFinal" 
                                class="btn btn-success" value="Finalizar">
                            </form>
                        </td>
                        <td>
                            <form method=POST action=updateConserto.php>
                                <input type="hidden" name="id" value="<?php echo $linha['id']; ?>">
                                <input type="hidden" name="patri_maq" value="<?php echo $linha['patri_maq']; ?>">
                                <input type="hidden" name="local" value="<?php echo $linha['local']; ?>">
                                <input type="hidden" name="est_resp" value="<?php echo $linha['est_resp']; ?>">
                                <input type="hidden" name="defeito" value="<?php echo $linha['defeito']; ?>">
                                <input type="hidden" name="reparo" value="<?php echo $linha['reparo']; ?>">
                                <input type="submit" id="btAlter" name ="btAlter" 
                                class="btn btn-primary" value="Alterar">
                            </form>
                        </td>
                        <td>
                            <form method=POST action=conserto.php>
                                <input type="hidden" name="consertoDel" value="<?php echo $linha['id']; ?>">
                                <input type="submit" id="btDelete" name ="btDelete" 
                                class="btn btn-secondary" value="Deletar">
                            </form>
                        </td>
                    </tr>
                <?php
            }?>
        </table>
    </div>   
<br><br>
<div class="container col-md-8">
            <h1>Cadastrar máquina para conserto</h1>
            <form id="frmNovoEstagiario" nome="frmNovoEstagiario" method="POST" action="conserto.php">
            <div class="form-group">
                        <label class="col-md-2" for = "lblpatrimonio">Patrimônio</label>
                        <select name="cbMaquina" class="text-center col-md-7">
                            <option></option>
                            <?php while($dado = mysqli_fetch_assoc($sql_comboMaquina)){ ?>
                                <option value="<?php echo $dado['patrimonio'];?>"><?php echo $dado['patrimonio']; ?></option>
                            <?php }?>
                        </select>
                        <br>
                        <label class="col-md-2" for = "lblLocal">Local</label>
                        <select name="cbLocal" class="text-center col-md-7">
                                <option></option>
                            <?php while($dado = mysqli_fetch_assoc($sql_comboLocal)){ ?>
                                <option value="<?php echo $dado['id'];?>"><?php echo $dado['predio']; ?></option>
                            <?php }?>
                        </select>
                        <br>
                        <label class="col-md-2" for = "lblEstagiario">Estagiário</label>
                        <select name="cbEstagiario" class="text-center col-md-7">
                                <option></option>
                            <?php while($dado = mysqli_fetch_assoc($sql_comboEstagiario)){ ?>
                                <option value="<?php echo $dado['id'];?>"><?php echo $dado['nome']; ?></option>
                            <?php }?>
                        </select>
                            <div class="form-group">
                        <label class="col-md-2" for = "lblDefeito">Defeito</label>
                        <input class="text-center col-md-7" type="text" 
                               name = "txtDefeito" placeholder="Informe o defeito da máquina">
                            <div class="form-group">
                        <label class="col-md-2" for = "lblReparo">Reparo</label>
                        <input class="text-center col-md-7" type="text" 
                               name = "txtReparo" placeholder="Informe o reparo realizado">
                </div>
                <div class="text-center col-md-10">
                <input type="submit" id="btEnviar" name ="btEnviar" 
                       class="btn btn-success" value="Gravar">
                <input type="reset" id="btLimpar" name ="btLimpar" 
                       class="btn btn-warning" value="Limpar">
            </form>
        </div>
</body>
</html>

<?php 
/*
$_POST['cbMaquina'] = "";
$_POST['cbLocal'] = "";
$_POST['cbEstagiario'] = "";
$_POST['txtDefeito'] = "";
$_POST['txtConserto'] = "";

echo $_POST['cbMaquina'];// = "";
echo $_POST['cbLocal'];// = "";
echo $_POST['cbEstagiario'];// = "";
echo $_POST['txtDefeito'];// = "";
echo $_POST['txtConserto'];// = "";
*/
?>