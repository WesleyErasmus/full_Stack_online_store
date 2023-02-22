<?php
header('Access-Control-Allow-Origin: *'); // Allows access from any origin
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS'); // Allows the specified HTTP methods
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Allows the specified headers to be sent in the request

function selectAll()
{
    require_once '../config/DatabaseConnector.php';
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

// $_GET checks if the action parameter is set. The action is included in my front-end api call. The value of the action is set to the selectAll function. If the isset($_GET['action']) is set, the switch statement will then check if a tableName parameter is set. The tableName parameter is set by assigning it a value of myTable in the font-end api call (api.get("/product_display.php?action=selectAll&tableName=myTable"). If the tableName parameter is set then the selectAll() function retrieves the data from the database and returns it as JSON data. 
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
