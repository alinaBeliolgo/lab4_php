<?php

    $dataFile = __DIR__ . '/../storage/books.txt';

    $listings = file_exists($dataFile) ? file($dataFile, FILE_IGNORE_NEW_LINES) : []; 
    $listings = array_map(function($item) {
        return json_decode($item, true); 
    }, $listings);
    $recentListings = array_slice($listings, 0, 2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Объявления о книгах</title>
</head>
<body>
    <h1>Последние книги:</h1>

    <?php if (empty($recentListings)) : ?>
        <p>Объявлений пока нет.</p>

    <?php else : ?>
        <ul>
            <?php foreach ($recentListings as $listing) :?>
                <li>
                <strong><?= htmlspecialchars($listing['title']) ?></strong><br>
                    Жанр: <?= htmlspecialchars($listing['category']) ?><br>
                    Описание: <?= nl2br(htmlspecialchars($listing['description'])) ?><br>
                    <small>Теги: <?= implode(', ', $listing['tags']) ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <a href="/index.php">Смотреть все книги</a> |
    <a href="/create.php">Добавить книгу</a>
</body>
</html>