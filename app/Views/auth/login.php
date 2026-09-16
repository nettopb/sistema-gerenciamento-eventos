<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Gerenciamento de Eventos</title>
    <link rel="stylesheet" href="<?= url('/assets/css/style.css'); ?>">
</head>
<body>
<header class="header"><div class="container"><h1>Sistema de Gerenciamento de Eventos</h1></div></header>
<main><div class="container"><div class="card">
    <h2>Login</h2>
    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro); ?></div>
    <?php endif; ?>
    <form method="POST" action="<?= url('/login'); ?>">
        <?= CSRF::campo(); ?>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required autocomplete="email">
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required autocomplete="current-password">
        </div>
        <button type="submit">Entrar</button>
    </form>
    <p><a href="<?= url('/'); ?>">Voltar ao início</a></p>
</div></div></main>
</body>
</html>
