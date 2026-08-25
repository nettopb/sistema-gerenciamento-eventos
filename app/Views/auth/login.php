<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Login - Sistema de Gerenciamento de Eventos</title>

</head>

<body>

    <h1>
        Sistema de Gerenciamento de Eventos
    </h1>

    <h2>Login</h2>

    <?php if (!empty($erro)): ?>

        <p>
            <?= htmlspecialchars($erro); ?>
        </p>

    <?php endif; ?>

    <form
        method="POST"
        action="<?= url('/login'); ?>">

        <p>

            <label for="email">
                E-mail
            </label>

            <br>

            <input
                type="email"
                id="email"
                name="email"
                required
                autocomplete="email">

        </p>

        <p>

            <label for="senha">
                Senha
            </label>

            <br>

            <input
                type="password"
                id="senha"
                name="senha"
                required
                autocomplete="current-password">

        </p>

        <button type="submit">
            Entrar
        </button>

    </form>

    <p>

        <a href="<?= url('/'); ?>">
            Voltar ao início
        </a>

    </p>

</body>

</html>