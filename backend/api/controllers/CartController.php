<?php
header('Access-Control-Allow-Origin: *'); // Allows access from any origin
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS'); // Allows the specified HTTP methods
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Allows the specified headers to be sent in the request

include '../models/Cart.php';

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        // Add to cart
        case 'addToCart':
            $customer_id = $_GET['customerId'];
            // uniqid() keeps generating the same unique code so switched to alternative
            $cart_item_id = bin2hex(openssl_random_pseudo_bytes(16));
            $product_id = $_GET['id'];
            // Returns assoc array
            $request_body = json_decode(file_get_contents('php://input'), true);
            $price = $request_body['price'];
            // Checks for params and if values are set
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
               // Display cart items
        case 'displayCartItems':
            $customer_id = $_GET['customerId'];
             // Invoking displayCartItems function and then displaying the result in JSON format
            $cart_items = Cart::displayCartItems($customer_id);
            echo json_encode($cart_items);
            break;
            // remove from cart
        case 'removeFromCart':
            $cart_item_id = $_GET['cartItemId'];
            $result = Cart::removeFromCart($cart_item_id);
            echo json_encode($result);
            break;

        default:
        // Throws error if API params are incorrect
            echo "Invalid action";
    }
}
