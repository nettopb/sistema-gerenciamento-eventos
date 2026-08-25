<?php

require_once __DIR__ .
    '/../config/config.php';

require_once __DIR__ .
    '/../app/Core/Database.php';

$nome = 'Administrador';

$email = 'admin@eventos.com';

$senha = '123456';

$perfil = 'ADMIN';

$hash =
    password_hash(
        $senha,
        PASSWORD_DEFAULT
    );

$pdo =
    Database::conectar();

$sql = '
    INSERT INTO usuarios
    (
        nome,
        email,
        senha,
        perfil
    )
    VALUES (?, ?, ?, ?)
';

$stmt =
    $pdo->prepare($sql);

$stmt->execute([
    $nome,
    $email,
    $hash,
    $perfil
]);

echo 'Usuário administrador criado com sucesso.';