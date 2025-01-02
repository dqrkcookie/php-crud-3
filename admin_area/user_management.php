<?php

session_start();
include("./db_connect.php");

$query = $pdo->query("SELECT * FROM customers ORDER BY id")->fetchAll();

?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: oldlace;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: palegreen;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.2s ease;
        }

        a:hover {
            background-color:rgb(128, 252, 147);
        }

        table {
            width: 80%;
            margin: 2rem auto;
            border-collapse: collapse;
            background-color: oldlace;
        }

        table th, table td {
            border: 1px solid palegreen;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: palegreen;
            color: #333;
        }

        table tbody tr {
            background-color: #f0f0f0;
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
