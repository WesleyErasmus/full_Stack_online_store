<?php
header('Access-Control-Allow-Origin: *'); // Allows access from any origin
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS'); // Allows the specified HTTP methods
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Allows the specified headers to be sent in the request
// Cart class
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
    // Cart Sign up function
    public function addToCart($cart_item_id, $customer_id, $product_id, $price)
    {
        require_once "../config/DatabaseConnector.php";
        $conn = new DatabaseConnector();
        $conn = $conn->getConnection();
        // Insert new customer data into the table
        $stmt = $conn->prepare("INSERT INTO cart (cartitemid, customerid, productid, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siii", $cart_item_id, $customer_id, $product_id, $price);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Display customer cart items
    public static function displayCartItems($customer_id)
    {
        require_once '../config/DatabaseConnector.php';
        $conn = new DatabaseConnector();
        $conn = $conn->getConnection();

        // Join the cart and products table using productid to get all cart items for the specific customer
        $query = "SELECT cart.cartitemid, cart.customerid, cart.productid, cart.price, products.title, products.image, products.description, products.category, products.img_gallery_1, products.img_gallery_2, products.img_gallery_3, products.new, products.trending FROM cart INNER JOIN products ON cart.productid = products.id WHERE cart.customerid = $customer_id";
        $result = $conn->query($query);

        if ($result) {
            $cart_items = array();


            // Using while loop to loop through the new cart_item object table to display on frontend
            while ($row = $result->fetch_assoc()) {
                $cart_item = array(
                    'cart_item_id' => $row['cartitemid'],
                    'customer_id' => $row['customerid'],
                    'product_id' => $row['productid'],
                    'price' => $row['price'],
                    'title' => $row['title'],
                    'image' => $row['image'],
                    'description' => $row['description'],
                    'category' => $row['category'],
                    'img_gallery_1' => $row['img_gallery_1'],
                    'img_gallery_2' => $row['img_gallery_2'],
                    'img_gallery_3' => $row['img_gallery_3'],
                    'new' => $row['new'],
                    'trending' => $row['trending']
                );
                // Pushing each cart item into the cart items object array
                array_push($cart_items, $cart_item);
            }

            // Return to display on frontend
            return $cart_items;
        } else {
            throw new Exception("Failed to execute query: " . $conn->error);
        }
    }

    // Remove from cart function
    public static function removeFromCart($cart_item_id)
    {
        require_once '../config/DatabaseConnector.php';
        $conn = new DatabaseConnector();
        $conn = $conn->getConnection();

        // Delete table query
        $stmt = $conn->prepare("DELETE FROM cart WHERE cartitemid = ?");
        $stmt->bind_param("s", $cart_item_id);

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Failed to remove item from cart: " . $conn->error);
        }
    }
}
