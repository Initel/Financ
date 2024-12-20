<?php
    include_once("./CRUD/Funcoes/loginout.php");
    include_once("./CRUD/Crud.php")
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="page">
        <form action="" method="POST" class="formLogin">
          <h1>Cadastre-se</h1>
          <p>Preencha os campos abaixo para criar sua conta.</p>
          <label for="nome">Nome Completo</label>                    
          <input type="text" id="nome" name="nome" placeholder="Digite seu nome" autofocus="true" required />


          <label for="email">E-mail</label>
          <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required />


          <label for="password">Senha</label>
          <!-- <input type="password" placeholder="Crie uma senha" required /> -->
          <input type="password" id="senha" name="senha" placeholder="Crie uma senha" required />


          <!-- <input type="submit" value="Cadastrar" class="btn" /> -->
          <input type="submit" name="cadastrar" value="Cadastrar" class="btn" />
          <p> Deseja voltar? <a href="./index.php">Login</a></p>


        </form>
    </div>
</body>
</html>


<!-- 
<form action="" method="post">
<input type="text" id="nome" name="nome">
<input type="password" id="senha" name="senha">
<input type="email" id="email" name="email">
<input type="submit" name="cadastrar" value="Cadastrar">
 -->