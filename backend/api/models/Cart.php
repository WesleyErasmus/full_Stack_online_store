<?php
header('Access-Control-Allow-Origin: *'); // Allows access from any origin
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS'); // Allows the specified HTTP methods
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Allows the specified headers to be sent in the request
// Customer class
class Cart
{
    protected $cart_item_id;
    protected $customer_id;
    protected $product_id;
    protected $price;

    public function __construct($cart_item_id, $customer_id, $product_id, $price)
    {
        $this->cart_item_id = $cart_item_id;
        $this->customer_id = $customer_id;
        $this->product_id = $product_id;
        $this->price = $price;
    }
    // Customer Sign up function
    public function addToCart($cart_item_id, $customer_id, $product_id, $price)
    {

        $cart_item_id = uniqid();
        $customer_id = '';
        $product_id = '';
        $price = '';

        require_once "../config/DatabaseConnector.php";
        $conn = new DatabaseConnector();
        $conn = $conn->getConnection();

        $stmt = $conn->prepare("INSERT INTO cart (cartitemid, customerid, productid, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiii",$cart_item_id, $customer_id, $product_id, $price);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
