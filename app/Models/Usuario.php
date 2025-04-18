<?php
require_once 'config/database.php';

class Usuario
{
    public static function buscarPorEmail($email)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function criar($nome, $email, $senha, $nascimento)
    {
        global $pdo;


        if (self::buscarPorEmail($email)) {
            return false;
        }

        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, nascimento) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $senha, $nascimento]);

        if ($stmt->rowCount() > 0) {
            return self::buscarPorEmail($email);
        }

        return false;
    }
}
