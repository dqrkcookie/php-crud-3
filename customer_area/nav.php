<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cofi</title>
  <script src="https://kit.fontawesome.com/b70669fb91.js" crossorigin="anonymous"></script>
  <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: #f4f4f4;
    }

    .nav {
        background-color: #98FB98;
        padding: 1rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .nav-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .logo {
        font-weight: bold;
        font-size: 2rem;
        color: #333;
    }

    .logo a {
        text-decoration: none;
        color: #444;
    }

    .search-container {
        flex: 1;
        max-width: 600px;
        margin: 0 1rem;
        position: relative;
    }

    .search-bar {
        width: 100%;
        padding: 0.5rem 2rem 0.5rem 1rem;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .search-bar:focus {
        outline: none;
        border-color: #999;
    }

    .search-container button {
        position: absolute;
        right: 0.5rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        font-size: 1.2rem;
        color: #333;
    }

    .nav-items {
        display: flex;
        gap: 1.5rem;
    }

    .nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        color: #666;
        text-decoration: none;
        cursor: pointer;
    }

    .nav-item:hover {
        color: #333;
    }

    .icon {
        width: 24px;
        height: 24px;
        margin-bottom: 4px;
    }

    .icon-text {
        font-size: 0.875rem;
    }

    @media (max-width: 768px) {
        .nav-container {
            flex-direction: column;
            gap: 1rem;
        }
        
        .search-container {
            margin: 1rem 0;
            width: 100%;
        }
        
        .nav-items {
            width: 100%;
            justify-content: space-around;
        }
    }
  </style>
</head>
<body>
  <nav class="nav">
    <div class="nav-container">
        <div class="logo"><a href="./product_browsing.php">Cofi</a></div>
        
        <form class="search-container" action="./product_browsing.php" method="GET">
            <input type="text" class="search-bar" name="search" placeholder="Search...">
            <button type="submit" name="look" value="search"><i class="fa-solid fa-magnifying-glass fa-md" style="color: #444;"></i></button>
        </form>
        
        <div class="nav-items">
            <a href="./cart.php" class="nav-item">
                <div class="icon"><i class="fa-solid fa-mug-hot fa-xl" style="color: #444;"></i></i></div>
                <span class="icon-text">Cart</span>
            </a>
            <a href="./placed_orders.php" class="nav-item">
                <div class="icon"><i class="fa-solid fa-box fa-lg" style="color: #444;"></i></div>
                <span class="icon-text">Orders</span>
            </a>
            <a href="./history.php" class="nav-item">
                <div class="icon"><i class="fa-solid fa-clock-rotate-left fa-lg" style="color: #444;"></i></div>
                <span class="icon-text">History</span>
            </a>
            <a href="./account.php" class="nav-item">
                <div class="icon"><i class="fa-solid fa-gear fa-lg" style="color: #444;"></i></div>
                <span class="icon-text">Settings</span>
            </a>
            <a href="./logout.php" class="nav-item">
                <div class="icon"><i class="fa-solid fa-door-open fa-lg" style="color: #444;"></i></div>
                <span class="icon-text">Logout</span>
            </a>
        </div>
    </div>
  </nav>
</body>
</html>
