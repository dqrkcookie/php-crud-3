<?php
session_start();
include 'db_connect.php';
include("./nav.php");

if(empty($_SESSION['email'])){
    header("Location: ../index.php");
  }

$user = $_SESSION['email'];
$query = $pdo->query("SELECT * FROM products")->fetchAll();

function displayProducts($products, $user) {
    foreach ($products as $product) { ?>
        <div class="item-card">
            <div class="item-image"><img src="../photos/<?php echo $product->image; ?>" alt="Product image"></div>
            <div class="item-name"><?php echo $product->name; ?></div>
            <div class="item-price"><?php echo $product->price; ?></div>
            <div class="card-actions">
                <form action="./addtocart.php" method="POST">
                    <input type="hidden" name="name" value="<?php echo $product->name ?>">
                    <input type="hidden" name="price" value="<?php echo $product->price ?>">
                    <input type="hidden" name="user" value="<?php echo $user ?>">
                    <button class="btn btn-delete" type="button" id="dec"><i class="fa-solid fa-less-than" style="color: #444;"></i></button>
                    <input type="number" min="1" value="1" id="qty" name="qty">
                    <button class="btn btn-delete" type="button" id="inc"><i class="fa-solid fa-greater-than" style="color: #444;"></i></button>
                    <button class="btn btn-edit" type="submit" name="add">+<i class="fa-solid fa-mug-hot fa-lg" style="color: #444;"></i></button>
                </form>
            </div>
        </div>
    <?php }
}

?>

<link rel="stylesheet" href="./css/prod_browsing.css">

<div class="container">
    <div class="filter-sort-section">
        <div class="filter-group">
            <form action="./product_browsing.php" method="GET">
                <label for="category">Category:</label>
                <select id="category" name="category">
                    <option value="">All Categories</option>
                    <?php 
                    $categories = [];
                    foreach ($query as $q) {
                        if (!in_array($q->category_id, $categories)) {
                            array_push($categories, $q->category_id);
                        }
                    }
                    foreach ($categories as $d) { ?>
                        <option value="<?php echo $d ?>"><?php echo $d ?></option>
                    <?php } ?>
                </select>
                <input type="submit" value="✔" name="submit-category">
            </form>
        </div>

        <div id="avail">
            <h1>Available Products</h1>
        </div>

        <div class="sort-group">
            <form action="./product_browsing.php" method="GET">
                <label for="sort">Sort by:</label>
                <select id="sort" name="sort">
                    <option value="a-z">Name: A-Z</option>
                    <option value="z-a">Name: Z-A</option>
                    <option value="price-low">Price: Low to High</option>
                    <option value="price-high">Price: High to Low</option>
                </select>
                <input type="submit" value="✔" name="submit-sort">
            </form>
        </div>

    <section class="cards-container">
        <?php
        if (isset($_GET['look']) && $_GET['look'] == 'search' && isset($_GET['search']) && $_GET['search'] !== '') {
            $search = '%' . $_GET['search'] . '%';
            $searched_products = $pdo->query("SELECT * FROM products WHERE name LIKE '$search'")->fetchAll();
            displayProducts($searched_products, $user);
        } elseif (isset($_GET['submit-category']) && $_GET['category'] !== '') {
            $category_filter = '%' . $_GET['category'] . '%';
            $filtered_products = $pdo->query("SELECT * FROM products WHERE category_id LIKE '$category_filter'")->fetchAll();
            displayProducts($filtered_products, $user);
        } elseif (isset($_GET['submit-sort'])) {
            $sort_query = '';
            switch ($_GET['sort']) {
                case 'a-z':
                    $sort_query = "ORDER BY name ASC";
                    break;
                case 'z-a':
                    $sort_query = "ORDER BY name DESC";
                    break;
                case 'price-low':
                    $sort_query = "ORDER BY price ASC";
                    break;
                case 'price-high':
                    $sort_query = "ORDER BY price DESC";
                    break;
            }

            if ($sort_query) {
                $sorted_products = $pdo->query("SELECT * FROM products $sort_query")->fetchAll();
                displayProducts($sorted_products, $user);
            }
        } else {
            $all_products = $pdo->query("SELECT * FROM products ORDER BY id")->fetchAll();
            displayProducts($all_products, $user);
        }
        ?>
    </section>
</div>

<script>
    const qty = document.querySelectorAll('#qty');
    const inc = document.querySelectorAll('#inc');
    const dec = document.querySelectorAll('#dec');

    inc.forEach((button, index) => {
        button.onclick = () => {
            qty[index].value++;
        }
    });

    dec.forEach((button, index) => {
        button.onclick = () => {
            qty[index].value--;
            if (qty[index].value == 0) {
                qty[index].value = 1;
            }
        }
    });
</script>
