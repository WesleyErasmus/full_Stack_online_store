<?php
include '../models/Customer.php';

// Save customer message from contact page
if (
    isset($_GET['action']) && $_GET['action'] === 'saveMessage'
) {
    $data = json_decode(file_get_contents("php://input"), true);

    require_once "../config/DatabaseConnector.php";
    $db = new DatabaseConnector();
    $conn = $db->getConnection();

    $full_name = $data['fullName'];
    $email = $data['email'];
    $message = $data['message'];

    $full_name = htmlentities($full_name);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $message = htmlentities($data['message']);

    if (
        !empty($full_name) && !empty($email) && !empty($message)
    ) {
        $stmt = $conn->prepare("INSERT INTO messages (fullname, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $full_name, $email, $message);
        $result = $stmt->execute();
        $stmt->close();

        if ($result) {
            echo "Message saved successfully";
        } else {
            echo "Error saving message";
        }
    }
}

?>