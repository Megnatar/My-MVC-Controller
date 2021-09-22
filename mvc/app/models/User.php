<?php

/**
 * Class User
 *
 * Use PDO with prepared statements to communicate with the SQL database.
 */
class User
{
    public $db;

    /**
     * User constructor.
     *
     * Create new private subtraction from the Database.php class.
     */
    public function __construct() {
        $this->db = new Database;
    }

    /**
     * Logon method
     *
     * Check if the password matches the one in the database
     *
     * @param string $username
     * @param string $password
     * @return object|bool The object returned, is the user row in the database.
     */
    public function login($username, $password) {

        // Prepare the database to retrieve user row.
        // User::db->prepare("SELECT * FROM users WHERE username = :username");
        $this->db->prepare("SELECT * FROM users WHERE username = :username");

        // Bind username to it's placeholder.
        $this->db->bind(":username", $username);

        // Get row from database containing the user settings.
        $tableRow = $this->db->fetchRow();

        // Check if a password exists and is correct.
        if (isset($tableRow->password) && password_verify($password, $tableRow->password)) {
            return $tableRow;
        } else {
            return false;
        }
    }

    /**
     * register method
     *
     * Save new user information in the database
     *
     * @param array $userData
     * @return bool
     */
    public function register($userData) {

        // Prepare the database to insert new user into the table.
        $this->db->prepare("INSERT INTO users (username, email, password) VALUES(:username, :email, :password)");

        // Bind properties to there placeholders.
        $this->db->bind(":username", $userData["username"]);  $this->db->bind(":email", $userData["email"]);
        $this->db->bind(":password", $userData["password"]);

        // Submit to the database and return success or failure.
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * updatePassword method
     *
     * Hash and save new password to the database.
     * 
     * @param array $userData
     * @return bool
     */
    public function updatePassword($userData) {

        // Prepare the database to update the password.
        $this->db->prepare("UPDATE users SET password = :password WHERE username = :name");

        // Bind username and password to there placeholders.
        $this->db->bind(":name", $userData["username"]); $this->db->bind(":password", $userData["password"]);

        // Execute the prepared statement to update password. Return success or failure.
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * deleteAccount method
     *
     * Delete the user from the database.
     *
     * @param string $username
     * @return bool
     */
    public function deleteAccount($username) {

        // Prepare the database to delete the account.
        $this->db->prepare("DELETE FROM users WHERE username = :name");

        // Bind username to it's placeholder.
        $this->db->bind(":name", $username);

        // Execute the prepared statement to remove account. Return success or failure.
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * updateEmail method
     *
     * Let the user change his or her email address.
     *
     * @param array $userData
     * @return bool
     */
    public function updateEmail($userData) {

        // Prepare the database to update the email address.
        $this->db->prepare("UPDATE users SET email = :email WHERE username = :name");

        // Bind username and email properties to there placeholders.
        $this->db->bind(":name", $userData["username"]); $this->db->bind(":email", $userData["email"]);

        // Execute the prepared statement to update email address. Return success or failure.
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * findUserByEmail method
     *
     * Check if the email address exists in the database.
     *
     * @param string $email
     * @return bool
     */
    public function findUserByEmail($email) {

        // Prepare the database to retrieve the email address.
        $this->db->prepare("SELECT * FROM users WHERE email = :email");

        // Bind email property to it's placeholder.
        $this->db->bind(":email", $email);

        // Execute the prepared statement to search for email. Return success or failure.
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
