<?php require 'database.php'; ?>

<!DOCTYPE html>
<html lang = "pt-br">
    <head>
        <meta charset = "UTF-8">
        <title> Livraria Online</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                padding: 20px;
            }

            li {
                margin-bottom: 8px;
                background-color: #d2d2ddff;
                border-radius: 20px;
                list-style-type: none;
                padding: 15px 15px;

            }
            .container{
                width: 500px;
                margin: 100px auto;
                background-color: #e3e6ecff;
                border-radius: 15px;
                box-shadow: 0px 15px 20px 0px rgba(42, 48, 82, 1);
                text-align: center;
                padding: 60px 30px;
            }
            #titulo{
                color: #0e136bff;
            }
            #adicionar{
                color: #2c2c2cff;
                font-size:18px;

            }
            #cadastrados{
                color: #2c2c2cff;
                font-size:18px;
            }
            button{
                background-color: #e3e0f9ff;
                border-color: #0e136bff; display: inline-block;
                padding: 6px 14px;
                border-radius: 20px;
                text-decoration: none;
                color:#444445;
                margin:0 10px;
                font-weight: 200;
                transition: 0.3s;
                font-size: 13px;
            }
        </style>
    </head>
    <body>
        <div class = "container">
            <h1 id="titulo"> Bem Vindo a Livraria Online </h1>
            <h2 id="adicionar"> Adicionar Livro</h2>
            <form action ="add_book.php" method="POST">
                <label>Título:</label>
                <input type="text" name="titulo" required><br><br>
                <label>Autor:</label>
                <input type="text" name="autor" required><br><br>
                <label>Ano:</label>
                <input type="number" name="ano" required><br><br>
                <button type="submit">Adicionar</button>  
            </form>
            <h2 id="cadastrados">Livros Cadastrados</h2>

            <?php
            $result = $db->query("SELECT * FROM livros");
            $livros = $result->fetchAll(PDO::FETCH_ASSOC);

            if (count($livros) === 0) {
                echo "Nenhum livro cadastrado.";
            } else {
                echo "<ul>";
                foreach ($livros as $row) {
                    echo "<li>";
                    echo "<strong>ID:</strong> {$row['id']} — ";
                    echo "<strong>Título:</strong> {$row['titulo']} — ";
                    echo "<strong>Autor:</strong> {$row['autor']} — ";
                    echo "<strong>Ano:</strong> {$row['ano']} ";
                    echo "<a href='delete_book.php?id={$row['id']}' onclick='return confirmarExclusao({$row['id']})' style='color:red;'>Excluir</a>";
                    echo "</li>";
                }
                echo "</ul>";
            }
            ?>
            <script>
                function confirmarExclusao(id) {
                    return confirm("Tem certeza que deseja excluir o livro ID " + id + "?");
                }

                function validarFormulario() {
                    let titulo = document.querySelector("input[name='titulo']").value;
                    let autor = document.querySelector("input[name='autor']").value;
                    let ano = document.querySelector("input[name='ano']").value;

                    if (titulo.trim() === "" || autor.trim() === "" || ano.trim() === "") {
                        alert("Preencha todos os campos!");
                        return false;
                    }

                    if (ano < 0) {
                        alert("Ano inválido!");
                        return false;
                    }

                    return true;
                }
            </script>
        </div>
    </body>
</html>