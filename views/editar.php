<?php include_once("includes/header.php"); ?>
<header class="header">
    <a class="cancelar-actualizar" href="/">Cancelar</a>
</header>
<main class="main main-editar">
    <h1 class="main__title">Agenda Electrónica</h1>
    <section class="form-section form-section-editar">
        <form action="/editado" class="main__form" method="POST">
            <input type="date" name="date" class="form__date" value="<?= $even->evento; ?>">
            <textarea name="description" class="form__textarea"><?= $even->descripcion; ?></textarea>
            <button class="form__button" type="submit" name="submit" value="<?= $even->id ?>">Actualizar</button>
        </form>
    </section>

</main>

<?php include_once("includes/footer.php"); ?>