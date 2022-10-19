<main>
    <nav class="nav">
        <ul class="nav__list container">
            <?php foreach ($categories as $category): ?>
                <?= include_template('components/nav-element.php', ['category' => $category]) ?>
            <?php endforeach; ?>
        </ul>
    </nav>
    <form class="form container <?= empty($errors) ? "" : "form--invalid" ?>" action="sign-up.php" method="post" autocomplete="off" enctype="multipart/form-data"> <!-- form
    --invalid -->
        <h2>Регистрация нового аккаунта</h2>
        <div class="form__item <?= addErrorContainer('email', $errors) ?>"> <!-- form__item--invalid -->
            <label for="email">E-mail <sup>*</sup></label>
            <input id="email" type="text" name="email" placeholder="Введите e-mail">
            <span class="form__error"><?= $errors['email'] ?></span>
        </div>
        <div class="form__item <?= addErrorContainer('password', $errors) ?>">
            <label for="password">Пароль <sup>*</sup></label>
            <input id="password" type="password" name="password" placeholder="Введите пароль">
            <span class="form__error"><?= $errors['password'] ?></span>
        </div>
        <div class="form__item <?= addErrorContainer('name', $errors) ?>">
            <label for="name">Имя <sup>*</sup></label>
            <input id="name" type="text" name="name" placeholder="Введите имя">
            <span class="form__error"><?= $errors['name'] ?></span>
        </div>
        <div class="form__item <?= addErrorContainer('message', $errors) ?>">
            <label for="message">Контактные данные <sup>*</sup></label>
            <textarea id="message" name="message" placeholder="Напишите как с вами связаться"></textarea>
            <span class="form__error"><?= $errors['message'] ?></span>
        </div>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <button type="submit" class="button">Зарегистрироваться</button>
        <a class="text-link" href="#">Уже есть аккаунт</a>
    </form>
</main>
