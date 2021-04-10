<?php
//session_start();
var_dump(session_status());

if(!isset($_SESSION['usuario'],$_SESSION['senha'],$_SESSION['id']))
{
    echo "Não tem ninguem logado";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <form method="POST">
<<<<<<< Updated upstream:login.php
        Usuario: <input type="text" name='login'/><br><br>
        Senha: <input type="password" name='senha'/><br><br>
        <button type="submit">Logar</button>
    </form>]
    <a href="?controle=usuario&metodo=CadastrarUsuario"></a>
=======
        Nome: <input type="text" name="login"/><br><br>
        Senha: <input type="password" name="senha"/><br><br>
        <button type="submit">Entrar</button>
    </form>
    <br><br>
    <a href="?controle=usuario&metodo=cadastrarUsuario">Cadastre-se</a>
>>>>>>> Stashed changes:Views/logarUsuario.phtml
</body>
</html>