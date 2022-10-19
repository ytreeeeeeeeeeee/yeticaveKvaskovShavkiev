<main>
    <nav class="nav">
        <ul class="nav__list container">
            <?php foreach ($categories as $category): ?>
                <?= include_template('components/nav-element.php', ['category' => $category]) ?>
            <?php endforeach; ?>
        </ul>
    </nav>
    <form class="form container <?= empty($errors) ? "" : "form--invalid" ?>" action="login.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
        <h2>Вход</h2>
        <div class="form__item <?= addErrorContainer('email', $errors) ?>"> <!-- form__item--invalid -->
            <label for="email">E-mail <sup>*</sup></label>
            <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= getPostVal('email') ?>">
            <span class="form__error"><?= $errors['email'] ?></span>
        </div>
        <div class="form__item form__item--last <?= addErrorContainer('password', $errors) ?>">
            <label for="password">Пароль <sup>*</sup></label>
            <input id="password" type="password" name="password" placeholder="Введите пароль">
            <span class="form__error"><?= $errors['password']?></span>
        </div>
        <button type="submit" class="button">Войти</button>
    </form>
</main>
