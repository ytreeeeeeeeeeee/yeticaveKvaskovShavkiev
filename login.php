<?php

require_once 'utils/helpers.php';
require_once 'utils/init.php';
require_once 'utils/functions.php';

$title = 'Вход';

$categories = $con->query("SELECT * FROM categories")->fetchAll();

$errors = [];
$post = $_POST;
$rules = [
    'email' => function() use ($con) {
        return validateEmail($con);
    },
    'password' => function() {
        return validateField('password');
    }
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($post as $key => $value) {
        if (isset($rules[$key])) {
            $rule = $rules[$key];
            $errors[$key] = $rule($value);
        }
    }
    $errors = array_filter($errors);

    if (empty($errors)) {
        $stmt = $con->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->execute(['email' => $post['email']]);

        if ($stmt->rowCount()==0) {
            $errors['email'] = "Пользователь с этим email не зарегестрирован";
        }
        else{
            $dbUser = $stmt->fetch();
            if (password_verify($post['password'], $dbUser['password'])) {
                $_SESSION['user_id'] = $dbUser['id'];
                $_SESSION['user_name'] = $dbUser['user_name'];
                header("Location: index.php");
            }
            else {
                $errors['password'] = "Неверный пароль";
            }
        }
    }
}

$loginContent = include_template('login.php', ['categories' => $categories, 'errors' => $errors]);

$page_data = [
    'title' => $title,
    'content' => $loginContent,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'categories' => $categories
];

$page = include_template('layout.php', $page_data);

echo $page;
