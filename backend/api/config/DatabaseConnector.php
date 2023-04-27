<?php
header('Access-Control-Allow-Origin: *'); // Allows access from any origin
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS'); // Allows the specified HTTP methods
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Allows the specified headers to be sent in the request

// DatabaseConnector class
class DatabaseConnector
{
    private $servername = 'sql8.freemysqlhosting.net';
    private $username = 'sql8614588';   
    private $password = 'kZbHPGEFqL';
    private $dbname = 'sql8614588';
    private $conn;
    // Constructor
    public function __construct()
    {
        // Connects to the database using the MySQLi
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Checks if the connection was successful, else it displays an error message
        if ($this->conn->connect_error) {
            throw new Exception('Failed to connect to database: ' . $this->conn->connect_error);
        }
    }
    // Returns the connection object
    public function getConnection()
    {
        return $this->conn;
    }
}
// Include on pages
// require_once "../DatabaseConnector.php";
// $conn = new DatabaseConnector();
// $conn = $conn->getConnection();