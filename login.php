<?php

require_once 'utils/helpers.php';
require_once 'utils/main-data.php';
require_once 'utils/init.php';

$title = 'Вход';

$categories = $con->query("SELECT * FROM categories")->fetchAll();

$loginContent = include_template('login.php', ['categories' => $categories]);

$page_data = [
    'title' => $title,
    'content' => $loginContent,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'categories' => $categories
];

$page = include_template('layout.php', $page_data);

echo $page;
