<?php
include '../header.php';
include '../db.class.php';

$db = new db();
$dados = $db->all();

//var_dump($dados);
//exit;

?>

<h3>Listagem Usuário</h3>

<form action="" method="post">
    <div class="row">
        <div class="col">
            <select name="tipo" class="form-select">
                <option value="nome">Nome</option>
                <option value="cpf">CPF</option>
                <option value="telefone">Telefone</option>
            </select>
        </div>

        <div class="col">
            <input type="text" name="valor" placeholder="Pesquisar" class="form-control">
        </div>

        <div class="col">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="./UsuarioForm.php" class="btn btn-success">Cadastrar</a>
        </div>
    </div>
</form>

<div class="row mt-4">
    <div class="col">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($dados as $item) {
                    echo "<tr>
                        <th scope='row'>$item->id</th>
                        <td>$item->nome</td>
                        <td>$item->telefone</td>
                        <td>$item->cpf</td>
                        <td>$item->email</td>
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