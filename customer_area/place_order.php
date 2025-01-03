<?php

session_start();
include("./db_connect.php");

if(empty($_SESSION['email'])){
    header("Location: ../index.php");
  }

if (isset($_POST['place'])) {
    $user = $_POST['user'];
    $product = urldecode($_POST['product']);
    $total = $_POST['total'];
    $address = $_POST['address'];
    $prod = json_decode(urldecode($_POST['prod'])); 
    $qty = json_decode(urldecode($_POST['qty']));

    foreach ($prod as $index => $product_name) {
        $get_products = $pdo->prepare("SELECT * FROM products WHERE name = ?");
        $get_products->execute([$product_name]);
        $product_info = $get_products->fetch(); 

        if ($product_info) {
            $new_qty = $product_info->stock - $qty[$index];
            $update_stock = $pdo->prepare("UPDATE products SET stock = ? WHERE name = ?");
            $update_stock->execute([$new_qty, $product_name]);
        }
    }

    $query = "INSERT INTO placed_orders(user, product_name, price, address) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $params = [$user, $product, $total, $address];
    $stmt->execute($params);

    $query1 = "INSERT INTO order_management(user, product_name, price, address) VALUES (?, ?, ?, ?)";
    $stmt1 = $pdo->prepare($query1);
    $params1 = [$user, $product, $total, $address];
    $stmt1->execute($params1);

    $delete = $pdo->prepare("DELETE FROM cart WHERE user = ?");
    $delete->execute([$user]);
}

header("Location: ./cart.php?place=success");

?>
