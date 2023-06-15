<?php
$Tipo = $_GET['Tipo']; //tipo excluir ou tipo editar
$idusuario = $_GET['idusuario'];


@$conexao = pg_connect("host=localhost port=5432 dbname=GestaoDeTrabalhos user=postgres  password=JovemP*2023");//conexão
pg_set_client_encoding($conexao, 'UNICODE');

if ($Tipo == "ED"):
    $select = "SELECT usuarios.id_usuario, usuarios.nome, usuarios.sobrenome, usuarios.senha, usuarios.email,
    usuarios.id_cidade, usuarios.telefone, usuarios.cpf_cnpj, usuarios.data_nasc, usuarios.endereco, usuarios.rua,
    usuarios.numero, usuarios.complemento, usuarios.sexo, tipo_usuario
        FROM usuarios
        WHERE usuarios.id_usuario = $idusuario";

    $resultado = pg_query($conexao,$select);
    while ($linha = pg_fetch_array($resultado)){
        $idusuario = $linha[0];
        $nomeusuario = $linha[1];
        $sobrenome = $linha[2];
        $senhausuario = $linha[3];
        $emailusuario = $linha[4];
        $cidadeusuario = $linha[5];
        $telefone = $linha[6];
        $cpf_cnpj = $linha[7];
        $data_nasc = $linha[8];
        $endereco = $linha[9];
        $rua = $linha[10];
        $numero = $linha[11];
        $complemento = $linha[12];
        $sexo = $linha[13];
        $tipo_usuario = $linha [14];
        


        echo "<script language='javascript'>
            window.parent.document.getElementById('idusuario').value='$idusuario';
            window.parent.document.getElementById('nomeusuario').value='$nomeusuario';
            window.parent.document.getElementById('sobrenome').value='$sobrenome';
            window.parent.document.getElementById('senhausuario').value='$senhausuario';
            window.parent.document.getElementById('emailusuario').value='$emailusuario';
            window.parent.document.getElementById('cidadeusuario').value='$cidadeusuario';
            window.parent.document.getElementById('telefone').value='$telefone';
            window.parent.document.getElementById('cpf_cnpj').value='$cpf_cnpj';
            window.parent.document.getElementById('data_nasc').value='$data_nasc';
            window.parent.document.getElementById('endereco').value='$endereco';
            window.parent.document.getElementById('rua').value='$rua';
            window.parent.document.getElementById('numero').value='$numero';
            window.parent.document.getElementById('complemento').value='$complemento';
            window.parent.document.getElementById('idsexo').value='$sexo';
            window.parent.document.getElementById('tipo_usuario').value='$tipo_usuario';
            </script>";
    }
elseif ($Tipo == 'EX'):
    $delete = "DELETE FROM usuarios 
    WHERE usuarios.id_usuario = '$idusuario'";

    pg_query($conexao, $delete);

    echo "<script language='javascript'>alert('Registro Excluido com Sucesso');
        window.parent.lista();
        </script>";
endif;
?>