<?php
header('Access-Control-Allow-Origin: *'); // Allows access from any origin
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS'); // Allows the specified HTTP methods
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Allows the specified headers to be sent in the request

include '../models/Cart.php';

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'addToCart':
            // uniqid() keps generating the same unique code so switched to alternative
            $cart_item_id = bin2hex(openssl_random_pseudo_bytes(16));
            $customer_id = $_GET['customerId'];
            $product_id = $_GET['id'];
            $request_body = json_decode(file_get_contents('php://input'), true);
            $price = $request_body['price'];
            if (isset($_GET['tableName']) && isset($_GET['id']) && isset($_GET['customerId'])) {
                $cart_item = new Cart($cart_item_id, $customer_id, $product_id, $price);
                $result = $cart_item->addToCart(
                    $cart_item_id,
                    $customer_id,
                    $product_id,
                    $price
                );
                echo json_encode($result);
            } else {
                echo "Missing tableName or id parameter";
            }
            break;
        default:
            echo "Invalid action";
    }
}
