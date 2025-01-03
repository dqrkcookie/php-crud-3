<?php
session_start();
include ('db_connect.php');

if(empty($_SESSION['email'])){
    header("Location: ../index.php");
  }

$user = $_SESSION['email'];

$items = $pdo->query("SELECT * FROM cart WHERE user = '$user'")->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cofi</title>
    <link rel="stylesheet" href="./css/cart.css">
    <script src="https://kit.fontawesome.com/b70669fb91.js" crossorigin="anonymous"></script>
</head>
<body>
    
</body>
</html>

<div id="browse">
    <a href="./product_browsing.php">⬅ Browse Products</a>
</div>
<div class="cart">
    <h1>Cart</h1>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0 ?>
            <?php $qty = [] ?>
            <?php $all_products = [] ?>
            <?php $products = [] ?>
            <?php foreach($items as $item) { ?>
            <?php $total+=($item->price*$item->qty) ?>
            <?php array_push($qty, $item->qty) ?>
            <?php array_push($all_products, $item->product_name.' '.$item->qty.'pcs') ?>
            <?php array_push($products, $item->product_name) ?>
            <tr>
                <td><?php echo $item->product_name ?></td>
                <td><?php echo $item->price ?></td>
                <td><?php echo $item->qty ?></td>
                <td><a href="./delete.php?delete=yes&name=<?php echo $item->product_name ?>"><i class="fa-solid fa-trash fa-lg" style="color: #444;"></i></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="cart-footer">
        <span class="total">Total: <span id="t"><?php echo $total ?></span></span>
        <form action="./place_order.php" method="POST">
            <input type="hidden" name="user" value="<?php echo $user ?>">
            <input type="hidden" name="prod" value="<?php echo urlencode(json_encode($products)) ?>">
            <input type="hidden" name="qty" value="<?php echo urlencode(json_encode($qty)) ?>">
            <input type="hidden" name="product" value="<?php echo urlencode(json_encode($all_products)) ?>">
            <input type="hidden" name="total" value="<?php echo $total ?>">
            <span>Cash on Delivery</span>
            <textarea name="address" placeholder="Enter your address" required></textarea>
            <button class="place-order" name="place">Place Order</button>
        </form>
    </div>
</div>
