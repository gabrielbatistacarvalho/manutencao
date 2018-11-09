<?php

function confAccess(){
    // Verifica se NÃO existe Sessão
    if (!(isset($_SESSION)))
    {	
	// Starta a sessão
	    session_start();
    }
    // Verifica se existe algum problema no login
    if ($_SESSION['login'] != 'S') {	
	// Redireciona para a tela de login
	    header('Location: index.php');
    }
}

?>