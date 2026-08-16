<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Eventos</title>

</head>

<body>

    <h1>Eventos</h1>

    <?php

    $sucesso = $_GET['sucesso'] ?? null;
    $erro = $_GET['erro'] ?? null;

    ?>

    <?php if ($sucesso === 'cadastrado'): ?>

        <p>
            Evento cadastrado com sucesso!
        </p>

    <?php elseif ($sucesso === 'atualizado'): ?>

        <p>
            Evento atualizado com sucesso!
        </p>

    <?php elseif ($sucesso === 'excluido'): ?>

        <p>
            Evento excluído com sucesso!
        </p>

    <?php endif; ?>

    <?php if ($erro === 'invalid_id'): ?>

        <p>
            Identificador do evento inválido.
        </p>

    <?php elseif ($erro === 'not_found'): ?>

        <p>
            Evento não encontrado.
        </p>

    <?php elseif ($erro === 'delete'): ?>

        <p>
            Não foi possível excluir o evento.
        </p>

    <?php endif; ?>

    <p>

        <a href="<?= url('/eventos/novo'); ?>">
            Novo Evento
        </a>

    </p>

    <hr>

    <?php if (empty($lista)): ?>

        <p>
            Nenhum evento cadastrado.
        </p>

    <?php else: ?>

        <?php foreach ($lista as $evento): ?>

            <article>

                <h2>
                    <?= htmlspecialchars($evento['titulo']); ?>
                </h2>

                <p>
                    <strong>Data:</strong>
                    <?= htmlspecialchars($evento['data_evento']); ?>
                </p>

                <p>
                    <strong>Local:</strong>
                    <?= htmlspecialchars($evento['local']); ?>
                </p>

                <p>

                    <a
                        href="<?= url('/eventos/editar?id=' . (int) $evento['id']); ?>">

                        Editar

                    </a>

                </p>

                <form
                    method="POST"
                    action="<?= url('/eventos/excluir'); ?>"
                    onsubmit="return confirm('Deseja realmente excluir este evento?');">

                    <input
                        type="hidden"
                        name="id"
                        value="<?= (int) $evento['id']; ?>">

                    <button type="submit">
                        Excluir
                    </button>

                </form>

            </article>

            <hr>

        <?php endforeach; ?>

    <?php endif; ?>

    <p>

        <a href="<?= url('/'); ?>">
            Voltar ao início
        </a>

    </p>

</body>

</html>