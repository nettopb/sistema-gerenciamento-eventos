<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>Editar Evento</title>

</head>

<body>

    <h1>Editar Evento</h1>

    <?php if (!empty($erro)): ?>

        <p>
            <?= htmlspecialchars($erro); ?>
        </p>

    <?php endif; ?>

    <form
        method="POST"
        action="<?= url('/eventos/atualizar'); ?>">

        <input
            type="hidden"
            name="id"
            value="<?= (int) $registro['id']; ?>">

        <p>

            <label for="titulo">
                Título
            </label>

            <br>

            <input
                type="text"
                id="titulo"
                name="titulo"
                maxlength="150"
                required
                value="<?= htmlspecialchars($registro['titulo']); ?>">

        </p>

        <p>

            <label for="data_evento">
                Data
            </label>

            <br>

            <input
                type="date"
                id="data_evento"
                name="data_evento"
                required
                value="<?= htmlspecialchars($registro['data_evento']); ?>">

        </p>

        <p>

            <label for="local">
                Local
            </label>

            <br>

            <input
                type="text"
                id="local"
                name="local"
                maxlength="120"
                required
                value="<?= htmlspecialchars($registro['local']); ?>">

        </p>

        <button type="submit">
            Atualizar
        </button>

    </form>

    <p>

        <a href="<?= url('/eventos'); ?>">
            Cancelar
        </a>

    </p>

</body>

</html>