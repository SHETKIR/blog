<?php
session_start();

define(constant_name: 'PATH', value: 'https://blog.dvl.to/');
define(constant_name: 'ROOT', value: dirname(path: __DIR__));

define(constant_name: 'PUBLIC', value: ROOT.'/public');
define(constant_name: 'CORE', value: ROOT.'/core');
define(constant_name: 'CONFIG', value: ROOT.'/config');
define(constant_name: 'CLASSES', value: CORE.'/classes');

define(constant_name: 'APP', value: ROOT.'/app');
define(constant_name: 'VIEWS', value: APP.'/views');
define(constant_name: 'COMPONENTS', value: VIEWS.'/components');
define(constant_name: 'CONTROLLERS', value: APP.'/controllers');
define(constant_name: 'ERRORS', value: VIEWS.'/errors');
define(constant_name: 'POSTS_VIEWS', value: VIEWS.'/posts');

require_once(CORE . '/functions.php');