<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Novo Evento</title>

</head>

<body>

    <h1>Novo Evento</h1>

    <?php if (!empty($erro)): ?>

        <p>
            <?= htmlspecialchars($erro); ?>
        </p>

    <?php endif; ?>

    <form
        method="POST"
        action="<?= url('/eventos/salvar'); ?>">

        <label for="titulo">
            Título:
        </label>

        <br>

        <input
            type="text"
            id="titulo"
            name="titulo"
            maxlength="150"
            value="<?= htmlspecialchars($_POST['titulo'] ?? ''); ?>"
            required>

        <br><br>

        <label for="data_evento">
            Data:
        </label>

        <br>

        <input
            type="date"
            id="data_evento"
            name="data_evento"
            value="<?= htmlspecialchars($_POST['data_evento'] ?? ''); ?>"
            required>

        <br><br>

        <label for="local">
            Local:
        </label>

        <br>

        <input
            type="text"
            id="local"
            name="local"
            maxlength="120"
            value="<?= htmlspecialchars($_POST['local'] ?? ''); ?>"
            required>

        <br><br>

        <button type="submit">
            Salvar Evento
        </button>

    </form>

    <br>

    <a href="<?= url('/eventos'); ?>">
        Voltar
    </a>

</body>

</html>