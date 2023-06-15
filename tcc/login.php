<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

// Obtém os valores enviados pelo formulário de login
$idusuario = $_POST ['idusuario'];
$emailusuario = $_POST['emailusuario'];
$senhausuario = $_POST['senhausuario'];

// Realiza a validação no banco de dados
$conexao = pg_connect("host=localhost port=5432 dbname=GestaoDeTrabalhos user=postgres password=JovemP*2023"); //conexão
pg_set_client_encoding($conexao, 'UTF8');

if (!$conexao) {
    echo "Erro de conexão com o banco de dados.";
}

$select = "SELECT * FROM usuarios WHERE email = '$emailusuario' AND senha = '$senhausuario'";
$resultado = pg_query($conexao, $select);

if (!$resultado) {
    echo "Erro na consulta.";
}

// Validação
if (pg_num_rows($resultado) == 1) {
    header("Location: sucesso.php?emailusuario=$emailusuario");
} else {

    // E-mail ou senha incorretos
    echo "<center><font face='Arial, sans-serif' size='3' color='red'><u>E-mail ou Senha incorretos</u></font></center>";
}
?>
</body>
</html>