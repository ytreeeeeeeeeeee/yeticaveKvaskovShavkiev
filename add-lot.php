<?php

require_once 'utils/helpers.php';
require_once 'utils/main-data.php';
require_once 'utils/init.php';

$categories = $con->query("SELECT * FROM categories")->fetchAll();

$title = 'Добавление лота';

$addContent = include_template('add-lot.php', ['categories' => $categories]);

$page_data = [
    'title' => $title,
    'content' => $addContent,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'categories' => $categories
];

$page = include_template('layout.php', $page_data);
echo $page;
