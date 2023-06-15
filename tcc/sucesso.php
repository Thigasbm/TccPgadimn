<?php

$email_usuario = $_GET['emailusuario'];

$conexao = pg_connect("host=localhost port=5432 dbname=GestaoDeTrabalhos user=postgres password=JovemP*2023"); //conexão
pg_set_client_encoding($conexao, 'UNICODE');

if (!$conexao) {
    echo "<font color='red'>Erro de conexão com o banco de dados.</font>";
    exit;
}

$select = "SELECT usuarios.id_usuario, usuarios.nome, usuarios.sobrenome, usuarios.email, usuarios.senha, cidades.nome, usuarios.endereco,
           usuarios.rua, usuarios.numero
           FROM usuarios
           INNER JOIN cidades ON usuarios.id_cidade = cidades.id_cidade
           WHERE usuarios.email = '$email_usuario'";

$resultado = pg_query($conexao, $select);
if (!$resultado) {
    echo "Erro na consulta ao banco de dados.";
    exit;
}

$linha = pg_fetch_array($resultado);

$idusuario = $linha[0];
$nomeusuario = $linha[1];
$sobrenome = $linha[2];
$emailusuario = $linha[3];
$senhausuario = $linha[4];
$cidadeusuario = $linha[5];
$endereco = $linha[6];
$rua = $linha[7];
$numero = $linha[8];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suas Credenciais</title>
</head>
<body>
    <font face="Arial, sans-serif" size="4" color="#333">
        Bem Vindo <?php echo $nomeusuario ?>!<br>
        <table width="100%" border="1">
            <thead>
                <th>NOME</th>
                <th>SOBRENOME</th>
                <th>EMAIL</th>
                <th>SENHA</th>
                <th>CIDADE</th>
                <th>ENDERECO</th>
                <th>RUA</th>
                <th>NUMERO</th>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $nomeusuario; ?></td>
                    <td><?php echo $sobrenome; ?></td>
                    <td><?php echo $emailusuario; ?></td>
                    <td><?php echo $senhausuario; ?></td>
                    <td><?php echo $cidadeusuario; ?></td>
                    <td><?php echo $endereco; ?></td>
                    <td><?php echo $rua; ?></td>
                    <td><?php echo $numero; ?></td>
                </tr>
            </tbody>
        </table>
    </font>
</body>
</html>