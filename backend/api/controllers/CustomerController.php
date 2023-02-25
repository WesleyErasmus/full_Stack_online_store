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


// DISPLAY CUSTOMER PROFILE DATA
if (isset($_GET['action']) && $_GET['action'] === 'getProfile' && isset($_GET['customerId'])) {
    $customer_id = $_GET['customerId'];
    require_once '../models/Customer.php';
    $customer = new Customer($customer_id, '', '', '');
    $profile_data = $customer->displayCustomerData($customer_id);
    if ($profile_data) {
        echo $profile_data;
    } else {
        echo "Failed to retrieve customer profile data";
    }
}


// UPDATE CUSTOMER PROFILE
if (isset($_POST['action']) && $_POST['action'] === 'updateProfile' && isset($_POST['customerId'])) {

    $customer = new Customer($id, $full_name, $email, $password);

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $update_customer_profile = $customer->updateCustomerProfile($customer_id, $full_name, $email, $password);

    if ($update_customer_profile) {
        $response = array('status' => 'success');
    } else {
        $response = array('status' => 'error');
    }

    echo json_encode($response);
}