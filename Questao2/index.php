<?php
require 'database.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset = "UTF-8">
        <title>Gerenciador de Tarefas</title>
        <style>
            body { 
                font-family: Arial; 
                padding: 20px; 
                background-color: #fff5e9ff;
            }
            h2{ 
                margin-top: 30px; 
            }
            li { 
                margin-bottom: 8px; 
            }
            .concluir { 
                color: gray; 
            }
            #tarefas-pedentes{
                background-color: #fcbcbcff; 
            }
            #tarefas-concluidas{
                background-color: #bcfcc0ff; 
            }
        </style>
    </head>
    <body>
        <h1 id="titulo">Gerenciador de Tarefas</h1>
        <h2 id="adicionar-tarefa">Adicionar Tarefa</h2>
        <form action="add_tarefa.php" method="POST" onsubmit="return validarFormulario()">
            <label>Descrição:</label>
            <input type="text" name="descricao"><br><br>
            <label>Data de Vencimento:</label>
            <input type="date" name="vencimento"><br><br>
            <button type="submit">Adicionar</button>
        </form>
        <br><br>
        
        <h3>Tarefas Pedentes</h3>
        <?php
        $consulta = $db->query("SELECT * FROM tarefas WHERE concluida = 0 ORDER BY vencimento ASC");
        $pendentes = $consulta->fetchAll(PDO::FETCH_ASSOC);

        if (count($pendentes) === 0) {
            echo "Nenhuma tarefa pendente.";
        } else {
            echo "<ul id='tarefas-pedentes'>";
            foreach ($pendentes as $t) {
                echo "<li>";
                echo "<strong>{$t['descricao']}</strong> — Vence em: {$t['vencimento']} ";
                echo "<a href='update_tarefa.php?id={$t['id']}'>Concluir</a> ";
                echo "<a href='delete_tarefa.php?id={$t['id']}' style='color:red;' onclick='return confirmarExclusao()'>Excluir</a>";
                echo "</li>";
            }
            echo "</ul>";
        }
        ?>

        <h3>Tarefas Concluídas</h3>
        <?php
        $consulta2 = $db->query("SELECT * FROM tarefas WHERE concluida = 1 ORDER BY vencimento ASC");
        $concluidas = $consulta2->fetchAll(PDO::FETCH_ASSOC);

        if (count($concluidas) === 0) {
            echo "Nenhuma tarefa concluída.";
        } else {
            echo "<ul id='tarefas-concluidas'>";
            foreach ($concluidas as $t) {
                echo "<li class='concluir'>";
                echo "<strong>{$t['descricao']}</strong> — Vencimento: {$t['vencimento']} ";
                echo "<a href='delete_tarefa.php?id={$t['id']}' style='color:red;' onclick='return confirmarExclusao()'>Excluir</a>";
                echo "</li>";
            }
            echo "</ul>";
        }
        ?>
        <script>
            function confirmarExclusao() {
                return confirm("Tem certeza que deseja excluir esta tarefa?");
            }
            function validarFormulario() {
                let desc = document.querySelector("input[name='descricao']").value;
                let data = document.querySelector("input[name='vencimento']").value;

                if (desc.trim() === "" || data.trim() === "") {
                    alert("Preencha todos os campos!");
                    return false;
                }

                return true;
            }
        </script>

    </body>
</html>