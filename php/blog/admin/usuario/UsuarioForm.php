<?php
include '../header.php';
include '../db.class.php';

$db = new db();
$data = null;

if (!empty($_POST)) {
    try {
        $db = new db();
        $errors = [];

        //  var_dump($_POST);
        //  exit;

        if (empty($_POST['nome'])) {
            $errors[] = 'O nome é obrigatório';
        }

        if (empty($_POST['telefone'])) {
            $errors[] = 'O telefone é obrigatório';
        }

        if (empty($_POST['cpf'])) {
            $errors[] = 'O cpf é obrigatório';
        }

        if (empty($_POST['id'])) {
            $db->store([
                "nome" => $_POST['nome'],
                "telefone" => $_POST['telefone'],
                "cpf" => $_POST['cpf'],
                "email" => $_POST['email']
            ]);
            echo "Registro Salvo com sucesso!";
        } else {
            $db->update([
                "id" => $_POST['id'],
                "nome" => $_POST['nome'],
                "telefone" => $_POST['telefone'],
                "cpf" => $_POST['cpf'],
                "email" => $_POST['email']
            ]);

            echo "Registro Atualizado com sucesso!";
        }

        echo "<script>
        setTimeout(
            ()=> window.location.href = 'UsuarioList.php', 2000
        );
    </script>";
    } catch (Exception $e) {
        var_dump($errors, $e->getMessage());
        exit;
    }
}

if (!empty($_GET['id'])) {
    $data = $db->find($_GET['id']);
    //  var_dump($data);
    // exit;
}

?>


<h3>Formulário do Usuário</h3>
<form action="" method="post">
    <input type="hidden" name="id" value="<?= $data->id ?? '' ?>">

    <div class="row">
        <div class="col-6">
            <label for="" class="form-label">Nome</label>
            <input class="form-control" type="text" name="nome" value="<?= $data->nome ?? '' ?>">
        </div>

        <div class="col-6">
            <label for="" class="form-label">Email</label>
            <input class="form-control" type="text" name="email" value="<?= $data->email ?? '' ?>">
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <label for="" class="form-label">CPF</label>
            <input class="form-control" type="text" name="cpf" value="<?= $data->cpf ?? '' ?>">
        </div>
        <div class="col-6">
            <label for="" class="form-label">Telefone</label>
            <input class="form-control" type="text" name="telefone" value="<?= $data->telefone ?? '' ?>">
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label for="" class="form-label">Login</label>
            <input class="form-control" type="text" name="login">
        </div>
        <div class="col">
            <label for="" class="form-label">Senha</label>
            <input class="form-control" type="text" name="senha">
        </div>
        <div class="col">
            <label for="" class="form-label">Confirmar Senha</label>
            <input class="form-control" type="text" name="c_senha">
        </div>
    </div>

    <div class="row">
        <div class="col mt-4">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="./UsuarioList.php" class="btn btn-primary">Voltar</a>
        </div>
    </div>

</form>

<?php
include '../footer.php';
?>