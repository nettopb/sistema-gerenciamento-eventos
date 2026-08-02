<h2>Eventos</h2>

<a href="/eventos/novo">

Novo Evento

</a>

<hr>

<?php foreach($lista as $evento): ?>

<p>

<strong>

<?= $evento['titulo']; ?>

</strong>

<br>

<?= $evento['data_evento']; ?>

<br>

<?= $evento['local']; ?>

</p>

<hr>

<?php endforeach; ?>