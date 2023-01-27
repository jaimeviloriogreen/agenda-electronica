<?php include_once("includes/header.php"); ?>

<main class="main">
    <h1 class="main__title">Agenda Electrónica</h1>
    <section class="form-section">
        <form action="/agendar" class="main__form main__form-editar" method="POST">
            <input type="date" name="date" class="form__date">
            <textarea name="description" class="form__textarea"></textarea>
            <button class="form__button" type="submit" name="submit">Enviar</button>
        </form>
    </section>

    <section class="section-results">
        <?php if (isset($events) && (!empty($events))) : ?>
            <table id="mainTable">
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Agendado</th>
                        <th>Creación</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($events as $event) : ?>
                        <tr>
                            <td><?= $event["descripcion"]; ?></td>
                            <td><?= $event["evento"]; ?></td>
                            <td><?= $event["hoy"]; ?></td>
                            <td>
                                <a href="/eliminar?id=<?= $event["id"]; ?>">
                                    <img class="icon__delete" src="assets/icons/delete.svg" alt="delet">
                                </a>
                                <a href="/editar?id=<?= $event["id"]; ?>">
                                    <img class="icon__edit" src="assets/icons/edit.svg" alt="edit">
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <section class="warning">
                <img class="warning__icon" src="assets/icons/agenda.svg" alt="agenda">
                <h3 class="warning__title">Nada agendado!</h3>
            </section>
        <?php endif; ?>
    </section>
</main>

<?php include_once("includes/footer.php"); ?>