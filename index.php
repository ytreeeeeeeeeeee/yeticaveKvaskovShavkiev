<?php

require_once 'utils/helpers.php';
require_once 'utils/main-data.php';
require_once 'utils/functions.php';

$title = 'Главная';

$indexContent = include_template('main.php', ['ads' => $ads, 'categories' => $categories]);

$page_data = [
    'title' => $title,
    'content' => $indexContent,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'categories' => $categories
];

$page = include_template('layout.php', $page_data);
echo $page;
