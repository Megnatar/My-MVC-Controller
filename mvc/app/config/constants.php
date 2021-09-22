<?php
/**
 * Site constants and namespaces
 *
 * I split them in these five following groups:
 *
 *  SITE AND DATABASE
 *  FOLDERS
 *  PAGES
 *  CLASSES
 *  URLS
 *
 *
 */
// SITE AND DATABASE


// Name of the site
define("SITE_NAME", "__̴ı̴̴̡̡̡ ̡͌l̡̡̡ ̡͌l̡*̡̡ ̴̡ı̴̴̡ ̡̡͡|̲̲̲͡͡͡ ̲▫̲͡ ̲̲̲͡͡π̲̲͡͡ ̲̲͡▫̲̲͡͡ ̲|̡̡̡ ̡ ̴̡ı̴̡̡ ̡͌l̡̡̡̡.___");

// Database constants.
define("DB_HOST", "127.0.0.1");
define("DB_NAME", "my_mvc");
define("DB_USER", "root");
define("DB_PASS", "");
define('DB_CHARSET', "utf8");


// FOLDERS


// App root folder: /mvc/app
define("APP_ROOT", dirname(dirname(__FILE__)));

// Controllers root folder: /mvc/app/controllers
define("CONTROLLERS_ROOT", APP_ROOT . "/controllers");

// Models root folder: /mvc/app/models
define("MODELS_ROOT", APP_ROOT . "/models");

// Views root folder: /mvc/app/views
define("VIEWS_ROOT", APP_ROOT . "/views");


// PAGES


// Page header
define("PAGE_HEAD", APP_ROOT . "/views/templates/head");

// Page top navigation
define("PAGE_NAVIGATION", APP_ROOT . "/views/templates/navigation");

// Page login
define("PAGE_LOGON", "/users/login");

// Page account
define("PAGE_ACCOUNT", "/users/account");

// Page confirm
define("PAGE_CONFIRM", "/users/confirm");

// Page register
define("PAGE_REGISTER", "/users/register");


// CLASSES


// Url_Handler class
define("URLHANDLER", APP_ROOT . "/lib/Url_Handler.php");

// Controller class
define("CONTROLLER", APP_ROOT . "/lib/Controller.php");

// Database class
define("DATABASE", APP_ROOT . "/lib/Database.php");


// URLS


// Url root
define("URL_ROOT", "http://localhost/mvc");

// Index page
define("URL_INDEX", URL_ROOT . "/index");

// Url path to user about
define("URL_PHPINFO", URL_ROOT . "/view/phpinfo");

// Url path to user about
define("URL_ABOUT", URL_ROOT . "/view/about");

// Url path to user login
define("URL_LOGIN", URL_ROOT . "/users/login");

// Url path to user logout
define("URL_LOGOUT", URL_ROOT . "/users/logout");

// Url path to user account
define("URL_ACCOUNT", URL_ROOT . "/users/account");

// Url path to user confirm
define("URL_CONFIRM", URL_ROOT . "/users/confirm");

// Url path to user register
define("URL_REGISTER", URL_ROOT . "/users/register");
