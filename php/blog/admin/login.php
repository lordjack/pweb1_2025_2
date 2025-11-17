<?php
include './header.php';
include './database/db.class.php';

$db = new db('usuario');
$data = null;

if (!empty($_POST)) {
    try {
        $errors = [];
        //  var_dump($_POST);
        //  exit;

        if (empty($_POST['login'])) {
            $errors[] = 'O login é obrigatório';
        }

        if (empty($_POST['senha'])) {
            $errors[] = 'O senha é obrigatório';
        }

        if (!empty($_POST['login'])) {
            $result = $db->login($_POST);

            //var_dump($result);
           // exit();
            if ($result !== 'error') {
                session_start();

                $_SESSION['usuario_id'] = $result->id;
                $_SESSION['login'] = $result->login;
                $_SESSION['nome'] = $result->nome;

                echo 'Login realizado com sucesso!';
                echo "<script>
                    setTimeout(
                        ()=> window.location.href = 'main.php', 2000
                    );
                </script>";
            }
        } else {
            echo 'Login ou senha errado, por favor tente novamente!';
        }
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


<h3>Login</h3>
<form action="" method="post">
    <div class="row">
        <div class="col">
            <label for="" class="form-label">Login</label>
            <input class="form-control" type="text" name="login">
        </div>
        <div class="col">
            <label for="" class="form-label">Senha</label>
            <input class="form-control" type="password" name="senha">
        </div>
    </div>

    <div class="row">
        <div class="col mt-4">
            <button type="submit" class="btn btn-success">Logar</button>
            <a href="./usuario/UsuarioForm.php" class="btn btn-primary">Criar um novo usuário</a>
        </div>
    </div>

</form>

<?php include './footer.php';
?>
