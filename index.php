<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <title>Pedidos</title>
</head>
<body>
    <form method="POST" action="index.php">
        <label for="nome">Nome completo:</label> 
        <input type="text" name="nome" required> <br><br>
        <label for="quantidade">Quantidade de itens:</label>
        <input type="text" name="quantidade" required> <br><br>
        <label for="nome_produto">Nome do item:</label>
        <input type="text" name="nome_produto" required> <br><br>
        <label for="data_entrega">Quando quer receber seu pedido?</label>
        <input type="date" name="data_entrega" required> <br><br>
        <input type="submit" name="create" value="Adicionar Pedido"> 
    </form>
</body>
</html>

<?php

    $servername = 'localhost';
    $username = 'root';
    $password = 'root';
    $dbname = 'sistema_pedidos';
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn -> connect_error){
        die('Conexão falhou:' . $conn -> connect_error);
    }

    if(isset($_POST['create'])){
        $nome = $_POST['nome'];
        $quantidade = $_POST['quantidade'];
        $nome_produto = $_POST['nome_produto'];
        $data = ['data_entrega'];

        $sql = "INSERT INTO pedidos (nome_cliente, nome_produto, quantidade, data_pedido) VALUES ('$nome', '$nome_produto', ' $quantidade', '$data'";
        if($conn -> query($sql) === TRUE){
            echo 'Novo registro adicionado';
        } else{
            echo 'Erro: ' . $sql . '<br>' . $conn -> error;
        }
    }

?>