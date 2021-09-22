<?php

/**
 * Class Pages
 *
 * Methods for the index, about and phpinfo pages.
 *
 * Since these methods are static. They can also
 * be called directly by using Pages::methodName().
 */
class Pages
{
    // The index page method. Pages::index()
    public static function index() {

        // tell the static view method in the controller class, to load the index page.
        Controller::view('index');
    }

    // The about page method. Pages::about()
    public static function about() {

        // tell the static view method in the controller class, to load the about page.
        Controller::view('about');
    }

    // The phpinfo page method. Pages::phpinfo()
    public static function phpinfo() {

        // tell the static view method in the controller class, to load the phpinfo page.
        Controller::view('phpinfo');
    }
}


