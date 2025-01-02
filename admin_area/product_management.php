<?php

session_start();
include("./db_connect.php");

if(empty($_SESSION['admin_email'])){
    header("Location: ./login.php");
}

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $stocks = $_POST['stocks'];
    $categ = $_POST['categ'];

    $newFileName = '';

    $file = $_FILES["image"];
    $fileName = $file["name"];
    $fileTmpName = $file["tmp_name"];
    $fileSize = $file["size"];
    $fileError = $file["error"];

    if ($fileError === 0) {
        $accepted_type = array('jpg', 'jpeg', 'gif', 'png', 'jfif');
        $getExtension = explode('.', $fileName);
        $extension = strtolower(end($getExtension));

        if (in_array($extension, $accepted_type)) {
            if ($fileSize < 5000000) {
                $newFileName = uniqid('img_', true) . "." . $extension;
                $fileDestination = '../photos/' . $newFileName;
                move_uploaded_file($fileTmpName, $fileDestination);
            } 
        } 
    }

    $query = "INSERT INTO products(name,description,price,stock,category_id,image)VALUES(?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($query);
    $params = [$name, $desc, $price, $stocks, $categ, $newFileName];
    
    if($stmt->execute($params)){
        echo "<script>echo('Product Added!');</script>";
    }
}

if(isset($_POST['edit'])){
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $stocks = $_POST['stock'];
    $categ = $_POST['category'];
    $id = $_POST['id'];

    $newFileName = '';

    $file = $_FILES["picture"];
    $fileName = $file["name"];
    $fileTmpName = $file["tmp_name"];
    $fileSize = $file["size"];
    $fileError = $file["error"];

    if ($fileError === 0) {
        $accepted_type = array('jpg', 'jpeg', 'gif', 'png', 'jfif');
        $getExtension = explode('.', $fileName);
        $extension = strtolower(end($getExtension));

        if (in_array($extension, $accepted_type)) {
            if ($fileSize < 5000000) {
                $newFileName = uniqid('img_', true) . "." . $extension;
                $fileDestination = '../photos/' . $newFileName;
                move_uploaded_file($fileTmpName, $fileDestination);
            } 
        } 
    }

    $query = "UPDATE products SET name = ?, description = ?, price = ?, stock = ?, category_id = ?, image = ? WHERE id = ?";

    $stmt = $pdo->prepare($query);
    $params = [$name, $desc, $price, $stocks, $categ, $newFileName, $id];
    
    if($stmt->execute($params)){
        echo "<script>echo('Product Added!');</script>";
    }
}

if(isset($_GET['delete'])){
    $name = $_GET['name'];

    $query = "DELETE FROM products WHERE name = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$name]);
}

$products = $pdo->query("SELECT * FROM products ORDER BY id");
$lists = $products->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./css/product.css">
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
    <header>
      <h1>Admin Dashboard</h1>
    </header>
    <nav>
      <ul>
        <li><a href="dashboard.php">Overview</a></li>
        <li><a href="product_management.php">Product Management</a></li>
        <li><a href="order_management.php">Order Management</a></li>
        <li><a href="history.php">Transaction History</a></li>
        <li><a href="user_management.php">User Management</a></li>
        <li>
          <a href="logout.php">Logout</a>
        </li>
      </ul>
    </nav>

    <section>
    <form action="./product_management.php" method="POST" enctype="multipart/form-data">
        <input type="text" placeholder="Product Name" name="name"  required>
        <input type="text" placeholder="Description" name="desc"  required>
        <input type="number" placeholder="Price" name="price"  required>
        <input type="number" placeholder="Stock" name="stocks"  required>
        <input type="text" placeholder="Category" name="categ"  required>   
        <input type="file" accept="image/*" name="image" required>
        <input type="submit" name="submit" value="Add Product">
    </form>

    <div class="products">
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stocks</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($lists as $list) { ?>
                <tr>
                    <td><?php echo $list->name ?></td>
                    <td><?php echo $list->description ?></td>
                    <td><?php echo $list->price ?></td>
                    <td><?php echo $list->stock ?> <?php if($list->stock < 20) { ?> 
                        <span id="notice"> Few stocks remaining <?php echo '⚠' ?></span>
                    <?php } ?>
                    </td>
                    <td><?php echo $list->category_id ?></td>
                    <td>
                        <div class="view">
                            <div class="view-container">
                                <div id="b-v">X</div>
                                <label>Name:</label>
                                <span><?php echo $list->name ?></span>
                                <label>Description</label>
                                <span><?php echo $list->description ?></span>
                                <label>Price</label>
                                <span><?php echo $list->price ?></span>
                                <label>Stocks</label>
                                <span><?php echo $list->stock ?></span>
                                <label>Category</label>
                                <span><?php echo $list->category_id ?></span>
                            </div>
                        </div>
                        <button id="view">View</button>

                        <div class="edit">
                            <div id="b-e">X</div>
                            <form action="./product_management.php" method="POST" enctype="multipart/form-data">
                                <label>Name:</label>
                                <input type="text" placeholder="Product Name" value="<?php echo $list->name ?>" name="name">
                                <label>Description</label>
                                <textarea name="desc" placeholder="Product Description"><?php echo $list->description ?>
                                </textarea>
                                <label>Price</label>
                                <input type="number" name="price" placeholder="Product Price" value="<?php echo $list->price ?>">
                                <label>Stocks</label>
                                <input type="number" name="stock" placeholder="Product Stocks" value="<?php echo $list->stock ?>">
                                <label>Category</label>
                                <input type="text" name="category" placeholder="Product Category" value="<?php echo $list->category_id ?>">
                                <label>Product Picture</label>
                                <input type="file" accept="image/*" name="picture">
                                <input type="hidden" value="<?php echo $list->id ?>" name="id">
                                <button type="submit" name="edit">Save</button>
                            </form>
                        </div>
                        <button id="edit">Edit</button>
                        <a href="./product_management.php?delete=yes&name=<?php echo $list->name ?>"><button id="delete">Delete</button></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
        
    <script>

    const viewButtons = document.querySelectorAll('#view');
    const viewModals = document.querySelectorAll('.view');
    const backButtons = document.querySelectorAll('#b-v');

    viewButtons.forEach((button, index) => {
        button.onclick = () => {
            viewModals.forEach(modal => {
                modal.style.display = 'none';
            })
            viewModals[index].style.display = 'block';
        }
    });

    backButtons.forEach((button, index) => {
        button.onclick = () => {
            viewModals[index].style.display = 'none';
        }
    });

    const editButtons = document.querySelectorAll('#edit');
    const editModals = document.querySelectorAll('.edit');
    const backEdit = document.querySelectorAll('#b-e');

    editButtons.forEach((button, index) => {
        button.onclick = () => {
            editModals.forEach(modal => {
                modal.style.display = 'none';
            })
            editModals[index].style.display = 'block';
        }
    })

    backEdit.forEach((button, index) => {
        button.onclick = () => {
            editModals[index].style.display = 'none';
        }
    });
    </script>
  </body>
</html>