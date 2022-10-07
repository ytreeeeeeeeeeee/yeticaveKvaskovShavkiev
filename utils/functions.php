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
    if (intdiv($interval, 3600)) {
        return "timer--finishing";
    }
}
