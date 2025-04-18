<?php
require_once 'app/Models/Usuario.php';

class AuthController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $usuario = Usuario::buscarPorEmail($email);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                header("Location: /painel");
                exit;
            } else {
                $_SESSION['erro'] = 'E-mail ou senha inválidos.';
                header("Location: /login");
                exit;
            }
        }

        include 'app/Views/auth/login.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';
            $nascimento = $_POST['nascimento'] ?? '';


            if (empty($nome) || empty($email) || empty($senha) || empty($nascimento)) {
                $_SESSION['erro'] = 'Preencha todos os campos.';
                header("Location: /cadastro");
                exit;
            }

            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $usuario = Usuario::criar($nome, $email, $hash, $nascimento);

            if ($usuario) {
                $_SESSION['usuario'] = $usuario;
                header("Location: /painel");
                exit;
            } else {
                $_SESSION['erro'] = 'Erro ao cadastrar.';
                header("Location: /cadastro");
                exit;
            }
        }

        include 'app/Views/auth/cadastro.php';
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: /login");
        exit;
    }
}
