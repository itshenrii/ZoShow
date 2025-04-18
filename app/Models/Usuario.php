<?php

class Usuario
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = $GLOBALS['pdo'];
    }

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO usuarios (nome, email, senha, nascimento, criado_em)
            VALUES (?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $data['nome'],
            $data['email'],
            $data['senha'],
            $data['nascimento'],
            $data['criado_em']
        ]);
    }
}
