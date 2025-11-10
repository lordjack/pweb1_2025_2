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
            if ($_POST['senha'] === $_POST['c_senha']) {
                
                $_POST['senha'] = password_hash(
                    $_POST['senha'],
                    PASSWORD_BCRYPT
                );

                $db->store($_POST);
                echo 'Registro Salvo com sucesso!';
            }
        } else {
            $db->update($_POST);
            echo 'Registro Atualizado com sucesso!';
        }

        echo "<script>
            setTimeout(
                ()=> window.location.href = 'UsuarioList.php', 2000
            );
        </script>";
    } catch (Exception $e) {
        var_dump($errors, $e->getMessage());
        exit();
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
            <input class="form-control" type="text" name="nome" value="<?= $data->nome ??
                '' ?>">
        </div>

        <div class="col-6">
            <label for="" class="form-label">Email</label>
            <input class="form-control" type="text" name="email" value="<?= $data->email ??
                '' ?>">
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <label for="" class="form-label">CPF</label>
            <input class="form-control" type="text" name="cpf" value="<?= $data->cpf ??
                '' ?>">
        </div>
        <div class="col-6">
            <label for="" class="form-label">Telefone</label>
            <input class="form-control" type="text" name="telefone" value="<?= $data->telefone ??
                '' ?>">
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label for="" class="form-label">Login</label>
            <input class="form-control" type="text" name="login">
        </div>
        <div class="col">
            <label for="" class="form-label">Senha</label>
            <input class="form-control" type="password" name="senha">
        </div>
        <div class="col">
            <label for="" class="form-label">Confirmar Senha</label>
            <input class="form-control" type="password" name="c_senha">
        </div>
    </div>

    <div class="row">
        <div class="col mt-4">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="./UsuarioList.php" class="btn btn-primary">Voltar</a>
        </div>
    </div>

</form>

<?php include '../footer.php';
?>
