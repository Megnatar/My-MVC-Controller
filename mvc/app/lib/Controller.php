<?php

/**
 * Class Controller
 *
 * The controller is responsible for loading the pages at the front.
 * Or returning objects when sensitive information is handled.
 */
class Controller
{
    /**
     * model method
     *
     * Loads models from /app/models
     *
     * @param string The name of the module to load.
     * @return object Abstraction from the model class.
     */
    public static function model($model) {

        // require model, which is file: /mvc/app/models/User.php
        require_once MODELS_ROOT . "/" . $model . ".php";

        // Return a subtractions of the User model to the Users controller.
        return new $model();
    }

    /**
     * view method
     *
     * Load the pages at the front from /app/views/*
     *
     * @param string The name of the page to load.
     * @param array Holds various user related properties.
     */
    public static function view($page, $userData = []) {

        // See if the requested page exists.
        if (file_exists(VIEWS_ROOT . "/" . $page . ".php")) {

            // Load the page into the browser.
            require_once VIEWS_ROOT . "/" . $page . ".php";

        } else {

            // Exit with error message when no page is found.
            exit("File doesn't exist!");
        }
    }
}