<?php //conecxao com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "sistema_pedidos";
    $conn = new mysqli($servername, $username, $password, $dbname);
        if($conn -> connect_error){
            die('Conexão falhou'.$conn -> connect_error);
        }

    if(isset($_POST['create'])){ //quando o formulario é enviado na mesma pagina isset e seu nome é create
        $nome_cliente = $_POST['nome'];
        $produto = $_POST['produto'];
        $quantidade = $_POST['quantidade'];
        $data_pedido = $_POST['data_pedido'];
 

        $sql= "INSERT INTO pedidos (nome_cliente , nome_produto, quantidade, data_pedido) VALUES ('$nome_cliente','$produto', '$quantidade', '$data_pedido')";
        if($conn -> query($sql) === true){
            echo"Novo pedido adicionado com sucesso.";
        }else{
            echo "Erro: ". $sql . "<br>" . $conn -> error;
        }
    }
    if(isset($_GET['deletar'])){
        $id = $_GET['deletar'];
        $sql = "DELETE FROM pedidos WHERE id = '$id'";
        if($conn -> query($sql) === true){
            echo"Novo pedido excluido com sucesso.";
        }else{
            echo "Echo". $sql . "<br>" . $conn -> error;
        }
    }
    if(isset($_GET['reiniciar'])){
        $sql = "TRUNCATE pedidos";
        if($conn -> query($sql) === true){
            echo"Banco reiniciado com sucesso";
        }else{
            echo "Echo". $sql . "<br>" . $conn -> error;
        }
    }

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $upd_nome_cliente = $_POST['upd_nome'];
        $upd_produto = $_POST['upd_produto'];
        $upd_quantidade = $_POST['upd_quantidade'];
        $upd_data_pedido = $_POST['upd_data_pedido'];

        $sql = "UPDATE pedidos SET nome_cliente = '$upd_nome_cliente', nome_produto = '$upd_produto', quantidade = '$upd_quantidade', data_pedido = '$upd_data_pedido' WHERE id = '$id'";
        if($conn -> query($sql) === true){
            echo"Edição realizada com sucesso";
        }else{
            echo "Echo". $sql . "<br>" . $conn -> error;
        }
    }

$result = $conn -> query("SELECT * FROM pedidos");// recebe a matriz do banco
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Crud Icaro</title>
</head>
<body>
    <form method="POST" action="index_icaro.php">
        Nome Cliente : <input type='text' name='nome' required> <br><br>
        Nome Produto : <input type='text' name='produto' required> <br><br>
        Quantidade : <input type='text' name='quantidade' required> <br><br>
        Data Pedido : <input type='date' name='data_pedido' required> <br><br>
        <input type="submit" name="create" value="Adicionar Pedido"> <br><br>
        <a href="index_icaro.php?reiniciar">Reiniciar banco</a>
    </form>
    <h2>Ler os Pedidos</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome Cliente</th>
            <th>Nome Produto</th>
            <th>Quantidade</th>
            <th>Data Produto</th>
            <th>Açoes</th>
        </tr>
        <?php while($row = $result-> fetch_assoc()){//loop que tras as linhas enquanto tiver
        ?>
        <tr>
            <td><?php echo $row['id'];?></td>
            <td><?php echo $row['nome_cliente'];?></td>
            <td><?php echo $row['nome_produto'];?></td>
            <td><?php echo $row['quantidade'];?></td>
            <td><?php echo $row['data_pedido'];?></td>
            <td>
                <a href='index_icaro.php?deletar=<?php echo $row['id']?>'>Excluir</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <h2>Editar</h2>
    <form method="POST" action="index_icaro.php">
        Nome Cliente : <input type='text' name='upd_nome' required> <br><br>
        Nome Produto : <input type='text' name='upd_produto' required> <br><br>
        Quantidade : <input type='text' name='upd_quantidade' required> <br><br>
        Data Pedido : <input type='date' name='upd_data_pedido' required> <br><br>
        ID : <input type='text'name='id' required> <br><br>
        <input type="submit" name="update" value="Editar Pedido"> <br><br>
    </form>
</body>
</html>