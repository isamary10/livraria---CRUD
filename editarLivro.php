<?php
    require_once('conexao.php');

    $consulta = $conexaoDB-> prepare('SELECT * from editora');
    $resultado = $consulta->execute();

    $editoras = $consulta->fetchAll(PDO::FETCH_ASSOC);

    // trazendo dados do livro
    $livroConsulta = $conexaoDB->prepare('SELECT * from produto where id_produto = :id_produto');
    $livroExecuta = $livroConsulta->execute([":id_produto" => $_GET['id']]);

    $livro = $livroConsulta->fetch(PDO::FETCH_ASSOC);

    // var_dump($livro);
    

    // verificar se o forumulário foi enviado
    if(isset($_POST['editar-livro'])) {
        // verificar campos preenchidos
        if($_POST['nome'] != "" && $_POST['descricao'] != "") {
            // prepara a query
            $query = $conexaoDB->prepare('UPDATE produto SET nome = :nome, descricao = :descricao, preco = :preco, fk_editora = :fk_editora, fk_categoria = 49, fk_autor = 41, imagem = "sem-imagem" WHERE id = :id_produto');
            var_dump($query);


            $resultado = $query->execute([
                ":id_produto" => $_GET['id'],
                ":nome" => $_POST['nome'],
                ":descricao" => $_POST['descricao'],
                ":preco" => $_POST['preco'],
                ":fk_editora" => $_POST['fk_editora']
            ]);
            var_dump($resultado);

            // se tudo der certo, redireciona para lista de livros
            header('location: livro.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Editar Livro</title>
</head>
<body>
    <div class="container my-5">
        <h1>Editar livro</h1>
    </div>
    <form action="" method="post" class="container">
        <label for="nomeProduto">Nome Produto:</label>
            <input type="text" id="nomeProduto" name="nome" class="form-control" value="<?php echo $livro['nome'];?>"><br>
        <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" id="descricao" class="form-control" value="<?php echo $livro['descricao'];?>"><br>
        <label for="preco">Preço:</label>
            <input type="number" name="preco" id="preco" class="form-control" value="<?php echo $livro['preco'];?>"><br>
        <label for="imagem">Imagem:</label>
            <input type="file" name="imagem" class="form-control"><br>
        <label for="fk_editora">Editora</label>
            <select name="fk_editora" id="fk_editora" class="form-control">
                <?php foreach($editoras as $editora) { ?>

                <option value="<?php echo $editora['id_editora'];?>"
                    <?php echo ($editora["id_editora"] == $livro['fk_editora']) ? "selected" : ""; ?>>
                    <?php echo $editora['nome']; ?>
                </option>
                <?php } ?>
            </select>
        <button name="editar-livro" class="btn btn-primary">Enviar</button>
    </form>
</body>
</html>