<main>
    <nav class="nav">
        <ul class="nav__list container">
            <?php foreach ($categories as $category): ?>
                <?= include_template('components/nav-element.php', ['category' => $category]) ?>
            <?php endforeach; ?>
        </ul>
    </nav>
    <section class="lot-item container">
        <h2><?= $lot_info['title'] ?></h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <img src="<?= $lot_info['image_url'] ?>" width="730" height="548" alt=<?= $lot_info['category'] ?>>
                </div>
                <p class="lot-item__category">Категория: <span><?= $lot_info['category'] ?></span></p>
                <p class="lot-item__description"><?= $lot_info['description'] ?></p>
            </div>
            <div class="lot-item__right">
                <div class="lot-item__state">
                    <div class="lot-item__timer timer <?= one_hour_left($lot_info['end_date']) ?>">
                        <?= get_dt_range($lot_info['end_date']) ?>
                    </div>
                    <div class="lot-item__cost-state">
                        <div class="lot-item__rate">
                            <span class="lot-item__amount">Текущая цена</span>
                            <span class="lot-item__cost"><?= price_converter($top_bet) ?></span>
                        </div>
                        <div class="lot-item__min-cost">
                            Мин. ставка <span><?= price_converter($min_bet) ?></span>
                        </div>
                    </div>
                    <?php if ($is_auth == 1): ?>
                        <form class="lot-item__form" action="lot.php?id=<?= $id ?>" method="post" autocomplete="off">
                            <p class="lot-item__form-item form__item <?= empty($errors) ? "" : "form__item--invalid" ?>">
                                <label for="cost">Ваша ставка</label>
                                <input id="cost" type="text" name="cost" placeholder="<?= rtrim(price_converter($min_bet), " ₽") ?>">
                                <span class="form__error"><?= $errors["cost"] ?></span>
                            </p>
                            <button type="submit" class="button">Сделать ставку</button>
                        </form>
                    <?php endif; ?>
                </div>
                <div class="history">
                    <h3>История ставок (<span><?= $cou['cou'] ?></span>)</h3>
                    <table class="history__list">
                        <?php foreach ($bets_info as $bet): ?>
                            <?= include_template('components/table-bet-element.php', ['bet' => $bet]) ?>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
