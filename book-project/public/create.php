<?php 

require_once __DIR__ . "/../src/handlers/handle_1.php"; ?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить книгу</title>
</head>
<body>
    <h1>Добавьте книгу в каталог</h1>
    <form action="<?= $_SERVER["PHP_SELF"]; ?>" method="post">
        <label>Название книги:
            <input type="text" name="title" required>
        </label>

        <label>Жанр:
            <select name="category" required>
                <option value="fantasy">Фэнтези</option>
                <option value="detective">Детектив</option>
                <option value="science fiction">Научная фантастика</option>
                <option value="history">Историческое</option>
                <option value="romance">Романтика</option>
                <option value="drama">Драма</option>
            </select>
        </label>

        <label>Описание:
            <textarea name="description" required></textarea>
        </label>

        <label>Состояние книги:
            <select name="tags[]" multiple>
                <option value="new">Новая</option>
                <option value="rare">Редкое издание</option>
                <option value="bestseller">Бестселлер</option>
                <option value="classic">Классика</option>
            </select>
        </label>

        <button type="submit">Добавить</button>
    </form>
</body>
</html>
