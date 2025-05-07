<?php

$router->get(uri: '', controller: 'index.php'); 
$router->get(uri: 'index', controller: 'index.php'); 
$router->get(uri: 'posts', controller: 'posts/index.php'); 
$router->get(uri: 'post', controller: 'post.php'); 
$router->get(uri: 'posts/create', controller: 'posts/create.php'); 
$router->post(uri: 'posts', controller: 'posts/store.php'); 
$router->delete(uri: 'posts', controller: 'posts/destroy.php'); 
$router->patch(uri: 'posts', controller: 'posts/rates.php'); 
$router->get(uri: 'posts/edit', controller: 'posts/edit.php'); 
$router->post(uri: 'posts/update', controller: 'posts/update.php'); 

$router->get(uri: 'contacts', controller: 'contacts.php');
$router->get(uri: 'about', controller: 'about.php');
$router->get(uri: 'new-post', controller: 'new-post.php'); 

$router->get(uri: 'register', controller: 'users/register.php');
$router->post(uri: 'register', controller: 'users/store.php');
$router->get(uri: 'login', controller: 'users/login.php');
$router->post(uri: 'login', controller: 'users/process-login.php');
$router->get(uri: 'logout', controller: 'users/logout.php'); 