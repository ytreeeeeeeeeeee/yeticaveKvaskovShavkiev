<li class="lots__item lot">
    <div class="lot__image">
        <img src="<?= $ad["image_url"] ?>" width="350" height="260" alt="">
    </div>
    <div class="lot__info">
        <span class="lot__category"><?= $ad["category"] ?></span>
        <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?= $ad['id'] ?>"><?= $ad["title"] ?></a></h3>
        <div class="lot__state">
            <div class="lot__rate">
                <span class="lot__amount">Стартовая цена</span>
                <span class="lot__cost"><?= price_converter($ad["start_price"]) ?></span>
            </div>
            <div class="lot__timer timer <?= one_hour_left($ad["end_date"]) ?>">
                <?= get_dt_range($ad["end_date"]) ?>
            </div>
        </div>
    </div>
</li>
