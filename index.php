<?php

use app\model\Comment;
use app\model\Guest;
use app\Pagination;

ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

$commentModel = new Comment();
$guestInsert = new Guest();

$page = $_GET['page'] ?? 0;
$comments = $commentModel->get($page);
$totalPages = $commentModel->getTotalPages();

$pagination = new Pagination($totalPages);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['message'])) {
    $name = !$_POST['name'] ? '' : trim($_POST['name']);
    $comment = !$_POST['message'] ? '' : ($_POST['message']);

    $success = false;

    if (!empty($name) && !empty($comment)) {
        $guestId = $guestInsert->insertNewGuest($name);
        $success = $commentModel->insert($guestId, $comment);
    }

    echo $success
        ?'<div class="notification">Ваш комментарий был успешно добавлен!</div>'
        :'<div class="notification-wrong">Необходимо заполнить все поля</div>';
}

require_once __DIR__ . '/view/index.php';
