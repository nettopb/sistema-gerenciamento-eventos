<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Evento</title>
    <link rel="stylesheet" href="<?= url('/assets/css/style.css'); ?>">
</head>
<body>
<header class="header"><div class="container"><h1>Sistema de Gerenciamento de Eventos</h1></div></header>
<main><div class="container"><div class="card">
    <h2>Editar Evento</h2>
    <?php if (!empty($erro)): ?><div class="alert alert-danger"><?= htmlspecialchars($erro); ?></div><?php endif; ?>
    <form method="POST" action="<?= url('/eventos/atualizar'); ?>">
        <?= CSRF::campo(); ?>
        <input type="hidden" name="id" value="<?= (int) $registro['id']; ?>">
        <div class="form-group"><label for="titulo">Título</label><input type="text" id="titulo" name="titulo" maxlength="150" required value="<?= htmlspecialchars($registro['titulo']); ?>"></div>
        <div class="form-group"><label for="data_evento">Data</label><input type="date" id="data_evento" name="data_evento" required value="<?= htmlspecialchars($registro['data_evento']); ?>"></div>
        <div class="form-group"><label for="local">Local</label><input type="text" id="local" name="local" maxlength="120" required value="<?= htmlspecialchars($registro['local']); ?>"></div>
        <button type="submit">Atualizar</button>
        <a class="btn btn-secondary" href="<?= url('/eventos'); ?>">Cancelar</a>
    </form>
</div></div></main>
</body>
</html>
