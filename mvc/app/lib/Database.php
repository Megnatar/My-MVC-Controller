<?php

/**
 * Class Database
 *
 * This class contains the information for our SQL database.
 * The Database class also contains all the PDO methods for data and query handling.
 */
class Database
{
    // Store site constants in private properties.
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;
    private $dbCharset = DB_CHARSET;

    private $statement;
    private $dbHandler;
    private $error;

    /**
     * Database constructor.
     *
     * Creates database connection and stores the pdo object in $this->dbHandler.
     */
    public function __construct() {

        // Create data source name.
        $dsn = "mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName . ";charset=" . $this->dbCharset;

        // Database options with: persistent connection, error-lvl exceptions, server excepts no preparsed data.
        $options = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false);

        // Try the connection.
        try {
            // Make new pdo object $this->dbHandler.
            $this->dbHandler = new PDO($dsn, $this->dbUser, $this->dbPass, $options);

        // Return error message if something is wrong.
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    /**
     * prepare method
     *
     * Prepare SQL statement for execution.
     *
    * @param $query
    */
    public function prepare($query) {
        $this->statement = $this->dbHandler->prepare($query);
    }

    /**
     * Execute method.
     *
     * @return bool
     */
    public function execute() {
        return $this->statement->execute();
    }

    /**
     * bind method
     *
     * Bind value's to there correct data type.
     *
     * @param $parameter
     * @param $value
     * @param null|mixed $varType
     */
    public function bind($parameter, $value, $varType = null) {

        if (is_null($varType)) {
            if (is_int($value)) {
                $varType = PDO::PARAM_INT;
            } else if (is_bool($value)) {
                $varType = PDO::PARAM_BOOL;
            } else if (is_null($value)) {
                $varType = PDO::PARAM_NULL;
            } else {
                $varType = PDO::PARAM_STR;
            }
        }
        $this->statement->bindValue($parameter, $value, $varType);
    }

    /**
     * rowCount method
     *
     * Count total rows in the table.
     *
     * @return integer
     */
    public function rowCount() {
        $this->execute(); return $this->statement->rowCount();
    }

    /**
     *  fetchRow method
     *
     * Get data from a single row in the database.
     *
     * @return mixed|false
     */
    public function fetchRow() {
        $this->execute(); return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    /**
     *  fetchAllRows method
     *
     * Get data from all rows in the database.
     *
     * @return mixed|false
     */
    public function fetchAllRows() {
        $this->execute(); return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }
}