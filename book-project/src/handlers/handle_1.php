<?php


require_once __DIR__ . '/../helpers.php';



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    $tags = $_POST['tags'] ?? [];
    $tags = (array) $tags;

    $errors = [];

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

    $newBook = [
        'title' => htmlspecialchars($title),
        'category' => htmlspecialchars($category),
        'description' => nl2br(htmlspecialchars($description)),
        'tags' => array_map('htmlspecialchars', $tags),
        'date' => date('Y-m-d H:i:s')
    ];

    saveBook($newBook);

    header('Location: /index.php');
}
