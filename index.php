<?php
    include("./CRUD/Funcoes/loginout.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="main.css">
    </head>
<body>
    <div class="page">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="formLogin">
            <h1>Entre no App</h1>
            <p>Digite os seus dados de acesso nos campos abaixo.</p>
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="Digite seu e-mail" autofocus="true" required />
            <label for="password">Senha</label>
            <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required >            
            <input type="submit" name="login" value="Login" class="btn">  
            <p>Não tem uma conta? <a href="./cadastro.php">Cadastre-se aqui</a></p>
        </form>
    </div>


  </body>
</html>