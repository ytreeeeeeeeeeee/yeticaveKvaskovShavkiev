<li class="lots__item lot">
    <div class="lot__image">
        <img src="<?= $ad["url"] ?>" width="350" height="260" alt="">
    </div>
    <div class="lot__info">
        <span class="lot__category"><?= $ad["category"] ?></span>
        <h3 class="lot__title"><a class="text-link" href="../pages/lot.html"><?= $ad["name"] ?></a></h3>
        <div class="lot__state">
            <div class="lot__rate">
                <span class="lot__amount">Стартовая цена</span>
                <span class="lot__cost"><?= price_converter($ad["price"]) ?></span>
            </div>
            <div class="lot__timer timer">
                12:23
            </div>
        </div>
    </div>
</li>
