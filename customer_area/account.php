<?php
session_start();
include("./db_connect.php");

if(empty($_SESSION['email'])){
  header("Location: ./login.php");
}

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
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        background: linear-gradient(135deg, oldlace, #fff8ee);
        margin: 0;
        padding: 24px;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        box-sizing: border-box;
      }

      h1 {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 2rem auto;
        position: relative;
        padding-bottom: 0.5rem;
      }

      h1::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(to right, palegreen, #88f188);
        border-radius: 2px;
      }

      .profile {
        background-color: white;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        padding: 32px;
        width: 100%;
        max-width: 500px;
        text-align: center;
        position: relative;
        margin: 2rem auto;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
      }

      .profile:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
      }

      .profile img {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        object-fit: cover;
        margin: 24px auto;
        border: 4px solid white;
        box-shadow: 0 0 0 4px palegreen, 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
      }

      .profile img:hover {
        transform: scale(1.05);
      }

      .profile span {
        display: block;
        font-size: 1rem;
        color: #4a5568;
        margin-bottom: 12px;
        padding: 8px;
        border-radius: 8px;
        transition: background-color 0.2s ease;
        cursor: default;
      }

      .profile span:hover {
        background-color: #f8f9fa;
      }

      .profile span:first-of-type {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2c3e50;
        border-bottom: 2px solid palegreen;
        display: inline-block;
        padding-bottom: 4px;
      }

      .back a {
        text-decoration: none;
        color: #2c3e50;
        font-size: 1rem;
      }

      .back a:hover {
        text-decoration: underline;
      }

      #btn {
        background-color: palegreen;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        color: #2c3e50;
        margin-top: 16px;
        transition: all 0.2s ease;
      }

      #btn:hover {
        background-color: #88f188;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(152, 251, 152, 0.3);
      }

      #popover {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        border-radius: 16px;
        padding: 32px;
        width: 90%;
        max-width: 400px;
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.15);
        animation: slideIn 0.3s ease;
      }

      @keyframes slideIn {
        from {
          opacity: 0;
          transform: translate(-50%, -48%);
        }
        to {
          opacity: 1;
          transform: translate(-50%, -50%);
        }
      }

      #popover form {
        display: flex;
        flex-direction: column;
        gap: 16px;
      }

      #popover label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 4px;
      }

      #popover input[type="text"],
      #popover input[type="email"] {
        padding: 12px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.2s ease;
      }

      #popover input[type="text"]:focus,
      #popover input[type="email"]:focus {
        border-color: palegreen;
        box-shadow: 0 0 0 3px rgba(152, 251, 152, 0.2);
        outline: none;
      }

      #popover input[type="file"] {
        padding: 8px;
        border: 2px dashed #e2e8f0;
        border-radius: 8px;
        cursor: pointer;
      }

      #popover input[type="file"]::-webkit-file-upload-button {
        background-color: #f0f0f0;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        cursor: pointer;
        margin-right: 12px;
        transition: background-color 0.2s ease;
      }

      #popover input[type="file"]::-webkit-file-upload-button:hover {
        background-color: #e0e0e0;
      }

      #popover button {
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
      }

      #popover button[type="submit"] {
        background-color: palegreen;
        border: none;
        color: #2c3e50;
      }

      #popover button[type="submit"]:hover {
        background-color: #88f188;
        transform: translateY(-2px);
      }

      #popover button[type="button"] {
        background-color: #f0f0f0;
        border: none;
        color: #4a5568;
      }

      #popover button[type="button"]:hover {
        background-color: #e0e0e0;
      }

      #status{
        width: 100%;
      }

      @media (max-width: 768px) {
        body {
          padding: 16px;
        }

        h1 {
          font-size: 2rem;
        }

        .profile {
          padding: 24px;
        }

        .profile img {
          width: 150px;
          height: 150px;
        }

        #popover {
          padding: 24px;
        }
      }

      .backdrop {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        z-index: 100;
      }

      #popover {
        z-index: 101;
      }
  </style>
</head>
<body>
  <div class="back"><a href="./product_browsing.php">⬅ Browse Products</a></div>
  <h1>Account Settings</h1>
  <div class="profile">
    <img src="../photos/profile/<?php echo $query->profile ?>" alt="Profile Picture">
    <span id="status">Status: <?php echo $query->status; ?></span>
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
      <input type="file" id="profile_picture" name="profile_picture" accept="image/*" required>

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
