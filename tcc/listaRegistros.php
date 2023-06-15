<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
</head>

<body>
    <?php
    $_GETconsulta = ['consulta'];

    if ($consulta = "Sim"):
        @$conexao = pg_connect("host=localhost port=5432 dbname=GestaoDeTrabalhos user=postgres  password=JovemP*2023");//conexão
        pg_set_client_encoding($conexao, 'UNICODE');
    endif;
    ?>

    <table width="100%" border="1">
        <thead>
            <th>NOME</th>
            <th>SOBRENOME</th>
            <th>EMAIL</th>
            <th>CIDADE</th>
            <th colspan="2">AÇÕES</th>
        </thead>
        <tbody>
            <?php
        $select = "SELECT usuarios.id_usuario, usuarios.nome, usuarios.sobrenome, usuarios.email, cidades.nome
           FROM usuarios INNER JOIN cidades ON usuarios.id_cidade = cidades.id_cidade
           ORDER BY usuarios.nome";

        $resultado = pg_query($conexao, $select);
        
while ($linha = pg_fetch_array($resultado)) {
    $idusuario = $linha[0];
    $nomeusuario = $linha[1];
    $sobrenome = $linha[2];
    $emailusuario = $linha[3];
    $cidadeusuario = $linha[4];
    ?>
    <tr>
        <td><?php echo $nomeusuario; ?></td>
        <td><?php echo $sobrenome; ?></td>
        <td><?php echo $emailusuario; ?></td>
        <td><?php echo $cidadeusuario;?></td>
        <td width="10%" align="center"><a href="#" onclick="AcaoUsuario(<?php echo $idusuario; ?>, 'EX')"><button>EXCLUIR</button></a></td>
        <td width="10%" align="center"><a href="#" onclick="AcaoUsuario(<?php echo $idusuario; ?>, 'ED')"><button>EDITAR</button></a></td>
    </tr>
    <?php
    }
    ?>
        </tbody>
    </table>
</body>
</html>