<?php

require_once 'utils/init.php';
require_once 'utils/main-data.php';
require_once 'utils/helpers.php';
require_once 'utils/functions.php';

$categories = $con->query("SELECT * FROM categories")->fetchAll();

$id = intval($_GET['id'] ?? null);

$sql_lot = "SELECT
            l.title,
            l.description,
            l.image_url,
            l.start_price,
            l.end_date,
            c.title AS category
        FROM lots l
        JOIN categories c ON l.category_id = c.id
        WHERE l.id=?";

$stmt_lot = $con->prepare($sql_lot);
$stmt_lot->execute([$id]);
$lot_info = $stmt_lot->fetch();

if (!$lot_info) {
    header("Location: http://ye/error.php");
}
else {
    $top_bet = top_bet($id, $con);

    $min_bet = min_next_bet($id, $top_bet, $con);

    $title = $lot_info['title'];

    $lotContent = include_template('lot-page.php', ['categories' => $categories, 'lot_info' => $lot_info, 'top_bet' => $top_bet, 'min_bet' => $min_bet]);

    $page_data = [
        'title' => $title,
        'content' => $lotContent,
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'categories' => $categories
    ];

    $page = include_template('layout.php', $page_data);
    echo $page;
}
