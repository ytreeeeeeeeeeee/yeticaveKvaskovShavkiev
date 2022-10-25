<tr class="rates__item <?= end_or_win_lot(end_lot_time($bet['end_date']), in_array($bet['bet_id'], winner_bet($con, $bet['lot_id']))) ?>">
    <td class="rates__info">
        <div class="rates__img">
            <img src="<?= $bet['image_url'] ?>" width="54" height="40" alt="<?= $bet['category'] ?>">
        </div>
        <div>
            <h3 class="rates__title"><a href="lot.php?id=<?= $bet['lot_id'] ?>"><?= $bet['title'] ?></a></h3>
            <p><?= $bet['contact'] ?? "" ?></p>
        </div>
    </td>
    <td class="rates__category">
        <?= $bet['category'] ?>
    </td>
    <td class="rates__timer">
        <?php if (in_array($bet['bet_id'], winner_bet($con, $bet['lot_id']))): ?>
            <div class="timer timer--win">Ставка выиграла</div>
        <?php elseif (end_lot_time($bet['end_date'])): ?>
            <div class="timer timer--end">Торги окончены</div>
        <?php else: ?>
            <div class="lot__timer timer <?= one_hour_left($bet["end_date"]) ?>">
                <?= get_dt_range($bet["end_date"]) ?>
            </div>
        <?php endif; ?>
    </td>
    <td class="rates__price">
        <?= price_converter($bet['bet_amount']) ?>
    </td>
    <td class="rates__time">
        <?= date_bet($bet['date_bet']) ?>
    </td>
</tr>
