<h2>Eventos</h2>

<a href="/eventos/novo">
    Novo Evento
</a>

<hr>

<?php if (isset($_GET['sucesso'])): ?>

    <?php if ($_GET['sucesso'] === 'cadastrado'): ?>

        <p>
            Evento cadastrado com sucesso!
        </p>

    <?php elseif ($_GET['sucesso'] === 'atualizado'): ?>

        <p>
            Evento atualizado com sucesso!
        </p>

    <?php elseif ($_GET['sucesso'] === 'excluido'): ?>

        <p>
            Evento excluído com sucesso!
        </p>

    <?php endif; ?>

<?php endif; ?>


<?php if (isset($_GET['erro'])): ?>

    <p>
        Ocorreu um erro ao realizar a operação.
    </p>

<?php endif; ?>


<hr>


<?php if (empty($lista)): ?>

    <p>
        Nenhum evento cadastrado.
    </p>

<?php else: ?>

    <?php foreach ($lista as $evento): ?>

        <div>

            <h3>
                <?= htmlspecialchars($evento['titulo']); ?>
            </h3>

            <p>
                Data:
                <?= htmlspecialchars($evento['data_evento']); ?>
            </p>

            <p>
                Local:
                <?= htmlspecialchars($evento['local']); ?>
            </p>

            <a
                href="/eventos/editar?id=<?= $evento['id']; ?>">
                Editar
            </a>

            |

            <a
                href="/eventos/excluir?id=<?= $evento['id']; ?>"
                onclick="return confirm('Deseja realmente excluir este evento?');">
                Excluir
            </a>

        </div>

        <hr>

    <?php endforeach; ?>

<?php endif; ?>