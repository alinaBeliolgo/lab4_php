<?php
function saveBook(array $book)
{
    $file = __DIR__ . '/../storage/books.txt';
    file_put_contents($file, json_encode($book) . PHP_EOL, FILE_APPEND);
}
