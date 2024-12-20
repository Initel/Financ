<?php
session_start();

include_once("./connect.php");

if (!isset($_SESSION["id"])) {
  header("Location: loginout.php");
  exit;
}

if ($_SESSION["id"] != 1) {
  header("Location: home.php");
  exit;
}

if (isset($_REQUEST["logout"]) && $_REQUEST["logout"] == true) {
  sleep(2);
  session_destroy();
  header("Location: index.php");
  exit;
}

?>

<!doctype html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
  </head>
    
  <body>
  <!-- <nav class="navbar navbar-expand-lg bg-body-tertiary"> -->
  <nav class="navbar navbar-expand-lg" style="background-color: #480ca8; color: #E1E1E1;">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"  style="color: #E1E1E1;">Finance</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./homeAdmin.php"  style="color: #E1E1E1;">Home</a>
        </li>


        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"  style="color: #E1E1E1;">
            Usuario
          </a>
          <ul class="dropdown-menu">

            <li class="nav-item"><a class="nav-link" href="?page=novo"  style="color: #3A3A3A">Criar usuario</a></li>
            <li class="nav-item"><a class="nav-link" href="?page=atualizar" style="color: #3A3A3A;">Atualizar infos</a></li>
            <li class="nav-item"><a class="nav-link" href="?page=excluir" style="color: #3A3A3A;">deletar usuario</a></li>
            <li><hr class="dropdown-divider"></li>
            <li class="nav-item"><a class="nav-link" href="?page=ler"  style="color: #3A3A3A;">listar usuarios</a></li>
          </ul>
        </li>


        
        <li class="nav-item">
          <a class="nav-link" href="?logout=true"  style="color: #E1E1E1;">Sair</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container">
  <div class="row">
    <div class="col mt-5">
    <?php
    $home = "./CRUD/Gestao.php";
    switch(@$_REQUEST["page"]){
      case "home": include_once($home); break;
      case "novo": include("./CRUD/P_create.php"); break;
      case "excluir": include("./CRUD/P_delete.php"); break;
      case "atualizar": include("./CRUD/P_update.php");break;
      case "ler": include("./CRUD/P_read.php"); break;
      case "calculadora": include("./CRUD/Calc.php");break;
      case "dF": include("./CRUD//dicasFinanc.php");break;
      default: include_once($home); break;
    }
  ?>
    </div>
  </div>
</div>


    <script src="./js/bootstrap.bundle.min.js"></script>
  </body>
</html>