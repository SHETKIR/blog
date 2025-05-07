<?php

return [
    'host' => 'mysql',
    'username' => 'root',
    'password' => 'mypassword',
    'charset' => 'utf8', // utf8mb4 если латин utf8
    'dbname' => 'blog',
    'options' => [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //массив с именами столбов
        // PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //до 8
    ],
]; 