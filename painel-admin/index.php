<?php 
require_once('../config.php');
@session_start();


// VERIFICAR PERMISSÃO DO USUÁRIO 

if (@$_SESSION['nivel_usuario'] != 'Administrador') {
  echo "<script language='javascript'>window.location='../login.php'</script>";
 }
  // Variaveis do menu administrativo
$menu1 = 'home';
$menu2 = 'usuarios';
$menu3= 'fornecedores';
$menu4= 'categorias';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <link rel="stylesheet" type="text/css" href="../vendor/DataTables/datatables.min.css"/>
  
  <script type="text/javascript" src="../vendor/DataTables/datatables.min.js"></script>


  <title>Painel Administrativo</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Administrador</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php?pagina=<?php echo $menu1 ?>">Home <span class="sr-only">(página atual)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?pagina=<?php echo $menu2 ?>">Usuarios</a>
        </li>
        <li class="nav-item">
         <a class="nav-link" href="index.php?pagina=<?php echo $menu3 ?>">Fornecedores</a>
       </li>

       <li class="nav-item">
         <a class="nav-link" href="index.php?pagina=<?php echo $menu4 ?>">Categorias</a>
       </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Produtos
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Cadastro de Produtos</a>
            <a class="dropdown-item" href="index.php?pagina=<?php echo $menu4 ?>">Cadastro de Categorias</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Algo mais aqui</a>
          </div>
        </li>
      </ul>
      <div class="form-inline my-2 my-lg-0">
       <img src="../img/icone_user.png" alt="" width=80>
       <div class="dropdown">
        <button class="btn btn-ligt dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $_SESSION['nome_usuario'] ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#">Editar</a>
          <a class="dropdown-item" href="../logout.php">Sair</a>
        </div>
      </div>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <?php 
  if (@$_GET['pagina'] == $menu1) {
    require_once($menu1. '.php');
  }
  if (@$_GET['pagina'] == $menu2){
    require_once($menu2. '.php');
  }
  if (@$_GET['pagina'] == $menu3){
    require_once($menu3. '.php');
  }
  if (@$_GET['pagina'] == $menu4){
    require_once($menu4. '.php');
  }
 

  ?>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script type="text/javascript" src="../vendor/js/mascaras.js"></script>