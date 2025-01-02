<?php
session_start();
include("./db_connect.php");

$user = $_SESSION['email'];

$query = $pdo->query("SELECT * FROM customers WHERE email = '$user'")->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cofi</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: oldlace;
      margin: 0;
      padding: 20px;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      height: 100vh;
      box-sizing: border-box;
      flex-direction: column;
    }

    h1 {
      text-align: center;
      font-size: 3rem;
      font-weight: 600;
      color: #333;
      margin: 2rem auto;
    }

    .profile {
      background-color: #f0f0f0;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 100%;
      max-width: 500px;
      text-align: center;
      position: relative;
      margin: 2rem auto;
    }

    .profile img {
      width: 200px;
      height: 200px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 20px;
      border: 3px solid palegreen;
    }

    .profile span {
      display: block;
      font-size: 16px;
      color: #333;
      margin-bottom: 10px;
    }

    .profile span:first-child {
      font-size: 18px;
      font-weight: bold;
      color: palegreen;
    }

    .back a {
      text-decoration: none;
      color: #333;
      font-size: 0.9rem;
      position: absolute;
      top: 20px;
      left: 20px;
    }

    .back a:hover {
      text-decoration: underline;
    }

    #popover {
      display: none;
      position: absolute;
      top: 55%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: oldlace;
      border-radius: 8px;
      padding: 20px;
      width: 100%;
      max-width: 300px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    #popover form {
      display: flex;
      flex-direction: column;
    }

    #popover label {
      margin-bottom: 5px;
      font-weight: bold;
    }

    #popover input[type="text"],
    #popover input[type="email"],
    #popover input[type="file"] {
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    #popover button, #btn {
      background-color: palegreen;
      border: none;
      padding: 10px;
      margin: 5px 0;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.2s ease;
    }

    #popover button:hover, #btn:hover {
      background-color: #88f188;
    }

    #popover .close {
      background-color: oldlace;
    }

    #popover button:focus {
      outline: none;
    }

  </style>
</head>
<body>
  <div class="back"><a href="./product_browsing.php">⬅ Browse Products</a></div>
  <h1>Account Settings</h1>
  <div class="profile">
    <img src="../photos/profile/<?php echo $query->profile ?>" alt="Profile Picture">
    <span>Status: <?php echo $query->status; ?></span>
    <span>Username: <?php echo $query->username; ?></span>
    <span>Email: <?php echo $query->email; ?></span>
    <span>Date Created: <?php echo $query->created_at; ?></span>
    <button id="btn">Edit Profile</button>
  </div>

  <div id="popover">
    <form action="./updateaccount.php" method="POST" enctype="multipart/form-data">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" value="<?php echo $query->username; ?>" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="<?php echo $query->email; ?>" required>

      <label for="profile_picture">Profile Picture:</label>
      <input type="file" id="profile_picture" name="profile_picture" accept="image/*">

      <button type="submit" name="save">Save</button>
      <button type="button" id="close">Cancel</button>
    </form>
  </div>

  <script>
    const btn = document.querySelector('#btn');
    const popover = document.querySelector('#popover');
    const close = document.querySelector('#close');

    btn.onclick = () => {
      popover.style.display = 'block';
    }

    close.onclick = () => {
      popover.style.display = 'none';
    }
  </script>
</body>
</html>
