<?php

require_once 'utils/helpers.php';
require_once 'utils/main-data.php';
require_once 'utils/init.php';
require_once 'utils/functions.php';

$categories = $con->query("SELECT * FROM categories")->fetchAll();

$title = 'Добавление лота';

if ($is_auth == 0) {
    header("Location: login.php");
    exit;
}

$cats_ids = array_column($categories, 'id');
$errors = [];
$post = $_POST;
$rules = [
    'lot-rate' => function() {
        return validateStartPrice();
    },
    'lot-date' => function() {
        return validateEndDate();
    },
    'lot-step' => function() {
        return validateLotStep();
    },
    'lot-name' => function() {
        return validateLotName();
    },
    'message' => function() {
        return validateDescription();
    },
    'category' => function($value) use ($cats_ids) {
        return validateCategory($value, $cats_ids);
    }
];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($post as $key => $value) {
        if (isset($rules[$key])){
            $rule = $rules[$key];
            $errors[$key] = $rule($value);
        }
    }
    $errors['img'] = validateImage();

    $errors = array_filter($errors);

    var_dump($errors);
    die;
}



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
