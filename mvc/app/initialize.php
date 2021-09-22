<?php

// Include site constants.
require_once 'config/constants.php';

// Include class libraries.
require_once URLHANDLER;
require_once CONTROLLER;
require_once DATABASE;

// Start browser session when none exists.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// start the Url_Handler class.
new Url_Handler();
