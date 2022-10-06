<?php

require_once 'utils/helpers.php';
require_once 'utils/main-data.php';

$title = 'Вход';

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
