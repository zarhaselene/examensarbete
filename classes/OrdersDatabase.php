<?php

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/ProductsDatabase.php ";
require_once __DIR__ . "/Product.php ";
require_once __DIR__ . "/Order.php";
require_once __DIR__ . "/OrdersDatabase.php ";

require_once __DIR__ . "/ProductOrder.php";


class OrdersDatabase extends Database
{
    // Create
    public function create(Order $order)
    {
        $query = "INSERT INTO orders (`user-id`, `status`, `order-date`) VALUES (?,?,?)";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("iss", $order->user_id, $order->status, $order->order_date);

        $products = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        $success = $stmt->execute();

        if (!$success) {
            var_dump($stmt->error);
            die("Error creating order");
        }

        //insert orderID and productID into productsorders table and foreach product in cart
        $orderID = $this->conn->insert_id;
        foreach ($products as $product) {
            $query = "INSERT INTO productsorders (`order-id`, `product-id`) VALUES (?,?)";
            $stmt = mysqli_prepare($this->conn, $query);
            $stmt->bind_param("ii", $orderID, $product->id);
            $success = $stmt->execute();
            if (!$success) {
                var_dump($stmt->error);
                die("Error creating productsorders entry");
            }
        }
        return $success;
    }

    // Get all
    public function get_all_orders()
    {
        $query = "SELECT * FROM orders";

        $result = mysqli_query($this->conn, $query);
        $db_orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $orders = [];

        foreach ($db_orders as $db_order) {

            $db_id = $db_order["id"];
            $db_customerID = $db_order["user-id"];
            $db_status = $db_order["status"];
            $db_date = $db_order["order-date"];

            $orders[] = new Order($db_customerID, $db_status, $db_date, $db_id);
        }

        return $orders;
    }


    // Get by user id 
    public function get_order_by_user_id($user_id)
    {
        $query = "SELECT * FROM orders WHERE `user-id` = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $user_id);
        $success = $stmt->execute();
        if (!$success) {
            var_dump($stmt->error);
            die("Error getting user orders");
        }
        $result = $stmt->get_result();
        $db_orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $orders = [];
        foreach ($db_orders as $db_order) {
            $user_id = $db_order["user-id"];
            $status = $db_order["status"];
            $order_date = $db_order["order-date"];
            $id = $db_order["id"];

            $orders[] = new Order($user_id, $status, $order_date, $id);
        }
        return $orders;
    }

    // Get order by id
    public function get_order_by_id($id)
    {
        $query = "SELECT * FROM orders WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $result = $stmt->get_result();

        $db_order = mysqli_fetch_assoc($result);

        $order = null;

        if ($db_order) {
            $db_id = $db_order["id"];
            $db_user_id = $db_order["user-id"];
            $db_status = $db_order["status"];
            $db_order_date = $db_order["order-date"];

            $order = new Order($db_user_id, $db_status, $db_order_date, $db_id);
        }

        return $order;
    }

    //Update order
    public function update_order($status, $id)
    {
        $query = "UPDATE orders SET `status` = ? WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("si", $status, $id);

        return $stmt->execute();
    }

    public function get_products_by_order($orderID)
    {
        $query = "SELECT products.id, products.title, products.description, products.price, products.`img-url` 
                    FROM products INNER JOIN productsorders 
                    ON products.id = productsorders.`product-id` 
                    WHERE productsorders.`order-id` = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $orderID);
        $success = $stmt->execute();
        if (!$success) {
            var_dump($stmt->error);
            die("Error getting products by order");
        }
        $result = $stmt->get_result();
        $db_products = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $products = [];
        foreach ($db_products as $db_product) {
            $db_id = $db_product["id"];
            $db_title = $db_product["title"];
            $db_description = $db_product["description"];
            $db_price = $db_product["price"];
            $db_image = $db_product["img-url"];
            $products[] = new Product($db_title, $db_description, $db_price, $db_image, $db_id);
        }
        return $products;
    }
}
