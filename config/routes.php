<?php

// карта маршрутов
//POSTS
$router->get(uri: '', controller: 'index.php'); // Home page
$router->get(uri: 'index', controller: 'index.php'); // Home page alternate
$router->get(uri: 'posts', controller: 'posts/index.php'); // All posts listing
$router->get(uri: 'post', controller: 'post.php'); // Single post view
$router->get(uri: 'posts/create', controller: 'posts/create.php'); // Create new post form
$router->post(uri: 'posts', controller: 'posts/store.php'); // Store new post
$router->delete(uri: 'posts', controller: 'posts/destroy.php'); // Delete post
$router->patch(uri: 'posts', controller: 'posts/rates.php'); // Update post rating

//PAGES
$router->get(uri: 'contacts', controller: 'contacts.php');
$router->get(uri: 'about', controller: 'about.php');
$router->get(uri: 'new-post', controller: 'new-post.php'); 

//USER
$router->get(uri: 'register', controller: 'users/register.php');
$router->post(uri: 'register', controller: 'users/store.php');
$router->get(uri: 'login', controller: 'users/login.php');
$router->post(uri: 'login', controller: 'users/process-login.php');
$router->get(uri: 'logout', controller: 'users/logout.php'); 