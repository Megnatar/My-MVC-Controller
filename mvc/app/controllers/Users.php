<?php

/**
 * Class Users
 *
 * This controller class is responsible for handling account and user related stuff.
 */
class Users
{
    // Contains object from the User.php model. The SQL db instance and PDO methods.
    private $userModel;

    /**
     * Users constructor.
     * It will create $this->userModel object|model from the User.php class.
     */
    public function __construct() {
        $this->userModel = Controller::model("User");
    }

    //________________________________________________________________________________________________________
    // Below are all page methods. They are responsible for initiating loading and handling of secure pages.
    //________________________________________________________________________________________________________

    /**
     * Login method
     *
     * It handles error messages for when the user typed a wrong username or password. <-- MAYBE I SHOULD ADD A SEPARATE ERRORS CLASS?
     * Call methods from models/User.php and pass user data array to it. 
     * $this->userModel handles database related stuff.
     * And also login the user to the site.
     */
    public function login() {

        $userData = ["username" => "", "password" => "", "usernameError" => "", "passwordError" => ""];

        // If server supper global property REQUEST_METHOD is POST.
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // Remove unwanted characters from the username or password.
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $userData = ["username" => trim($_POST["username"]), "password" => trim($_POST["password"]),
                "usernameError" => "", "passwordError" => ""];

            // Set username error.
            if (empty($userData["username"])) {
                $userData["usernameError"] = "Please enter you're username.";
            }
            // Set password error.
            if (empty($userData["password"])) {
                $userData["passwordError"] = "Please enter you're password.";
            }
            // When no errors occurred.
            if (empty($userData["usernameError"]) && empty($userData["passwordError"])) {

                // Call the login() method in file mvc/app/models/User.php. Retrieve user row from table and store result in $loggedInUser.
                $loggedInUser = $this->userModel->login($userData["username"], $userData["password"]);

                // Login the user when $loggedInUser contains data. Meaning the username and password are correct.
                if ($loggedInUser !== false) {
                    $this->createUserSession($loggedInUser);

                    // Redirect browser to the account page.
                    header("location:" . URL_ACCOUNT);

                    // Prevent controller from try and load the logon page below.
                    exit;

                } else {

                    // Otherwise add error message to the data array.
                    $userData["passwordError"] = "Something went wrong. Please try again.";
                }
            }
        }
        // Tell the controller to load the page into the browser. Pass the $userData array to the method.
        Controller::view(PAGE_LOGON, $userData);
    }

    /**
     * register method.
     *
     * Check for post requests to the server.
     * Call methods from to the models/User.php model. $this->userModel handles database related stuff
     * When nothing is posted, tell the controller to load the page.
     */
    public function register() {

        $userData = ["username" => "","email" => "", "password" => "", "confirmPassword" => "",
            "usernameError" => "", "emailError" => "", "passwordError" => "", "confirmPasswordError" => ""];


        // If there is any post request to the server.
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // Remove unwanted characters from $_POST variable INPUT_POST.
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $userData = ["username" => trim($_POST["username"]),"email" => trim($_POST["email"]),
                "password" => trim($_POST["password"]), "confirmPassword" => trim($_POST["confirmPassword"]),
                "usernameError" => "", "emailError" => "", "passwordError" => "", "confirmPasswordError" => ""];

            // Check for any error.
            $userData = $this->usernameCheck($userData); $userData = $this->emailCheck($userData); $userData = $this->passwordCheck($userData);

            // When everything is fine. Hash the user password.
            if (empty($userData["usernameError"]) && empty($userData["emailError"]) && empty($userData["passwordError"]) && empty($userData["confirmPasswordError"])) {

                $userData["password"] = password_hash($userData["password"], PASSWORD_DEFAULT);

                // Store user information in the database.
                if ($this->userModel->register($userData)) {

                    // Registration was successful so return to login page. <-- MAYBE, I SHOULD AUTO LOG ON THE USER?
                    header("location: " . URL_LOGIN);

                    // Prevent controller from try and load the register page below.
                    exit;

                } else {

                    // Return error message.
                    exit("Error occurred!");
                }
            }
        }
        // Tell the controller to load the page into the browser. Pass the $userData array to the method.
        Controller::view(PAGE_REGISTER, $userData);
    }

    /**
     * account method.
     *
     * Check for post requests to the server.
     * Call methods from to the models/User.php model. $this->userModel handles database related stuff
     * When nothing is posted, tell the controller to load the page.
     */
    public function account() {

        $userData = ["username" => "","email" => "", "password" => "", "confirmPassword" => "",
            "usernameError" => "", "emailError" => "", "passwordError" => "", "confirmPasswordError" => ""];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // Update email.
            if (isset($_POST) && $_POST["submit"] == "email" && !empty($_POST["email"])) {
                $userData = ["username" => $_POST["username"], "email" => trim($_POST["email"]), "password" => "", "confirmPassword" => "",
                    "usernameError" => "", "emailError" => "", "passwordError" => "", "confirmPasswordError" => ""];

                // Check to see if the email already exists in the database.
                if ($this->userModel->findUserByEmail($userData["email"])) {

                    // Update it when none is found.
                    $userData["emailError"] = "Email is already in use.";
                } else {
                    // Set error message to success. Let the user know there email changed. Update session email.
                    if ($this->userModel->updateEmail($userData)) {
                        $userData["emailError"] = "You're email changed successfully!"; $_SESSION["email"] = $userData["email"];
                    }
                }
            }
            // Update password.
            if (isset($_POST) && $_POST["submit"] === "password") {

                $userData = ["username" => $_POST["username"], "email" => "", "password" => trim($_POST["password"]), "confirmPassword" => trim($_POST["confirmPassword"]),
                    "usernameError" => "", "emailError" => "", "passwordError" => "", "confirmPasswordError" => "" ];

                // Check if the passwords match and use the correct format.
                $userData = $this->passwordCheck($userData);

                // When all is fine, add new password to the database.
                if (empty($userData["passwordError"]) && empty($userData["confirmPasswordError"])) {

                    $userData["password"] = password_hash($userData["password"], PASSWORD_DEFAULT);
                    $userData["passwordError"] = "You're password changed successfully!";
                    $this->userModel->updatePassword($userData);
                }
            }
        }

        // Load the account details page when a user session exists.
        if (isset($_SESSION['user_id'])) {

            // Tell the controller to load the page into the browser.
            Controller::view(PAGE_ACCOUNT, $userData);

        } else {

            // Return to index page when url http://localhost/mvc/users/account is passed to the browser.
            header("location:" . URL_INDEX);
        }
    }

    /**
     * confirm method.
     *
     * Check for post requests to the server.
     * Call methods from to the models/User.php model. $this->userModel handles database related stuff
     * When nothing is posted, tell the controller to load the page.
     */
    public function confirm() {

        // When the user clicked oke on the confirmation page.
        if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["submit"] === "Ok" && !empty($_POST["username"])) {

            // Try to remove the account and logout when removing the account was successful.
            if ($this->userModel->deleteAccount($_POST["username"])) {

                $this->logout();
            }
            // When the user canceled deleting the account.
        } else if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["submit"] === "Cancel") {

            // Return to account page.
            header("location:" . URL_ACCOUNT);

            // Prevent controller to try and load the confirmation page below.
            exit();
        }

        // Tell the controller to load the page into the browser. Pass the $userData array to the method.
        if (isset($_SESSION['user_id'])) {

            // Tell the browser to load the confirmation page.
            Controller::view(PAGE_CONFIRM);

        } else {

            // Return to index page when url http://localhost/mvc/users/confirm is passed to the browser.
            header("location:" . URL_INDEX);;
        }
    }

    //________________________________________________________________________________________________________
    //  The code below are all helper methods.
    //________________________________________________________________________________________________________

    /**
     * usernameCheck method
     * 
     * Check the username for any errors.
     *
     * @param array $userData
     * @return array $userData
     */
    private function usernameCheck($userData) {
        // Validate name. This string can have any lower and uppercase letter and a number.
        $nameValidation = "/^[a-zA-Z0-9]*$/";

        // When there is no username.
        if (empty($userData["username"])) {

            // Store error message in the data array.
            $userData["usernameError"] = "Please enter username.";

            // Or when the user name does not match the format.
        } elseif (!preg_match($nameValidation, $userData["username"])) {

            // Store error message in data array.
            $userData["usernameError"] = "Name can only contain letters and numbers.";
        }
        return $userData;
    }

    /**
     * passwordCheck method
     * 
     * Check the password for any errors.
     *
     * @param  array $userData
     * @return array $userData
     */
    private function passwordCheck($userData) {
        $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

        if (empty($userData["password"])) {
            $userData["passwordError"] = "Please enter password.";
        } elseif (strlen($userData["password"]) < 6) {
            $userData["passwordError"] = "Password must be at least 8 characters";
        } elseif (preg_match($passwordValidation, $userData["password"])) {
            $userData["passwordError"] = "Password must be have at least one numeric value.";
        }

        if (empty($userData["confirmPassword"])) {
            $userData["confirmPasswordError"] = "Please enter password.";
        } else {
            if ($userData["password"] != $userData["confirmPassword"]) {
                $userData["confirmPasswordError"] = "Passwords do not match, please try again.";
            }
        }
        return $userData;
    }

    /**
     * emailCheck method
     * 
     * Check the email for any errors.
     *
     * @param array $userData
     * @return array $userData
     */
    private function emailCheck($userData) {
        if (empty($userData["email"])) {
            $userData["emailError"] = "Please enter email address.";

        } elseif (!filter_var($userData["email"], FILTER_VALIDATE_EMAIL)) {
            $userData["emailError"] = "Please enter the correct format.";

        } else {
            if ($this->userModel->findUserByEmail($userData["email"])) {
                $userData["emailError"] = "Email is already in use.";
            }
        }
        return $userData;
    }

    /**
     * createUserSession method
     * 
     * Create a new user session and store it's information in supper global $_SESSION.
     * Reroute the browser to the index page.
     *
     * @param object $loggedInUser
     */
    private function createUserSession($loggedInUser) {
        $_SESSION["user_id"] = $loggedInUser->id; $_SESSION["username"] = $loggedInUser->username;  $_SESSION["email"] = $loggedInUser->email;
        header("location:" . URL_INDEX);
    }

    /**
     * logout method
     * 
     * Remove or delete user session and return to login page.
     * Reroute the browser to the login page.
     */
    public function logout() {
        unset($_SESSION["user_id"]); unset($_SESSION["username"]); unset($_SESSION["email"]);
        header("location:" . URL_INDEX);
    }
}
