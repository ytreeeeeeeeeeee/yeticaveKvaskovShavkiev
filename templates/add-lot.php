<main>
<nav class="nav">
    <ul class="nav__list container">
        <?php foreach ($categories as $category): ?>
            <?= include_template('components/nav-element.php', ['category' => $category]) ?>
        <?php endforeach; ?>
    </ul>
</nav>
<form class="form form--add-lot container <?= empty($errors) ? "" : "form--invalid" ?>" action="add-lot.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
        <div class="form__item <?= addErrorContainer('lot-name', $errors) ?>"> <!-- form__item--invalid -->
            <label for="lot-name">Наименование <sup>*</sup></label>
            <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?= getPostVal('lot-name') ?>">
            <span class="form__error"><?= $errors['lot-name'] ?></span>
        </div>
        <div class="form__item <?= addErrorContainer('category', $errors) ?>">
            <label for="category">Категория <sup>*</sup></label>
            <select id="category" name="category" <?= getPostVal('category') ?>>
                <option>Выберите категорию</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endforeach; ?>
            </select>

            <span class="form__error"><?= $errors['category'] ?></span>
        </div>
    </div>
    <div class="form__item form__item--wide <?= addErrorContainer('message', $errors) ?>">
        <label for="message">Описание <sup>*</sup></label>
        <textarea id="message" name="message" placeholder="Напишите описание лота"></textarea>
        <span class="form__error"><?= $errors['message'] ?></span>
    </div>
    <div class="form__item form__item--file <?= addErrorContainer('img', $errors) ?>">
        <label>Изображение <sup>*</sup></label>
        <div class="form__input-file">
            <input name="img" class="visually-hidden" type="file" id="lot-img" value="">
            <label for="lot-img">
                Добавить
            </label>
        </div>
        <span class="form__error"><?= $errors['img'] ?></span>
    </div>
    <div class="form__container-three">
        <div class="form__item form__item--small <?= addErrorContainer('lot-rate', $errors) ?>">
            <label for="lot-rate">Начальная цена <sup>*</sup></label>
            <input id="lot-rate" type="text" name="lot-rate" placeholder="0" value="<?= getPostVal('lot-rate') ?>">
            <span class="form__error"><?= $errors['lot-rate'] ?></span>
        </div>
        <div class="form__item form__item--small <?= addErrorContainer('lot-step', $errors) ?>">
            <label for="lot-step">Шаг ставки <sup>*</sup></label>
            <input id="lot-step" type="text" name="lot-step" placeholder="0" value="<?= getPostVal('lot-step') ?>">
            <span class="form__error"><?= $errors['lot-step'] ?></span>
        </div>
        <div class="form__item <?= addErrorContainer('lot-date', $errors) ?>">
            <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
            <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="Введите дату в формате ГГГГ-ММ-ДД" value="<?= getPostVal('lot-date') ?>">
            <span class="form__error"><?= $errors['lot-date'] ?></span>
        </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
</form>
</main>
