<?php
require 'database.php';

if($_SERVER["REQUEST_METHOD"] === "POST"){
        $descricao = $_POST['descricao'];
        $vencimento = $_POST['vencimento'];

        $stmt = $db->prepare("INSERT INTO tarefas (descricao, vencimento) VALUES(?,?)");
        $stmt->execute([$descricao, $vencimento]);

        header("Location: index.php");
        exit;
    }

?>