<?php
include '../models/Customer.php';

// Display customer details in profile page
if (isset($_GET['customerId'])) {
    // file_get_contents() is used to read the contents of v-model input fields in the SignIn.vue page. "php://input" is a predefined parameter that reads the REQUESTED input data. json_decode, true parameter was needed because it was not returning the data as an associative array.
    $customer_id = $_GET['customerId'];
    require_once '../models/Customer.php';
    // Set form variables to blank values
    $customer = new Customer($customer_id, '', '', '');
    $profile_data = $customer->displayCustomerData($customer_id);
    if ($profile_data) {
        echo $profile_data;
    } else {
        echo "Failed to retrieve customer profile data";
    }
}

// CUSTOMER SIGN-UP / LOGIN
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Checks for params and if values are set
    $data = json_decode(file_get_contents("php://input"), true);

    switch ($_GET['action']) {
            // CUSTOMER SIGNUP
        case 'customerSignUp':
            if (!empty($data["fullName"]) && !empty($data["email"]) && !empty($data["password"])) {
                // Declaring variables & sanitizing them
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
            break;
            // CUSTOMER LOGIN
        case 'customerLogin':
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
            break;
            // UPDATE CUSTOMER ACCOUNT DETAILS SERVER POST REQUEST
        case 'updateCustomerProfile':
            $customer_id = $_GET['customerId'];
            $full_name = $data['full_name'];
            $email = $data['email'];
            $password = $data['password'];
            // Invokes update profile function
            $result = updateCustomerProfile($customer_id, $full_name, $email, $password);

            if ($result) {
                $response = array('status' => 'success', 'customer_id' => $customer_id);
            } else {
                $response = array('status' => 'error');
            }

            echo json_encode($response);
            exit();

            break;

        default:
            echo "Invalid action";
    }
}

// UPDATE CUSTOMER ACCOUNT DETAILS FUNCTION
function updateCustomerProfile($customer_id, $full_name, $email, $password)
{
    require_once '../config/DatabaseConnector.php';
    $conn = new DatabaseConnector();
    $conn = $conn->getConnection();

    // Hash the password if it is not empty
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $update_customer_profile = "UPDATE customers SET fullname = '$full_name', email = '$email', password = '$hashed_password' WHERE id = '$customer_id'";
    } else {
        $update_customer_profile = "UPDATE customers SET fullname = '$full_name', email = '$email' WHERE id = '$customer_id'";
    }

    if ($conn->query($update_customer_profile) === TRUE) {
        return true;
    } else {
        return false;
    }
}