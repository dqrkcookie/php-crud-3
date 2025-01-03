<?php

session_start();
include("./db_connect.php");

if(empty($_SESSION['admin_email'])){
    header("Location: ./login.php");
  }

$query = $pdo->query("SELECT * FROM customers ORDER BY id")->fetchAll();

?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: oldlace;
            margin: 0;
            padding: 1.25rem;
        }

        h1 {
        text-align: center;
        margin: 2rem 0;
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        position: relative;
        left: 50%;
        transform: translateX(-50%);
        }

        h1::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(to right, palegreen, #90ee90);
        border-radius: 2px;
        }

        a {
            display: inline-block;
            padding: 0.625rem 1.25rem;
            background-color: palegreen;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.2s ease;
        }

        a:hover {
            background-color: rgb(128, 252, 147);
        }

        table {
            width: 80%;
            margin: 2rem auto;
            border-collapse: collapse;
            background-color: oldlace;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        table th,
        table td {
            border: 1px solid palegreen;
            padding: 0.625rem;
            text-align: left;
        }

        table th {
            background-color: palegreen;
            color: #333;
            text-transform: uppercase;
            font-size: 0.875rem;
        }

        table tbody tr {
            background-color: white;
            transition: background-color 0.2s ease;
        }

        table tbody tr:hover {
            background-color: #f0f0f0;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            table {
                width: 100%;
                font-size: 0.875rem;
            }

            table th, 
            table td {
                padding: 0.5rem;
            }

            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>
    <h1>User Management</h1>

    <a href="./dashboard.php">Go Back</a>

    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Date Created</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($query as $q) { ?>
                <tr>
                    <td><?php echo $q->username ?></td>
                    <td><?php echo $q->email ?></td>
                    <td><?php echo $q->created_at ?></td>
                    <td><?php echo $q->status ?></td>
                    <td>
                        <?php if($q->status !== 'Active') { ?>
                            <a href="./block.php?block=no&email=<?php echo $q->email ?>">Unblock user</a>
                        <?php } else { ?>
                            <a href="./block.php?block=yes&email=<?php echo $q->email ?>">Block User</a>
                        <?php } ?>
                    </td>
                </tr>    
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
