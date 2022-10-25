<?php


require_once 'utils/helpers.php';
require_once 'utils/functions.php';
require_once 'utils/init.php';

$categories = $con->query("SELECT * FROM categories")->fetchAll();

$sql_bets = "SELECT b.date_bet,
                b.bet_amount,
                l.title,
                l.end_date,
                l.image_url,
                c.title as category,
                l.id as lot_id,
                u.contact,
                b.id as bet_id
                FROM bets b
                JOIN users u ON b.user_id = u.id
                JOIN lots l ON b.lot_id = l.id
                JOIN categories c ON l.category_id = c.id
                WHERE u.id = ?
                ORDER BY b.date_bet DESC";

$stmt = $con->prepare($sql_bets);
$stmt->execute([$_SESSION['user_id']]);
$list_bets = $stmt->fetchAll();

$title = 'Мои ставки';

$mybetsContent = include_template('my-bets.php', ['categories' => $categories, 'list_bets' => $list_bets, 'con' => $con]);

$page_data = [
    'title' => $title,
    'content' => $mybetsContent,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'categories' => $categories
];

$page = include_template('layout.php', $page_data);

echo $page;
