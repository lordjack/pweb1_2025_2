<?php
include './header.php';
include './database/db.class.php';

$db = new db('usuario');
$db->checkLogin();
?>

    <div class="col">
        <h2>Bem vindo ao admin do Blog - Painel Administrativo</h2>
        <a href="./usuario/UsuarioList.php">Usuário</a> <br>
        <a href="./post/PostList.php">Postagem</a> <br>
        <a href="#">Categoria</a> <br>
    </div>


<?php include './footer.php'; ?>
   
 