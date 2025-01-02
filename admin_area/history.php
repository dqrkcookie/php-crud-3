<?php

session_start();
include("./db_connect.php");

$query = $pdo->query("SELECT * FROM history ORDER BY id")->fetchAll();

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
    <h1>Transaction History</h1>

    <a href="./dashboard.php">Go Back</a>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Products</th>
                <th>Payment</th>
                <th>Date</th>
                <th>Transaction</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($query as $q) { ?>
                <tr>
                    <td><?php echo $q->name ?></td>
                    <td><?php echo implode(', ', json_decode($q->products) )?></td>
                    <td><?php echo $q->total ?></td>
                    <td><?php echo $q->date ?></td>
                    <td><?php echo $q->transaction ?></td>
                </tr>    
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
