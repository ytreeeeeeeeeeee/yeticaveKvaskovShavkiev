<?php

require_once 'utils/init.php';
require_once 'utils/helpers.php';
require_once 'utils/functions.php';

$categories = $con->query("SELECT * FROM categories")->fetchAll();

$id = intval($_GET['id'] ?? null);

$top_bet = top_bet($id, $con);

$min_bet = min_next_bet($id, $top_bet, $con);

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

$sql_bets = "SELECT b.date_bet,
                b.bet_amount,
                u.user_name
                FROM bets b
                JOIN users u ON b.user_id = u.id
                WHERE b.lot_id = ?
                ORDER BY b.date_bet DESC
                LIMIT 10";

$sql_cou = "SELECT COUNT(id) as cou
             FROM bets
             WHERE lot_id = ?";

$stmt_cou = $con->prepare($sql_cou);
$stmt_cou->execute([$id]);
$cou = $stmt_cou->fetch();

$stmt_bets = $con->prepare($sql_bets);
$stmt_bets->execute([$id]);
$bets_info = $stmt_bets->fetchAll();

$post = $_POST;
$rules = [
    'cost' => function () use ($min_bet) {
        return validateBet($min_bet);
    }
];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($post as $key => $value) {
        if (isset($rules[$key])){
            $rule = $rules[$key];
            $errors[$key] = $rule($value);
        }
    }

    $errors = array_filter($errors);

    if (empty($errors)) {
        $sql = "INSERT INTO bets(date_bet, bet_amount, user_id, lot_id) VALUES (NOW(), ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->execute([$post['cost'], $_SESSION['user_id'], $id]);
        header("Location: lot.php?id={$id}");
    }
}

if (!$lot_info) {
    header("Location: error.php");
    exit();
}
else {
    $title = $lot_info['title'];

    $lotContent = include_template('lot-page.php', ['id' => $id,
        'categories' => $categories,
        'lot_info' => $lot_info,
        'top_bet' => $top_bet,
        'min_bet' => $min_bet,
        'is_auth' => $is_auth,
        'errors' => $errors,
        'bets_info' => $bets_info,
        'cou' => $cou
    ]);

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
