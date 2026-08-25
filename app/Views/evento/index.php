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

    <?php $usuario = Auth::usuario(); ?>

    <h1>Eventos</h1>

    <p>

        Usuário:
        <?= htmlspecialchars($usuario['nome']); ?>

        |

        Perfil:
        <?= htmlspecialchars($usuario['perfil']); ?>

        |

        <a href="<?= url('/logout'); ?>">
            Sair
        </a>

    </p>

    <?php if (
        ($_GET['sucesso'] ?? '') ===
        'cadastrado'
    ): ?>

        <p>
            Evento cadastrado com sucesso!
        </p>

    <?php endif; ?>

    <?php if (
        ($_GET['sucesso'] ?? '') ===
        'atualizado'
    ): ?>

        <p>
            Evento atualizado com sucesso!
        </p>

    <?php endif; ?>

    <?php if (
        ($_GET['sucesso'] ?? '') ===
        'excluido'
    ): ?>

        <p>
            Evento excluído com sucesso!
        </p>

    <?php endif; ?>

    <?php if (
        ($_GET['erro'] ?? '') ===
        'id_invalido'
    ): ?>

        <p>
            ID do evento inválido.
        </p>

    <?php endif; ?>

    <?php if (
        ($_GET['erro'] ?? '') ===
        'nao_encontrado'
    ): ?>

        <p>
            Evento não encontrado.
        </p>

    <?php endif; ?>

    <?php if (
        ($_GET['erro'] ?? '') ===
        'exclusao'
    ): ?>

        <p>
            Não foi possível excluir o evento.
        </p>

    <?php endif; ?>

    <?php if (Auth::ehAdmin()): ?>

        <p>

            <a href="<?= url('/eventos/novo'); ?>">
                Novo Evento
            </a>

        </p>

    <?php endif; ?>

    <?php if (empty($lista)): ?>

        <p>
            Nenhum evento cadastrado.
        </p>

    <?php else: ?>

        <?php foreach ($lista as $evento): ?>

            <hr>

            <h2>
                <?= htmlspecialchars(
                    $evento['titulo']
                ); ?>
            </h2>

            <p>
                Data:
                <?= htmlspecialchars(
                    $evento['data_evento']
                ); ?>
            </p>

            <p>
                Local:
                <?= htmlspecialchars(
                    $evento['local']
                ); ?>
            </p>

            <?php if (Auth::ehAdmin()): ?>

                <p>

                    <a
                        href="<?= url(
                            '/eventos/editar?id=' .
                            (int) $evento['id']
                        ); ?>">

                        Editar

                    </a>

                </p>

                <form
                    method="POST"
                    action="<?= url('/eventos/excluir'); ?>">

                    <input
                        type="hidden"
                        name="id"
                        value="<?= (int) $evento['id']; ?>">

                    <button type="submit">
                        Excluir
                    </button>

                </form>

            <?php endif; ?>

        <?php endforeach; ?>

    <?php endif; ?>

    <hr>

    <p>

        <a href="<?= url('/'); ?>">
            Voltar ao início
        </a>

    </p>

</body>

</html>