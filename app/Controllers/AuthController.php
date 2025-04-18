<?php

require_once BASE_PATH . '/app/Models/Usuario.php';

class AuthController extends Controller
{
    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->view('auth/login');
    }

    public function loginPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() === PHP_SESSION_NONE) session_start();

            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->findByEmail($email);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario'] = $usuario;
                header('Location: /public/user/dashboard');
                exit;
            }

            $_SESSION['erro'] = 'E-mail ou senha inválidos.';
            header('Location: /public/login');
            exit;
        }
    }

    public function register()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->view('auth/cadastro');
    }

    public function registerPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() === PHP_SESSION_NONE) session_start();

            $nome       = $_POST['nome'] ?? '';
            $email      = $_POST['email'] ?? '';
            $senha      = $_POST['senha'] ?? '';
            $confirmar  = $_POST['confirmar'] ?? '';
            $nascimento = $_POST['nascimento'] ?? '';
            $criado_em  = date('Y-m-d H:i:s');

            if ($senha !== $confirmar) {
                $_SESSION['erro'] = 'As senhas não conferem.';
                header('Location: /public/cadastro');
                exit;
            }

            $usuarioModel = new Usuario();

            if ($usuarioModel->findByEmail($email)) {
                $_SESSION['erro'] = 'E-mail já cadastrado.';
                header('Location: /public/cadastro');
                exit;
            }

            $salvo = $usuarioModel->create([
                'nome'        => $nome,
                'email'       => $email,
                'senha'       => password_hash($senha, PASSWORD_DEFAULT),
                'nascimento'  => $nascimento,
                'criado_em'   => $criado_em
            ]);

            if ($salvo) {
                $_SESSION['mensagem'] = 'Conta criada com sucesso! Faça login.';
                header('Location: /public/login');
                exit;
            } else {
                $_SESSION['erro'] = 'Erro ao cadastrar.';
                header('Location: /public/cadastro');
                exit;
            }
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_destroy();
        header('Location: /public/login');
        exit;
    }
}
