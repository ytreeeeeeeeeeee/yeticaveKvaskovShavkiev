<main>
    <nav class="nav">
        <ul class="nav__list container">
            <li class="nav__item">
                <a href="all-lots.html">Доски и лыжи</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Крепления</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Ботинки</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Одежда</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Инструменты</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Разное</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <section class="lots">
            <?php if(!$ads): ?>
                <h2>По вашему запросу ничего не найдено!</h2>
            <?php else: ?>
                <h2>Результаты поиска по запросу «<span><?= $request ?></span>»</h2>
            <?php endif; ?>
            <ul class="lots__list">
                <?php foreach ($ads as $ad): ?>
                    <?= include_template('components/lot.php', ['ad' => $ad]) ?>
                <?php endforeach; ?>
            </ul>
        </section>
        <ul class="pagination-list">
            <li class="pagination-item pagination-item-prev"><a href="<?= $pageNum != 1 ? 'search.php?search=' . $request . '&find=Найти&page=' . strval(intval($pageNum)-1) : "" ?>">Назад</a></li>
            <?php for ($i = 1; $i <= $pageCount; $i++): ?>
                <li class="pagination-item <?= $i == $pageNum ? "pagination-item-active" : "" ?>"><a href="<?= 'search.php?search=' . $request . '&find=Найти&page=' . $i?>"><?= $i ?></a></li>
            <?php endfor; ?>
            <li class="pagination-item pagination-item-next"><a href="<?= $pageNum != $pageCount ? 'search.php?search=' . $request . '&find=Найти&page=' . strval(intval($pageNum)+1) : "" ?>">Вперед</a></li>
        </ul>
    </div>
</main>
