<?php

date_default_timezone_set("Europe/Moscow");

function price_converter($price) {
    $new_price = ceil($price);
    if ($new_price < 1000){
        return "$new_price ₽";
    }
    else {
        $format_price = number_format($new_price, 0, ".", " ");
        return "{$format_price} ₽";
    }
}

function get_dt_range($date) {
    $interval = strtotime($date) - strtotime("now");

    $minutes = intdiv($interval%3600, 60);
    $hours = intdiv($interval, 3600);

    if ($minutes < 10) {
        $minutes = '0' . $minutes;
    }

    return $hours . ":" . $minutes;
}

function one_hour_left($date) {
    $interval = strtotime($date) - strtotime("now");
    if (intdiv($interval, 3600) < 1) {
        return "timer--finishing";
    }
}

function top_bet($id, $con) {
    $sql_bet = "SELECT bet_amount
            FROM bets
            WHERE lot_id = ?
            ORDER BY bet_amount DESC
            LIMIT 1";

    $stmt_bet = $con->prepare($sql_bet);
    $stmt_bet->execute([$id]);
    $top_bet = $stmt_bet->fetch();

    if ($top_bet != null) {
        return $top_bet['bet_amount'];
    }
    else {
        $sql = "SELECT start_price
                FROM lots
                WHERE id = ?";

        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);
        $top_bet = $stmt->fetch();

        return $top_bet['start_price'];
    }
}

function min_next_bet($id, $top_bet, $con) {
    $sql = "SELECT bet_step
            FROM lots
            WHERE id = ?";

    $stmt = $con->prepare($sql);
    $stmt->execute([$id]);
    $bet_step = $stmt->fetch()['bet_step'];

    return $top_bet + $bet_step;
}

function validateImage() {
    if (!empty($_FILES['photo']['name'])) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $tmp_name = $_FILES['photo']['tmp_name'];
        $file_type = finfo_file($finfo, $tmp_name);
        if ($file_type !== "image/jpeg" && $file_type !== "image/jpg" && $file_type !== "image/png"){
            return false;
        }
        return true;
    }
    else {
        return false;
    }
}

function validateStartPrice() {
    if (!empty($_POST['lot-rate'])) {
        if ($_POST['lot-rate'] <= 0) {
            return "Стартовая цена меньше нуля";
        }
        return true;
    }
    return "Введите стартовую цену";
}

function validateEndDate() {
    if (!empty($_POST['lot-date'])) {
        if (date_create($_POST['lot-date']) > date('Y-m-d')){
            return "введите другую дату";
        }
        return true;
    }
    return "Введите дату";
}
