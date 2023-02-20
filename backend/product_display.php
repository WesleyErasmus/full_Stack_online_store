<?php
header('Access-Control-Allow-Origin: *'); // Allows access from any origin
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS'); // Allows the specified HTTP methods
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Allows the specified headers to be sent in the request

function selectAll()
{
    require_once './DatabaseConnector.php';
    $conn = new DatabaseConnector();
    $conn = $conn->getConnection();

    $query = "SELECT * FROM products";
    $result = $conn->query($query);
    if ($result === false) {
        throw new Exception("Failed to execute query: " . $conn->error);
    }
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

// Check if the action parameter is set and call the corresponding function
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'selectAll':
            if (isset($_GET['tableName'])) {
                $data = selectAll();
                echo json_encode($data);
            } else {
                echo "Missing tableName parameter";
            }
            break;
        default:
            echo "Invalid action";
    }
}
