<?php 
require_once("../../conexao.php");

// Dados recuperados do formulários
$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$tipo_pessoa = $_POST['tipo_pessoa'];
$id = $_POST['id'];

$antigo_email = $_POST['antigo_email'];
$antigo_cpf = $_POST['antigo_cpf'];


// VERIFICA SE E-MAIL JÁ FOI CADASTRADO
if ($antigo_email != $email) {
	$query_con = $pdo->prepare("SELECT * from fornecedores WHERE email = :email");
	$query_con->bindValue(":email", $email);
	$query_con->execute();
	$result = $query_con->fetchAll(PDO::FETCH_ASSOC);
	if (@count($result) > 0) {
		echo "Email do fornecedor já está cadastrado!";
		exit();
	}
}



// VERIFICA SE CPF JÁ FOI CADASTRADO
if ($antigo_cpf != $cpf) {
	$query_con = $pdo->prepare("SELECT * from fornecedores WHERE cpf = :cpf");
	$query_con->bindValue(":cpf", $cpf);
	$query_con->execute();
	$result = $query_con->fetchAll(PDO::FETCH_ASSOC);
	if (@count($result) > 0) {
		echo "O CPF / CNPJ DO fornecedor Já está cadastrado!";
		exit();
	}
}


if ($id == "") {
	// Inserindo novo registro
	$res = $pdo->prepare("INSERT INTO fornecedores SET nome = :nome, email = :email, cpf = :cpf, telefone = :telefone, endereco = :endereco, tipo_pessoa =:tipo_pessoa");
	$res->bindValue(":nome", $nome);
	$res->bindValue(":email", $email);
	$res->bindValue(":cpf", $cpf);
	$res->bindValue(":telefone", $telefone);
	$res->bindValue(":endereco", $endereco);
	$res->bindValue(":tipo_pessoa", $tipo_pessoa);
	$res->execute();
}else {
	// Atualizando registro existente através do ID
	$res = $pdo->prepare("UPDATE fornecedores SET nome = :nome, email = :email, cpf = :cpf, telefone = :telefone, endereco = :endereco, tipo_pessoa =:tipo_pessoa");
	$res->bindValue(":nome", $nome);
	$res->bindValue(":email", $email);
	$res->bindValue(":cpf", $cpf);
	$res->bindValue(":telefone", $telefone);
	$res->bindValue(":endereco", $endereco);
	$res->bindValue(":tipo_pessoa", $tipo_pessoa);
	$res->bindValue(":id", $id);
	$res->execute();
}

echo "Salvo com Sucesso!";

?>