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
    public function customerSignup($full_name, $email, $password)
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

    // Customer login function
    public function customerLogin($email, $password)
    {
        require_once "../config/DatabaseConnector.php";
        $conn = new DatabaseConnector();
        $conn = $conn->getConnection();
        $stmt = $conn->prepare("SELECT password FROM customers WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $hashed_password = $result->fetch_assoc()['password'];
        if (password_verify($password, $hashed_password)) {
            $stmt = $conn->prepare("SELECT * FROM customers WHERE email = ? AND password = ?");
            $stmt->bind_param("ss", $email, $hashed_password);
            $stmt->execute();
            $result = $stmt->get_result();
            $customer = $result->fetch_assoc();
            if (!empty($customer)) {
                $_SESSION["customer"] = $customer;
                $_SESSION['logged_in'] = true;

                setcookie('customer_id', $customer['id'], time() + (86400 * 30), '/');

                return true;
                exit;
            }
        }
        return false;
    }
}
