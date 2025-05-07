<?php

return [
    'host' => 'mysql',
    'username' => 'root',
    'password' => 'mypassword',
    'charset' => 'utf8', 
    'dbname' => 'blog',
    'options' => [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ],
]; 