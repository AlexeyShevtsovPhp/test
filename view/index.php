<?php

use app\model\Comment;
use app\Pagination;

/**
 * @var Comment[] $comments
 * @var int $startIndex
 * @var int $endIndex
 * @var int $totalPages
 * @var string $disabledFirstPage
 * @var string $disabledLastPage
 * @var int $prevPage
 * @var int $nextPage
 * @var Pagination $pagination
 * @var int $page
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Calculator</title>
    <link rel="stylesheet" href="/css/index.css">
</head>
<body>
<table>
    <th>Имя</th>
    <th>Комментарий</th>
    <?php foreach ($comments as $comment): ?>
        <tr>
            <td><?= $comment->user_name ?></td>
            <td><?= $comment->content ?></td>
        </tr>
    <?php endforeach ?>
</table>


<div class="small-button-right-container">
    <button class="small-button">-</button>
</div>


<div class="button-container">
    <button class="previous-page <?= $page == 0 ? 'disabled-first-page' : '' ?>"
            onclick="location.href='/?page=<?= $pagination->getPreviousPage($page) ?>'"
    >
        Назад
    </button>
    <button class="next-page <?= $page >= $totalPages - 1 ? 'disabled-last-page' : '' ?>"
            onclick="location.href='/?page=<?= $pagination->getNextPage($page) ?>'"
    >
        Вперёд
    </button>
</div>

<hr>
<form class="form-first" action="" method="post" >
    <div class="form-name">
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name">
    </div>

    <div class="form-message">
        <label for="message">Сообщение:</label>
        <textarea id="message" name="message"></textarea>
    </div>

    <div class="form-submit">
        <button id="submitButton" type="submit">Принять</button>
    </div>
</form>
</body>
</html>