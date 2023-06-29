
<?php 
require_once("../../conexao.php");

// Recuperando ID que veio do campo oculto do form-excluir

$id = $_POST['id'];
$query_con = $pdo->query("DELETE from categorias  WHERE id = '$id'");
echo 'Excluído com Sucesso!';

 ?>