<?php

require_once 'utils/helpers.php';
require_once 'utils/main-data.php';
require_once 'utils/functions.php';
require_once 'utils/init.php';

$categories = $con->query("SELECT * FROM categories")->fetchAll();

$title = 'Регистрация';

$errors = [];
$post = $_POST;
$rules = [
    'email' => function() use ($con) {
        return validateEmail($con);
    },
    'password' => function() {
        return validateField('password');
    },
    'name' => function() {
        return validateField('name');
    },
    'message' => function() {
        return validateField('message');
    }
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($post as $key => $value) {
        if (isset($rules[$key])){
            $rule = $rules[$key];
            $errors[$key] = $rule($value);
        }
    }

    $errors = array_filter($errors);

    if (empty($errors)) {
        $sql = "INSERT INTO users(reg_date, email, user_name, password, contact) VALUES (NOW(), ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->execute([$post['email'], $post['name'], password_hash($post['password'], PASSWORD_DEFAULT), $post['message']]);

        header("Location: https://yeti/login.php");
    }
}

$signupContent = include_template('sign-up.php', ['categories' => $categories, 'errors' => $errors]);

$page_data = [
    'title' => $title,
    'content' => $signupContent,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'categories' => $categories
];

$page = include_template('layout.php', $page_data);

echo $page;
