<?php

class db
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $port = '3306';
    private $dbname = 'db_pweb1_2025_2';
    private $table_name;
/*
    public function __construct($table_name)
    {
        $this->table_name = $table_name;
    }
    */
    function conn()
    {
        try {
            $conn = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname;port=$this->port",
                $this->user,
                $this->password,
                [
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => ' SET NAMES utf8',
                ]
            );

            return $conn;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    public function store($dados)
    {
        $conn = $this->conn();

        $sql = "INSERT INTO `usuario` (`nome`, `telefone`, `cpf`, `email`, `login`, `senha`)
             VALUES (?, ?, ?, ?, ?, ? );";

        $st = $conn->prepare($sql);
        $st->execute([
            $dados['nome'],
            $dados['telefone'],
            $dados['cpf'],
            $dados['email'],
            $dados['login'],
            $dados['senha'],
        ]);
    }

    public function update($dados)
    {
        $id = $dados['id'];
        $conn = $this->conn();

        $sql = "UPDATE `usuario` SET `nome`=?, `telefone`=?, `cpf`=?, `email`=?
                    WHERE id = $id";

        $st = $conn->prepare($sql);
        $st->execute([
            $dados['nome'],
            $dados['telefone'],
            $dados['cpf'],
            $dados['email'],
        ]);
    }

    public function find($id)
    {
        //select * from usuario WHERE id = 5
        $conn = $this->conn();

        $sql = 'SELECT * FROM usuario WHERE id = ?';

        $st = $conn->prepare($sql);
        $st->execute([$id]);

        return $st->fetchObject();
    }

    public function all()
    {
        $conn = $this->conn();

        $sql = 'SELECT * FROM usuario';

        $st = $conn->prepare($sql);
        $st->execute();

        return $st->fetchAll(PDO::FETCH_CLASS);
    }

    public function destroy($id)
    {
        $conn = $this->conn();

        $sql = 'DELETE FROM usuario WHERE id = ?';

        $st = $conn->prepare($sql);
        $st->execute([$id]);
    }

    public function search($dados)
    {
        $campo = $dados['tipo'];
        $valor = $dados['valor'];

        $conn = $this->conn();

        $sql = "SELECT * FROM usuario WHERE $campo LIKE ?";

        $st = $conn->prepare($sql);
        $st->execute(["%$valor%"]);

        return $st->fetchAll(PDO::FETCH_CLASS);
    }

    public function login($dados)
    {
        //select * from usuario WHERE login = ?
        $conn = $this->conn();

        $sql = 'SELECT * FROM usuario WHERE login = ?';

        $st = $conn->prepare($sql);
        $st->execute([$dados['login']]);

        // var_dump($dados);
        // exit();

        $result = $st->fetchObject();

        if (password_verify($dados['senha'], $result->senha)) {
            return $result;
        } else {
            return 'error';
        }
    }

    function checkLogin()
    {
        session_start();

        if (empty($_SESSION['login'])) {
            session_destroy();
            header('Location: ../login.php?error=Sessao Expirada!');
        }
    }
}
