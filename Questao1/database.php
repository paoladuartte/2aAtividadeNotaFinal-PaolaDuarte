<?php
$dbFile = 'livraria.db';

try{
    $db = new PDO("sqlite:" .$dbFile);

    $db -> setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);

    $db->exec("
        CREATE TABLE IF NOT EXISTS livros(
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            titulo TEXT NOT NULL,
            autor TEXT NOT NULL,
            ano INTEGER NOT NULL
        );
    ");
} catch (PDOException $e){
    die("Erro ao conectar ao banco" . $e->getMessage());
}
?>