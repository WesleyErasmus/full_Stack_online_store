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
        // Insert new customer input data into the database table
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

        // Getting customer login details from the sql database
        $stmt = $conn->prepare("SELECT password FROM customers WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $hashed_password = $result->fetch_assoc()['password'];
        // Verifying password against the database
        if (password_verify($password, $hashed_password)) {
            $stmt = $conn->prepare("SELECT * FROM customers WHERE email = ? AND password = ?");
            $stmt->bind_param("ss", $email, $hashed_password);
            $stmt->execute();
            $result = $stmt->get_result();
            $customer = $result->fetch_assoc();
            if (!empty($customer)) {
                $_SESSION["customer"] = $customer;
                $_SESSION['logged_in'] = true;

                // Setting customer id cookie to use between app pages
                setcookie('customer_id', $customer['id'], time() + (86400 * 30), '/');

                return true;
                exit;
            }
        }
        return false;
    }

    // Display customer data
    public function displayCustomerData($customer_id)
    {
        require_once '../config/DatabaseConnector.php';
        $conn = new DatabaseConnector();
        $conn = $conn->getConnection();

        $id = '';
        $full_name = '';
        $email = '';
        $password = '';

        // Select query for customer data. Looking for customer details where the customer id matches in the database
        $profile_data = "SELECT id, fullname, email, password FROM customers WHERE id = '$customer_id'";
        $result = $conn->query($profile_data);

        // Looping through customer database table and setting data variables
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $full_name = $row['fullname'];
                $email = $row['email'];
                $password = $row['password'];
            }
            // Creating customer associative array
            $customer = array(
                'customer_id' => $id,
                'full_name' => $full_name,
                'email' => $email,
                'password' => $password,
            );

            // Returning JSON format data
            return json_encode($customer);
        } else {
            return false;
        }
    }
}
