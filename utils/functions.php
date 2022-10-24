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
    if (!empty($_FILES['img']['name'])) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $tmp_name = $_FILES['img']['tmp_name'];
        $file_type = finfo_file($finfo, $tmp_name);
        var_dump($file_type);
        if ($file_type !== "image/jpeg" && $file_type !== "image/jpg" && $file_type !== "image/png"){
            return "Прикрепите фотография с расширением jpeg, jpg или png";
        }
        return null;
    }
    else {
        return "Прикрепите фото";
    }
}

function validateStartPrice() {
    if (!empty($_POST['lot-rate'])) {
        if ($_POST['lot-rate'] <= 0) {
            return "Стартовая цена меньше нуля";
        }
        if (!is_numeric($_POST['lot-rate'])) {
            return "Введите число";
        }
        return null;
    }
    return "Введите стартовую цену";
}

function validateEndDate() {
    if (!empty($_POST['lot-date'])) {
        if (is_date_valid($_POST['lot-date'])) {
            if (date('Y-m-d', strtotime($_POST['lot-date'])) < date('Y-m-d', strtotime("+1 day"))){
                return "введите другую дату";
            }
            return null;
        }
        return "Введите дату в верном формате";
    }
    return "Введите дату";
}

function validateLotStep() {
    if (!empty($_POST["lot-step"])) {
        if (is_numeric($_POST['lot-step'])) {
            if (strpos($_POST['lot-step'], ".")) {
                return "Введите целое число";
            }
            if ($_POST["lot-step"] <= 0) {
                return "Шаг ставки должен быть больше 0";
            }
            return null;
        }
        return "Введите число";
    }
    return "Поле должно быть заполнено!";
}

function validateLotName() {
    if (!empty($_POST['lot-name'])) {
        return null;
    }
    return "Это поле должно быть заполненым";
}

function validateCategory($id, $allowed_list) {
    if (!in_array($id, $allowed_list)) {
        return "Выберите категорию";
    }
    return null;
}

function validateDescription() {
    if (!empty($_POST['message'])) {
        return null;
    }
    return "Поле должно быть заполненным!";
}

function addErrorContainer($title, $errors) {
    if (array_key_exists($title, $errors)) {
        return "form__item--invalid";
    }
}

function validateField($title) {
    if (!empty($_POST[$title])){
        return null;
    }
    return "Поле должно быть заполнено!";
}

function validateEmail($con) {
    if (!empty($_POST['email'])) {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            return "Введите корректный Email";
        }
        return null;
    }
    return "Поле должно быть заполненным!";
}

function getPostVal($name) {
    return $_POST[$name] ?? "";
}

function validateBet($min_bet) {
    if (!empty($_POST['cost'])) {
        if (!is_numeric($_POST['cost'])) {
            return "Введите число";
        }
        if ($_POST['cost'] < $min_bet) {
            return 'Введите коррктную цену';
        }
        return null;
    }
    return 'Это поле должно быть заполненным';
}

function date_bet($date) {
    $interval = date_diff(date_create($date), date_create());
    if ($interval->format('%I') < 1) {
        $seconds = $interval->format('%s');
        $noun = get_noun_plural_form($seconds, 'секунда', 'секунды', 'секунд');
        return "{$seconds} {$noun} назад";
    }
    elseif ($interval->format('%H') < 1) {
        $minutes = $interval->format('%i');
        $noun = get_noun_plural_form($minutes, 'минута', 'минуты', 'минут');
        return "{$minutes} {$noun} назад";
    }
    elseif ($interval->format('%d') < 1) {
        $hours = $interval->format('%h');
        $noun = get_noun_plural_form($hours, 'час', 'часа', 'часов');
        return "{$hours} {$noun} назад";
    }
    else {
        $date_form = date_format($date, "d.m.Y");
        $time_form = date_format($date, "H:i");
        return "{$date_form} в {$time_form}";
    }
}
