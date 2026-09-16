<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gerenciamento de Eventos</title>
    <link rel="stylesheet" href="<?= url('/assets/css/style.css'); ?>">
</head>
<body>
<header class="header"><div class="container"><h1>Sistema de Gerenciamento de Eventos</h1></div></header>
<main><div class="container"><div class="card hero">
    <h2>Gerenciamento de Eventos</h2>
    <p>Aplicação web desenvolvida em PHP com arquitetura MVC, MySQL, autenticação e controle de acesso.</p>
    <?php if (Auth::autenticado()): ?>
        <?php $usuario = Auth::usuario(); ?>
        <p>Olá, <strong><?= htmlspecialchars($usuario['nome']); ?></strong>.</p>
        <div class="actions" style="justify-content:center;">
            <a class="btn" href="<?= url('/eventos'); ?>">Eventos</a>
            <form method="POST" action="<?= url('/logout'); ?>">
                <?= CSRF::campo(); ?>
                <button class="btn-secondary" type="submit">Sair</button>
            </form>
        </div>
    <?php else: ?>
        <a class="btn" href="<?= url('/login'); ?>">Entrar no sistema</a>
    <?php endif; ?>
</div></div></main>
<footer class="footer">Projeto acadêmico — Sistema de Gerenciamento de Eventos</footer>
</body>
</html>
