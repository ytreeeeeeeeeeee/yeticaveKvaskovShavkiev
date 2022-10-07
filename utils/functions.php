<?php

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
    return intdiv($interval, 3600) . ":" . $interval%60;
}
