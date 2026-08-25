<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Sistema de Gerenciamento de Eventos
    </title>

</head>

<body>

    <h1>
        Sistema de Gerenciamento de Eventos
    </h1>

    <?php if (Auth::autenticado()): ?>

        <?php $usuario = Auth::usuario(); ?>

        <p>
            Usuário:
            <?= htmlspecialchars($usuario['nome']); ?>
        </p>

        <p>

            <a href="<?= url('/eventos'); ?>">
                Eventos
            </a>

        </p>

        <p>

            <a href="<?= url('/logout'); ?>">
                Sair
            </a>

        </p>

    <?php else: ?>

        <p>

            <a href="<?= url('/login'); ?>">
                Login
            </a>

        </p>

    <?php endif; ?>

</body>

</html>