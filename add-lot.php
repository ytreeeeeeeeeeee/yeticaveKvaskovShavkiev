<?php

require_once 'utils/helpers.php';
require_once 'utils/main-data.php';

$title = 'Добавление лота';

$addContent = include_template('add-lot.php');

$page_data = [
    'title' => $title,
    'content' => $addContent,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'categories' => $categories
];

$page = include_template('layout.php', $page_data);
echo $page;
