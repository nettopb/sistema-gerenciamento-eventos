<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($status); ?> - Sistema de Gerenciamento de Eventos</title>
    <link rel="stylesheet" href="<?= url('/assets/css/style.css'); ?>">
</head>
<body>
<header class="header"><div class="container"><h1>Sistema de Gerenciamento de Eventos</h1></div></header>
<main><div class="container"><div class="card">
    <h2><?= htmlspecialchars($status); ?> - Acesso não permitido</h2>
    <p><?= htmlspecialchars($message); ?></p>
    <a class="btn" href="<?= url('/'); ?>">Voltar ao início</a>
</div></div></main>
</body>
</html>
