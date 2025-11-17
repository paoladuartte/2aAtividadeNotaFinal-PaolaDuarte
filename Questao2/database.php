<?php
$dbFile = 'tarefas.db';

try {
    $db = new PDO("sqlite:" . $dbFile);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db->exec("
        CREATE TABLE IF NOT EXISTS tarefas(
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            descricao TEXT NOT NULL,
            vencimento TEXT NOT NULL,
            concluida INTEGER DEFAULT 0
        );
    ");
} catch(PDOException $e) {
    die("Erro ao conectar ao banco: " . $e->getMessage());
}
?>
