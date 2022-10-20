<?php

require_once 'utils/helpers.php';
require_once 'utils/functions.php';
require_once 'utils/init.php';


$categories = $con->query("SELECT * FROM categories")->fetchAll();

$searchText = $_GET['search'] ?? null;

$stmt = $con->prepare("SELECT l.id, l.title, c.title AS category, l.image_url, l.start_price, l.end_date
                                FROM lots l
                                JOIN categories c
                                ON l.category_id = c.id
                                WHERE MATCH(l.title, l.description) AGAINST(:searchText) and l.end_date > NOW()
                                ORDER BY l.date_of_creation DESC");

$stmt->execute(['searchText' => $searchText]);
$ads = $stmt->fetchAll();

$title = 'Поиск';

$searchContent = include_template('search.php', ['ads' => $ads, 'categories' => $categories]);

$page_data = [
    'title' => $title,
    'content' => $searchContent,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'categories' => $categories
];

$page = include_template('layout.php', $page_data);

echo $page;
