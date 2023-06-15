<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    
    <script type="text/javascript">
        //função que chama a lista da tabela

        function lista(){
            var url = 'listaRegistros.php?consulta=Sim';
            $.get(url, function (dataReturn){
                $('#listaUsuarios').html(dataReturn);
            });
        }
    </script>

</head>
<body>


    <!--quando o formulario for submetido, grava as informações-->
    <?php
    
    
    @$conexao = pg_connect("host=localhost port=5432 dbname=GestaoDeTrabalhos user=postgres  password=JovemP*2023");//conexão
    pg_set_client_encoding($conexao, 'UNICODE');

    //quando o form for submetido, ele grava informações
    if ($_POST):
        $idusuario = $_POST["idusuario"];
        $nomeusuario = $_POST["nomeusuario"] ;
        $sobrenome = $_POST ["sobrenome"];
        $senhausuario = $_POST["senhausuario"];
        $cidadeusuario = $_POST["cidadeusuario"];
        $emailusuario = $_POST["emailusuario"];
        $telefone = $_POST["telefone"];
        $cpf_cnpj = $_POST["cpf_cnpj"];
        $data_nasc = $_POST["data_nasc"];
        //$cep = $_POST["cep"]; //o cep é inutil
        $endereco = $_POST["endereco"];
        $rua = $_POST["rua"];
        $numero = $_POST["numero"];
        $complemento = $_POST["complemento"];
        $sexo = $_POST["idsexo"];
        $tipo_usuario = $_POST ["tipo_usuario"];
        
        //serviçal
        //$idservico = $_POST["idservico"];
        //$descicao_serv = $_POST["descricao_serv"];

        if (!@$conexao):
            echo "<script  language='javascript'>alert('não conectou.');</script>";
        else:
            if($idusuario == ''):
                $insert = "INSERT INTO usuarios (nome, sobrenome, senha, id_cidade, email, telefone, cpf_cnpj, data_nasc, endereco, rua, numero, complemento, sexo)
                VALUES (UPPER('$nomeusuario'), '$sobrenome', '$senhausuario', '$cidadeusuario', LOWER('$emailusuario'), '$telefone', '$cpf_cnpj', '$data_nasc', '$endereco', '$rua',
                '$numero', '$complemento', '$sexo')";

                
            
            pg_query($conexao,$insert);

            echo "<script language='javascript'>alert('Registro Gravado com Sucesso!!!');</script>";
            else:
                $update = "UPDATE usuarios
                SET nome = UPPER('$nomeusuario'), senha = '$senhausuario', id_cidade = '$cidadeusuario', email = LOWER('$emailusuario'), telefone = '$telefone',
                cpf_cnpj = '$cpf_cnpj', data_nasc = '$data_nasc', endereco = '$endereco', rua = '$rua', numero = '$numero', complemento = '$complemento', sexo = '$sexo',
                tipo_usuario = '$tipo_usuario', sobrenome = UPPER('$sobrenome')
                WHERE id_usuario = $idusuario";


                pg_query($conexao, $update);

                echo "<script language='javascript'>alert('Registro Atualizado');</script>";
            endif;
        endif;
    endif;
   ?>

    <!--cabeçalho da tela-->
    CADASTRO DE USUARIOS
    <p><p>
    <!--caixa que executa a ação dos botoes editar e excluir-->
    <iframe name="acao" width="0" height="0" frameborder="0" marginheight="0" marginwidth="0" scrolling="auto"></iframe> <!--nao ta chamando-->

    <!--form de preenchimento-->
    <form id="acaoform" action="usuarios.php" method="POST">
    <input type="hidden" id="idusuario" name="idusuario">
    <table>
        <tr>
            <td><label for="nomeusuario">NOME:</label></td>
            <td><input type="text" id="nomeusuario" name="nomeusuario" placeholder="Digite seu nome" maxlength="80" required></td>
        </tr>
        <tr>
            <td><label for="sobrenome">SOBRENOME:</label></td>
            <td><input type="text" id="sobrenome" name="sobrenome" placeholder="Digite seu sobrenome" maxlength="80" required></td>
        </tr>
        <tr>
            <td><label for="emailusuario">EMAIL:</label></td>
            <td><input type="text" id="emailusuario" name="emailusuario" placeholder="Digite seu email" maxlength="80" required></td>
        </tr>
        <tr>
            <td><label for="senhasuario">SENHA:</label></td>
            <td><input type="password" id="senhausuario" name="senhausuario" placeholder="Digite sua senha" maxlength="80" required></td>
        </tr>
        <tr>
            <td><label for="telefone">TELEFONE:</label></td>
            <td><input type="text" id="telefone" name="telefone" placeholder="Digite seu telefone" maxlength="80" required></td>
        </tr>
        <tr>
            <td><label for="cpf_cnpj">CPF / CNPJ:</label></td>
            <td><input type="text" id="cpf_cnpj" name="cpf_cnpj" placeholder="Digite seu cpf / cnpj" maxlength="80" required></td>
        </tr>
        <tr>
            <td><label for="data_nasc">DATA DE NASCIMENTO:</label></td>
            <td><input type="date" id="data_nasc" name="data_nasc" maxlength="80" required></td>
        </tr>
        <tr>
            <td><label for="cidadeusuario">CIDADE:</label></td>
            <td>
                <select id="cidadeusuario" name="cidadeusuario" required>
                    <option value="" selected>SELECIONE:</option>
                    <?php
                    $select = "SELECT id_cidade, nome FROM cidades ORDER BY nome";
                    $resultado = pg_query($conexao, $select);
                    while ($linha = pg_fetch_array($resultado)){
                        $idcidade = $linha[0];
                        $nomecidade = $linha[1];
                        echo "<option value='$idcidade'>$nomecidade</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="endereco">ENDEREÇO:</label></td>
            <td><input type="text" id="endereco" name="endereco" placeholder="Digite seu endereço" maxlength="80" required></td>
        </tr>
        <tr>
            <td><label for="rua">RUA:</label></td>
            <td><input type="text" id="rua" name="rua" placeholder="Digite sua rua" maxlength="80" required></td>
        </tr>
        <tr>
            <td><label for="numero">NÚMERO DA SUA CASA:</label></td>
            <td><input type="text" id="numero" name="numero" placeholder="Digite o número da sua casa" maxlength="80" required></td>
        </tr>
        <tr>
            <td><label for="complemento">COMPLEMENTO:</label></td>
            <td><input type="text" id="complemento" name="complemento" placeholder="complemento" maxlength="80"></td>
        </tr>
        <tr>
            <td><label for="sexo">SEXO:</label></td>
            <td>
                <select id="idsexo" name="idsexo" required>
                    <option value="" selected>SELECIONE:</option>
                    <?php
                    $select = "SELECT id_sexo, sexo FROM sexo ORDER BY sexo";
                    $resultado2 = pg_query($conexao, $select);
                    while ($linha = pg_fetch_array($resultado2)){
                        $idsexo = $linha[0];
                        $sexo= $linha[1];
                        echo "<option value='$idsexo'>$sexo</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="tipo_usuario">O QUE VOCÊ PRETENDE SER?</label></td>
            <td>
                <select id="tipo_usuario" name="tipo_usuario" required onchange="toggleBotao(this.value)">
                    <option value="" selected>SELECIONE:</option>
                    <option value="Cliente">Cliente</option>
                    <option value="Serviçal">Serviçal</option>
                    <option value="Ambos">Ambos</option>
                    <?php
                    $select = "SELECT tipo_usuario FROM usuarios";
                    $resultado3 = pg_query($conexao, $select);
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit" name="btsalvar" id="btsalvar">SALVAR</button>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <a href="index.php"><button type="button">VOLTAR</button></a>
            </td>
        </tr>
    </table>
</form>
<!--<div style="height:20px"> não funciona
    <button type="submit" name="botaotipo" id="tipo" disabled>CADASTRO DE SERVIÇAL</button>
    <script language="javascript">
        function toggleBotao(valor) {
        var botao = document.getElementById("botaotipo");
        if (valor === "A" || valor === "S") {
            
            botao.disabled = false;
        } else {
            botao.disabled = true;
        }
        }
    </script>
</div>-->



    

    <!--lista dos registros gravados no banco-->
    <div id="listaUsuarios">
        <?php include "listaRegistros.php"?>
    </div>
    
    
    </body>
</html>

    <script language="javascript">
    function AcaoUsuario(id, acao) {
    window.open('acao.php?Tipo=' + acao + '&idusuario=' + id, 'acao');
    }
</script>