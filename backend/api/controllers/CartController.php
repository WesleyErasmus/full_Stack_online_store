<?php
include '../models/Cart.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!empty($data["fullName"]) && !empty($data["email"]) && !empty($data["password"])) {
        $id = "";
        $full_name = $data["fullName"];
        $full_name = htmlentities($full_name);
        $email = $data['email'];
        $sanitized_email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $password = $data['password'];
        $customer = new Customer($id, $full_name, $email, $password);
        $result = $customer->addToCart($cart_item_id, $customer_id, $product_id, $price);

        if ($result) {
            echo "Added to Cart successfully";
        } else {
            echo "Error adding to Cart";
        }
    }
}
