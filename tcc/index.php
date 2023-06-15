<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Serviços</title>
</head>
<body>
<font face="Arial, sans-serif" size="3" color="#333">

<form action="login.php" method="POST">
    <table>
        <tr>
            <td><label for="emailusuario">Email:</label></td>
            <td><input type="text" id="emailusuario" name="emailusuario" placeholder="Digite seu email" maxlength="80" required></td>
        </tr>
        <tr>
            <td><label for="senhausuario">Senha:</label></td>
            <td><input type="password" id="senhausuario" name="senhausuario" placeholder="Digite sua senha" maxlength="80" required></td>
        </tr>
        <tr>
            <td align="center">
                <button type="submit">Entrar</button>
            </td>
        </tr>
    </table>
</form>

<br>
Não possui login? Cadastre-se agora!<br>
<a href="usuarios.php"><button>Cadastro</button></a>
</body>
</html>
