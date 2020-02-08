<?php 
    require_once ('conexao.php');

    $consultaDB = $conexaoDB->prepare('SELECT * from produto');
    $consulta = $consultaDB->execute();

    $livros = $consultaDB->fetchAll(PDO::FETCH_ASSOC);

    // foreach($livros as $livro){   
    //     echo $livro["nome"]."<br>".$livro["descricao"]."<br>".$livro["preco"]."<hr>";
// }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Livraria</title>
</head>
<body>
    <div class="container my-5">
        <div class="row">
            <div class="col">
                <h1>Livraria</h1>
            </div>
            <div class="col">
                <a href="cadastroLivro.php" class="btn btn-primary">Cadastrar</a>
            </div>
        </div>
    </div>
    <table class="table container">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Categoria</th>
                <th>Editora</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($livros as $livro) : ?>
                <tr>
                    <td><?php echo $livro['nome'] ?></td>
                    <td><?php echo $livro['descricao'] ?></td>
                    <td><?php echo $livro['preco'] ?></td>
                    <td><?php echo $livro['fk_categoria'] ?></td>
                    <td><?php echo $livro['fk_editora'] ?></td>
                    <td>
                        <a href="editarLivro.php?id=<?php echo $livro['id_produto']?>">editar</a>
                        <a href="excluirLivro.php?id=<?php echo $livro['id_produto']?>">excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>