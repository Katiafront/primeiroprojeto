<?php 
	require_once("conexao.php");
	@session_start();


	$usuario = $_POST['usuario'];
	$senha = $_POST['senha']; 


	$query_con = $pdo->prepare("SELECT * from usuario WHERE (email = :usuario or cpf = :usuario )and senha = :senha");
	$query_con->bindValue(":usuario", $usuario);
	$query_con->bindValue(":senha", $senha);
	$query_con->execute();
	$result = $query_con->fetchAll(PDO::FETCH_ASSOC);
	
	if (@count($result) > 0) {
		$nivel = $result[0]['nivel'];

		$_SESSION['nivel_usuario'] = $result[0]['nivel'];
		$_SESSION['nome_usuario'] = $result[0]['nome'];
		$_SESSION['cpf_usuario'] = $result[0]['cpf'];


		if ($nivel == "Administrador") {
			echo "<script language='javascript'>window.location='painel-admin'</script>";
		}
	} else {
		
		echo "<script language='javascript'>window.alert('Dados incorretos!')</script>";
		echo "<script language='javascript'>window.location='index.php'</script>";
	}
 ?>
