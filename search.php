<?php

require_once 'utils/helpers.php';
require_once 'utils/functions.php';
require_once 'utils/init.php';


$categories = $con->query("SELECT * FROM categories")->fetchAll();

$searchText = $_GET['search'] ?? null;
$pageNum = $_GET['page'] ?? 1;
$limit = 3;

$stmt_all_ads = $con->prepare("SELECT COUNT(id) as cou FROM lots WHERE MATCH(title, description) AGAINST(:searchText) and end_date > NOW()");
$stmt_all_ads->execute(['searchText' => $searchText]);
$all_ads = $stmt_all_ads->fetch();

$pageCount = intval(ceil(intval($all_ads['cou'])/$limit)) ;

if($pageCount == 0){
    $pageCount = 1;
}

if($pageNum < 1 or $pageNum > $pageCount){
    header('Location: error.php');
    exit;
}

$offset = ($pageNum - 1) * $limit;

$stmt = $con->prepare("SELECT l.id, l.title, c.title AS category, l.image_url, l.start_price, l.end_date
                                FROM lots l
                                JOIN categories c
                                ON l.category_id = c.id
                                WHERE MATCH(l.title, l.description) AGAINST(:searchText) and l.end_date > NOW()
                                ORDER BY l.date_of_creation DESC
                                LIMIT :limit OFFSET :offset");

$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':searchText', $searchText);
$lot = $stmt->execute();
$ads = $stmt->fetchAll();

$title = 'Поиск';

$searchContent = include_template('search.php', ['ads' => $ads, 'categories' => $categories, 'request' => $searchText, 'pageNum' => $pageNum, 'pageCount' => $pageCount]);

$page_data = [
    'title' => $title,
    'content' => $searchContent,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'categories' => $categories
];

$page = include_template('layout.php', $page_data);

echo $page;
