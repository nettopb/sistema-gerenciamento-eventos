<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>
    <link rel="stylesheet" href="<?= url('/assets/css/style.css'); ?>">
</head>
<body>
<header class="header"><div class="container"><h1>Sistema de Gerenciamento de Eventos</h1></div></header>
<main><div class="container">
    <?php $usuario = Auth::usuario(); ?>
    <div class="card">
        <div class="user-bar">
            <div>Usuário: <strong><?= htmlspecialchars($usuario['nome']); ?></strong> | Perfil: <strong><?= htmlspecialchars($usuario['perfil']); ?></strong></div>
            <form method="POST" action="<?= url('/logout'); ?>">
                <?= CSRF::campo(); ?>
                <button class="btn-secondary" type="submit">Sair</button>
            </form>
        </div>
    </div>

    <div class="card">
        <h2>Eventos</h2>
        <?php if (($_GET['sucesso'] ?? '') === 'cadastrado'): ?><div class="alert alert-success">Evento cadastrado com sucesso!</div><?php endif; ?>
        <?php if (($_GET['sucesso'] ?? '') === 'atualizado'): ?><div class="alert alert-success">Evento atualizado com sucesso!</div><?php endif; ?>
        <?php if (($_GET['sucesso'] ?? '') === 'excluido'): ?><div class="alert alert-success">Evento excluído com sucesso!</div><?php endif; ?>
        <?php if (($_GET['erro'] ?? '') === 'id_invalido'): ?><div class="alert alert-danger">ID do evento inválido.</div><?php endif; ?>
        <?php if (($_GET['erro'] ?? '') === 'nao_encontrado'): ?><div class="alert alert-danger">Evento não encontrado.</div><?php endif; ?>
        <?php if (($_GET['erro'] ?? '') === 'exclusao'): ?><div class="alert alert-danger">Não foi possível excluir o evento.</div><?php endif; ?>

        <?php if (Auth::ehAdmin()): ?>
            <div class="actions"><a class="btn" href="<?= url('/eventos/novo'); ?>">Novo Evento</a></div>
        <?php endif; ?>

        <?php if (empty($lista)): ?>
            <p>Nenhum evento cadastrado.</p>
        <?php else: ?>
            <?php foreach ($lista as $evento): ?>
                <article class="evento">
                    <h3><?= htmlspecialchars($evento['titulo']); ?></h3>
                    <p><strong>Data:</strong> <?= htmlspecialchars($evento['data_evento']); ?></p>
                    <p><strong>Local:</strong> <?= htmlspecialchars($evento['local']); ?></p>
                    <?php if (Auth::ehAdmin()): ?>
                        <div class="actions">
                            <a class="btn" href="<?= url('/eventos/editar?id=' . (int) $evento['id']); ?>">Editar</a>
                            <form method="POST" action="<?= url('/eventos/excluir'); ?>" onsubmit="return confirm('Tem certeza que deseja excluir este evento?');">
                                <?= CSRF::campo(); ?>
                                <input type="hidden" name="id" value="<?= (int) $evento['id']; ?>">
                                <button class="btn-danger" type="submit">Excluir</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div></main>
<footer class="footer">Sistema de Gerenciamento de Eventos</footer>
</body>
</html>
