<?php
include '../models/Customer.php';

// CUSTOMER SIGNUP
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // file_get_contents() is used to read the contents of v-model input fields in the SignIn.vue page. "php://input" is a predefined parameter that reads the REQUESTED input data. json_decode, true parameter was needed because it was not returning the data as an associative array.
    $data = json_decode(file_get_contents("php://input"), true);
    if (!empty($data["fullName"]) && !empty($data["email"]) && !empty($data["password"])) {
        $id = "";
        $full_name = $data["fullName"];
        $full_name = htmlentities($full_name);
        $email = $data['email'];
        $sanitized_email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $password = $data['password'];
        $customer = new Customer($id, $full_name, $email, $password);
        $result = $customer->customerSignup($full_name, $email, $password);

        if ($result) {
            echo "Customer signed up successfully";
        } else {
            echo "Error signing up customer";
        }
    }
}


// CUSTOMER LOGIN 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    // Instantiating customer object
    $customer = new Customer("", "", $data["email"], $data["password"]);
    // Check if email and password inputs are not empty
    if (!empty($data["email"]) && !empty($data["password"])) {
        $email = htmlentities($data["email"]);
        $password = $data["password"];
        $result = $customer->customerLogin($email, $password);
        if ($result) {
            $response = array("success" => true, "customer_id" => $_SESSION['customer']['id']);
            setcookie('customer_id', $_SESSION['customer']['id'], time() + (86400 * 30), '/');
        } else {
            $response = array("success" => false);
        }
        echo json_encode($response);
    }
}


// CUSTOMER PROFILE DATA DISPLAY
if (isset($_GET['action']) && $_GET['action'] === 'getProfile' && isset($_GET['customerId'])) {

    require_once '../config/DatabaseConnector.php';
    $conn = new DatabaseConnector();
    $conn = $conn->getConnection();

    $customer_id = $_GET['customerId'];

    $profile_data = "SELECT id, fullname, email, password FROM customers WHERE id = '$customer_id'";
    $result = $conn->query($profile_data);

    if ($result) {
        $customer_profile = array();
        while ($row = $result->fetch_assoc()) {

            $item = array(
                'customer_id' => $row['id'],
                'full_name' => $row['fullname'],
                'email' => $row['email'],
                'password' => $row['password'],
            );
            array_push($customer_profile, $item);
        }
        echo json_encode($customer_profile);
    }
}
