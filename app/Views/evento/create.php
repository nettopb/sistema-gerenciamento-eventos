<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

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
                value="<?= htmlspecialchars($_POST['titulo'] ?? ''); ?>">

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
                value="<?= htmlspecialchars($_POST['data_evento'] ?? ''); ?>">

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
                value="<?= htmlspecialchars($_POST['local'] ?? ''); ?>">

        </p>

        <button type="submit">
            Salvar
        </button>

    </form>

    <p>

        <a href="<?= url('/eventos'); ?>">
            Voltar
        </a>

    </p>

</body>

</html>