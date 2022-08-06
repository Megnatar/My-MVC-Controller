<?php

/**
 * Class Url_Handler
 *
 * This class is responsible for getting and passing back urls.
 * It builds the method to load from the url
 * Returns path to method and|or parameters to caller via callback.
 */
class Url_Handler
{
    private $controller = "Pages";      // Default controller class.
    private $method = "index";          // Default method is the index page.
    private $params = [];               // Array to store url parameters.

    /**
     * Url_Handler constructor
     *
     * When called, formats url as array. Handles url namespace and callback calls.
     */
    public function __construct() {

        $url = $this->formatUrl();

        // Check if $url[] got any value. Then check if file below exists.
        // Default path is .....                     /app/controllers/Pages.php
       
        //if (isset($url[0]) && file_exists(CONTROLLERS_ROOT . "/" . ucwords($url[0]) . ".php")) {
        // UpperCase word OR empty string.
        
        if (isset($url[0]) && file_exists(CONTROLLERS_ROOT . "/" . ucwords($url[0]) ?? '') . '.php')){

            // If exists, set a new controller name. By default, file Pages.php.
            // Remove the controller from the $url[0].
            // I dont need it, since it's now $this->controller.
            $this->controller = ucwords($url[0]); $url[0] = "";

        }

        // Get the controller which, if not changed, is by default Pages.php.
        // Otherwise it's the Users.php controller.
        require_once CONTROLLERS_ROOT . "/" . $this->controller . ".php";

        // Create new controller object from the controller class. And store it in $this->controller.
        $this->controller = new $this->controller;

        // Check the second position of $url[1]. Which is our method in Pages.php or Users.php.
        if (isset($url[1])) {

            // When the page method exists.
            if (method_exists($this->controller, $url[1])) {

                // Create new method object. And remove method name from the array $url[1].
                $this->method = $url[1]; $url[1] = "";

            }
        }
        // Create new params object, when $url[..] is not empty. Otherwise return empty array.
        $this->params = $url ? array_values($url) : [];

        // callback the url with parameters to it's caller method in Pages.php or Users.php.
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * formatUrl method
     *
     * Formats the current url as array and remove illegal characters.
     * @return array
     */
    private function formatUrl() {

        if (isset($_GET["url"])) {

            // rtrim:       First remove the last forward slash from the url.
            // filter_var:  Then remove special characters from the url.
            // explode:     Return the url as array.
            return explode("/", filter_var(rtrim($_GET["url"], "/"), FILTER_SANITIZE_URL));
        }
    }
}
