<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cofi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        nav {
            background: palegreen;
            padding: 20px;
            text-align: center;
            display: flex;
            justify-content: space-around;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        body {
            background-image: url('./photos/icon/cofi.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
        }

        nav a {
            color: #444;
            font-size: 1.2rem;
            text-decoration: none;
            margin: 0 15px;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #222;
        }

        .hero {
            padding: 60px 20px;
            height: 100vh;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .hero h1 {
            font-size: 4.5rem;
            margin-bottom: 2rem;
            color: oldlace;
            text-shadow: 0 2px 6px #333;
        }

        .button {
            background: palegreen;
            color: #444;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .button:hover {
            background: #98FB98;
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .products {
            padding: 40px 20px;
            max-width: 1200px;
            border-radius: 15px;
            margin: 0 auto;
            background-color: rgba(172, 164, 164, 0.4);
            backdrop-filter: blur(5px);
        }

        .products h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #f0f0f0;
            font-size: 2.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            padding: 0 20px;
        }

        .product {
            border: 1px solid palegreen;
            border-radius: 25px 0 25px 0;
            padding: 20px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            transition: transform 0.3s ease;
        }

        .product:hover {
            transform: translateY(-5px);
        }

        .product img {
            width: 100%;
            max-width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 15px;
        }

        .product h3 {
            color: #f0f0f0;
            margin: 10px 0;
            font-size: 1.5rem;
            text-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }

        .product p {
            color: palegreen;
            font-weight: bold;
            font-size: 1.2rem;
            margin: 10px 0;
            text-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }

        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 3rem;
            }

            nav {
                padding: 15px;
            }

            nav a {
                font-size: 1rem;
                margin: 0 10px;
            }

            .product-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 20px;
                padding: 0 10px;
            }

            .products {
                padding: 30px 10px;
            }
        }

        @media (max-width: 480px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .products h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <nav>
        <a href="#home" aria-label="Home">Cofi</a>
        <span>
            <a href="#login" aria-label="Login to your account">Login</a>
            <a href="#register" aria-label="Create new account">Register</a>
        </span>
    </nav>

    <div class="hero">
        <h1>Welcome to Cofi</h1>
        <a href="#products" class="button">Shop Now</a>
    </div>

    <div class="products" id="products">
        <h2>Featured Drinks</h2>
        <div class="product-grid">
            <div class="product">
                <img src="/api/placeholder/200/200" alt="Coffee drink 1">
                <h3>Arabica Beans</h3>
                <p>99</p>
                <a href="#" class="button">Add to Cart</a>
            </div>
            <div class="product">
                <img src="/api/placeholder/200/200" alt="Coffee drink 2">
                <h3>Exelsa Beans</h3>
                <p>99</p>
                <a href="#" class="button">Add to Cart</a>
            </div>
            <div class="product">
                <img src="/api/placeholder/200/200" alt="Coffee drink 3">
                <h3>Liberica Beans</h3>
                <p>99</p>
                <a href="#" class="button">Add to Cart</a>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Cofi. All rights reserved.</p>
    </footer>
</body>
</html>