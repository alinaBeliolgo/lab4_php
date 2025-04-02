<?php


    $dataFile = __DIR__ . '/../storage/books.txt';

    /**
    * Получает список книг из файла.
    * 
    * @return array Массив книг, загруженных из файла.
    */ 
    $listings = file_exists($dataFile) ? file($dataFile, FILE_IGNORE_NEW_LINES) : []; 
    $listings = array_map(function($item) {
        return json_decode($item, true); 
    }, $listings);



    /**
    * Рассчитывает общее количество страниц для пагинации.
    * @param int $totalBooks Общее количество книг.
    * @param int $perPage Количество книг на одной странице. 
    * @return int Общее количество страниц.
 */
    $perPage = 5; 
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;  //по умолчанию 1
    $totalPages = ceil(count($listings) / $perPage);// Общее количество
    $page = max(1, min($page, $totalPages)); // Ограничиваем страницу от 1 до последней

    /**
    * Получает список книг для текущей страницы.
    */
    $offset = ($page - 1) * $perPage;
    $currentListings = array_slice($listings, $offset, $perPage);
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

    <?php if (empty($currentListings)) : ?>
        <p>Объявлений пока нет.</p>

    <?php else : ?>
        <ul>
            <?php foreach ($currentListings as $listing) :?>
                <li>
                <strong><?= htmlspecialchars($listing['title']) ?></strong><br>
                    Жанр: <?= htmlspecialchars($listing['category']) ?><br>
                    Описание: <?= nl2br(htmlspecialchars($listing['description'])) ?><br>
                    <small>Теги: <?= implode(', ', $listing['tags']) ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <div>
        <?php if ($page > 1) : ?>
            <a href="?page=<?= $page - 1 ?>">« Назад</a>
        <?php endif; ?>

        <span>Страница <?= $page ?> из <?= $totalPages ?></span>

        <?php if ($page < $totalPages) : ?>
            <a href="?page=<?= $page + 1 ?>">Вперед »</a>
        <?php endif; ?>
    </div>
    
    <a href="/index.php">Смотреть все книги</a> |
    <a href="/create.php">Добавить книгу</a>
</body>
</html>