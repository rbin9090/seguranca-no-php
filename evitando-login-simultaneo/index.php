<?php


session_start();

$objpdo = new PDO('mysql:host=localhost;dbname=database','root','');

if(isset($_POST['login']) && isset($_SESSION['login'])){
	$_SESSION['login'] = $_POST['login'];
	$_SESSION['token'] = uniqid();
	$sql = $pdo->prepare("DELETE FROM login WHERE login = ?");
	$sql->execute(array($_SESSION['login']));
	$sql = $pdo->prepare("INSERT INTO login VALUES (null,?,?)");
	$sql->execute(array($_SESSION['login'],$_SESSION['token']));
};

if (!isset($_POST['login'])) {
	echo 'realize seu login';
	echo '<form method="post"><input type="text" name="login"><input type="submit" value="logar"></form>';
}else{


//verificar se nao há outra sessão em progresso!
	$login = @$_SESSION['login'];
	$token = @$_SESSION['token'];

	$checar = $objpdo->prepare('SELECT `id` FROM login WHERE login = ? AND token = ?');

	$checar->execute(array($login,$token));

	if ($checar->rowCount() == 1) {
		echo 'ola'.$_SESSION['login'];
	}else{
		echo 'ops, voce esta sendo deslogado por que existe outro usuario na sua conta';
		session_destroy();
	}


	
}


?>