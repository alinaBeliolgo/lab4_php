<?php


require_once __DIR__ . '/../helpers.php';


/**
 * Обрабатывает запрос для добавления новой книги в систему
 *
 * Проверяет поля формы, выводит ошибки, если они есть, и сохраняет книгу в books.txt
 *
 * @return
 */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    $tags = $_POST['tags'] ?? [];
    $tags = (array) $tags;

    $errors = [];


    // Проверка обязательных полей
    if (empty($title)) {
        $errors[] = "Название книги обязательно.";
    }
    if (empty($category)) {
        $errors[] = "Выберите жанр.";
    }
    if (empty($description)) {
        $errors[] = "Введите описание.";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        echo "<a href='/create.php'>Назад</a>";
        exit;
    }

    //данные о новой книге
    $newBook = [
        'title' => htmlspecialchars($title),
        'category' => htmlspecialchars($category),
        'description' => nl2br(htmlspecialchars($description)),
        'tags' => array_map('htmlspecialchars', $tags),
        'date' => date('Y-m-d H:i:s')
    ];

    //сохраняет книгу в файл
    saveBook($newBook);

    header('Location: /index.php');
}
