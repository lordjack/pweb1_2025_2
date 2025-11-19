<?php
include '../header.php';
include '../database/db.class.php';

$db = new db('post');
//var_dump($dados);
$db->checkLogin();

if (!empty($_GET['id'])) {
    $db->destroy($_GET['id']);
}

if (!empty($_POST)) {
    $dados = $db->search($_POST);
} else {
    $dados = $db->all();
}

?>

<h3>Listagem Postagem</h3>

<form action="./PostList.php" method="post">
    <div class="row">
        <div class="col">
            <select name="tipo" class="form-select">
                <option value="titulo">Titulo</option>
                <option value="status">Status</option>
                <option value="data_publicacao">Data Publicação</option>
            </select>
        </div>

        <div class="col">
            <input type="text" name="valor" placeholder="Pesquisar" class="form-control">
        </div>

        <div class="col">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="./PostForm.php" class="btn btn-success">Cadastrar</a>
        </div>
    </div>
</form>

<div class="row mt-4">
    <div class="col">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Data Publicação</th>
                    <th scope="col">Status</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Usuário</th>
                    <th scope="col">Ação</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($dados as $item) {

                    $dbCategoria = new db('categoria');
                    $categoria = $dbCategoria->find($item->categoria_id);

                    $dbUsuario = new db('usuario');
                    $usuario = $dbUsuario->find($item->usuario_id);

                    $status = $item->status == 1 ? "Publicado" : "Não Publicado";

                    echo "<tr>
                        <th scope='row'>$item->id</th>
                        <td>$item->titulo</td>
                        <td>$item->data_publicacao</td>
                        <td>$status</td>
                        <td>$categoria->nome</td>
                        <td>$usuario->nome</td>
                        <td><a href='./PostForm.php?id=$item->id'>Editar</a></td>
                        <td><a 
                             href='./PostList.php?id=$item->id'
                             onclick='return confirm(\"Deseja Excluir?\")'
                            >Deltar</a></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>


    </div>
</div>


<?php
include '../footer.php';
?>