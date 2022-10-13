<?php

$categories = $con->query("SELECT * FROM categories")->fetchAll();

$id = $_GET['id'];

$sql = "SELECT
            l.title,
            l.description,
            l.image_url,
            l.start_price,
            c.title AS category
        FROM lot l
        JOIN categories c ON l.category_id = c.id
        WHERE l.id = ?";

$title = $;


$lotContent = include_template('lot-page.php', ['categories' => $categories]);

$page_data = [
    'title' => $title,
    'content' => $lotContent,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'categories' => $categories
];

$page = include_template('layout.php', $page_data);
echo $page;
