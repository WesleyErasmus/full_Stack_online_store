<?php
include '../models/Customer.php';

// Display customer details in profile page
if (isset($_GET['customerId'])) {
    // file_get_contents() is used to read the contents of v-model input fields in the SignIn.vue page. "php://input" is a predefined parameter that reads the REQUESTED input data. json_decode, true parameter was needed because it was not returning the data as an associative array.
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    switch ($_GET['action']) {
            // CUSTOMER SIGNUP
        case 'customerSignUp':
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

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Update the customer profile with the hashed password
    $update_customer_profile = "UPDATE customers SET fullname = '$full_name', email = '$email', password = '$hashed_password' WHERE id = '$customer_id'";

    if ($conn->query($update_customer_profile) === TRUE) {
        return true;
    } else {
        return false;
    }
}
// Save customer message from contact page
if (isset($_GET['action']) && $_GET['action'] === 'saveMessage' && isset($_GET['customerId'])) {
    $data = json_decode(file_get_contents("php://input"), true);

    require_once "../config/DatabaseConnector.php";
    $db = new DatabaseConnector();
    $conn = $db->getConnection();

    $customer_id = $_GET['customerId'];
    $customer_id = intval($customer_id);

    $customer_query = "SELECT id, fullname, email FROM customers WHERE id = ?";
    $customer_stmt = $conn->prepare($customer_query);
    $customer_stmt->bind_param("i", $customer_id);
    $customer_stmt->execute();
    $customer_result = $customer_stmt->get_result();
    $customer_data = $customer_result->fetch_assoc();

    $full_name = $customer_data['fullname'];
    $email = $customer_data['email'];
    $message = $data["message"];
    $full_name = htmlentities($full_name);

    $full_name = htmlentities($full_name);
    $message = htmlentities($message);
    $email = filter_var($customer_data['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlentities($message);
    $customer = new Customer($customer_id, $full_name, $email, $message);

    if (!empty($message)) {
    $stmt = $conn->prepare("INSERT INTO messages (customerid, fullname, email, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $customer_id, $full_name, $email, $message);
    $result = $stmt->execute();
    $stmt->close();

    if ($result) {
        echo "Message saved successfully";
    } else {
        echo "Error saving message";
    }
    }
}


