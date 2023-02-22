<?php
header('Access-Control-Allow-Origin: *'); // Allows access from any origin
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS'); // Allows the specified HTTP methods
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Allows the specified headers to be sent in the request
// Customer class
class Customer
{
    protected $id;
    protected $full_name;
    protected $email;
    protected $password;

    public function __construct($id, $full_name, $email, $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->full_name = $full_name;
        $this->password = $password;
    }
    // Customer Sign up function
    public function signup($full_name, $email, $password)
    {
        require_once "../config/DatabaseConnector.php";
        $conn = new DatabaseConnector();
        $conn = $conn->getConnection();
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO customers (fullname, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $full_name, $email, $hashed_password);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

}
