<?php
include '../models/Customer.php';

// Save customer message from contact page
if (
    isset($_GET['action']) && $_GET['action'] === 'saveMessage'
) {
    $data = json_decode(file_get_contents("php://input"), true);
    // Database connector
    require_once "../config/DatabaseConnector.php";
    $db = new DatabaseConnector();
    $conn = $db->getConnection();
    // Declaring variables
    $full_name = $data['fullName'];
    $email = $data['email'];
    $message = $data['message'];
    // SQL sanitizing of user input data
    $full_name = htmlentities($full_name);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $message = htmlentities($data['message']);

    // Conditional to check that all fields have been filled in
    if (
        !empty($full_name) && !empty($email) && !empty($message)
    ) {
        $stmt = $conn->prepare("INSERT INTO messages (fullname, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $full_name, $email, $message);
        $result = $stmt->execute();
        $stmt->close();

        // Returns associative array with success status of true or false
        if ($result) {
            echo json_encode(array("success" => true));
        } else {
            echo json_encode(array("success" => false));
        }
    }
}

?>