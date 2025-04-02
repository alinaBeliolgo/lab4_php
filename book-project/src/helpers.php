<?php

/**
 * Сохраняет информацию о книге в файл.
 *
 * @param array $book Ассоциативный массив с данными книги (title, category, description, tags, date).
 * @return void
 */
function saveBook(array $book)
{
    $file = __DIR__ . '/../storage/books.txt';
    file_put_contents($file, json_encode($book) . PHP_EOL, FILE_APPEND);
}
