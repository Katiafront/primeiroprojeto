<?php 
require_once("../../conexao.php");

// Dados recuperados do formulários
$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];
$nivel = $_POST['nivel'];
$id = $_POST['id'];

$antigo_email = $_POST['antigo_email'];
$antigo_cpf = $_POST['antigo_cpf'];


// VERIFICA SE E-MAIL JÁ FOI CADASTRADO
if ($antigo_email != $email) {
	$query_con = $pdo->prepare("SELECT * from usuario WHERE email = :email");
	$query_con->bindValue(":email", $email);
	$query_con->execute();
	$result = $query_con->fetchAll(PDO::FETCH_ASSOC);
	if (@count($result) > 0) {
		echo "Email já foi cadastrado!";
		exit();
	}
}



// VERIFICA SE CPF JÁ FOI CADASTRADO
if ($antigo_cpf != $cpf) {
	$query_con = $pdo->prepare("SELECT * from usuario WHERE cpf = :cpf");
	$query_con->bindValue(":cpf", $cpf);
	$query_con->execute();
	$result = $query_con->fetchAll(PDO::FETCH_ASSOC);
	if (@count($result) > 0) {
		echo "O CPF já foi cadastrado!";
		exit();
	}
}


if ($id == "") {
	// Inserindo novo registro
	$res = $pdo->prepare("INSERT INTO usuario SET nome = :nome, email = :email, cpf = :cpf, senha = :senha, nivel = :nivel");
	$res->bindValue(":nome", $nome);
	$res->bindValue(":email", $email);
	$res->bindValue(":cpf", $cpf);
	$res->bindValue(":senha", $senha);
	$res->bindValue(":nivel", $nivel);
	$res->execute();
}else {
	// Atualizando registro existente através do ID
	$res = $pdo->prepare("UPDATE usuario SET nome = :nome, email = :email, cpf = :cpf, senha = :senha, nivel = :nivel WHERE id = :id");
	$res->bindValue(":nome", $nome);
	$res->bindValue(":email", $email);
	$res->bindValue(":cpf", $cpf);
	$res->bindValue(":senha", $senha);
	$res->bindValue(":nivel", $nivel);
	$res->bindValue(":id", $id);
	$res->execute();
}

echo "Salvo com Sucesso!";

?>