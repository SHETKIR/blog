<?php
// Debug mode
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Load configuration
require_once(dirname(path: __DIR__).'/config/config.php');

// Load core files
require_once CORE.'/functions.php';
require_once CORE.'/db.php'; // This loads DB class and creates connection
require_once CORE.'/router.php'; // This processes routes and loads controllers