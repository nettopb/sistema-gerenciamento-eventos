<h2>Editar Evento</h2>

<?php if (isset($erro)): ?>

    <p>
        <?= htmlspecialchars($erro); ?>
    </p>

<?php endif; ?>


<form method="POST" action="/eventos/atualizar">

    <input
        type="hidden"
        name="id"
        value="<?= htmlspecialchars($registro['id']); ?>">


    <label>
        Título:
    </label>

    <br>

    <input
        type="text"
        name="titulo"
        value="<?= htmlspecialchars($registro['titulo']); ?>"
        required>

    <br><br>


    <label>
        Data:
    </label>

    <br>

    <input
        type="date"
        name="data_evento"
        value="<?= htmlspecialchars($registro['data_evento']); ?>"
        required>

    <br><br>


    <label>
        Local:
    </label>

    <br>

    <input
        type="text"
        name="local"
        value="<?= htmlspecialchars($registro['local']); ?>"
        required>

    <br><br>


    <button type="submit">
        Atualizar
    </button>

</form>

<br>

<a href="/eventos">
    Cancelar
</a>