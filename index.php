<?php
require_once('conexao.php');

session_start();
if (isset($_SESSION['login'])) {	
	$_SESSION['login'] = 'N';
}
if (isset($_POST['btnGravar'])) {
	$usuario = trim($_POST['txtUsuario']);
	$senha = md5(trim($_POST['txtSenha']));
	$sql_select = "SELECT * FROM login WHERE (usuario = '$usuario') AND (Senha = '$senha')";
	$query = mysqli_query($conexao, $sql_select);
	if (mysqli_num_rows($query) > 0)  {
		$_SESSION['login'] = 'S';
		$_SESSION['usuario'] = mysqli_fetch_assoc($query);
		//$_SESSION['autentica'] = true;
		header('Location: conserto.php');
		
	} else {
		echo "<script> alert('Usuário ou Senha invalido.'); </script>";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script type="text/javascript" src="js/validacao.js" charset="iso-8859-1"></script>
</head>
<body class="text-center">
<div class="container col-sm-4">
<form class="form-signin" method="POST" action="" id="frmDados" name="frmDados">
	<fieldset class="text-center">
	<br>
		<h1>Bem Vindo</h1>
		<label>Usuário</label>
		<input type="text" name="txtUsuario" id="txtUsuario" class="form-control" placeholder="Usuário" required="" 
			autofocus="" value="<?php echo (isset($_POST['txtUsuario'])) ? $_POST['txtUsuario'] : ''; ?>">	
		<label>Senha</label>
		<input type="password" name="txtSenha" id="txtSenha" class="form-control" placeholder="Password" required="" 
			value="<?php echo (isset($_POST['txtSenha'])) ? $_POST['txtSenha'] : ''; ?>">
			<br>
		<input class="btn btn-lg btn-primary btn-block" type="submit" name="btnGravar" 
			id="btnGravar" value="Entrar" onclick="return validaCampo();">
		<input class="btn btn-lg btn btn-info btn-block" id="lbl-conta" value="Criar uma conta"
			onclick="javascript:location.href='conta.php'">

	</fieldset>
	
      <p class="mt-5 mb-3 text-muted">© 2018-2018</p>
</form>
</div>

</body>
</html>