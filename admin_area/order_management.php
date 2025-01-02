<?php

session_start();
include("./db_connect.php");

$query = $pdo->query("SELECT * FROM order_management ORDER BY id")->fetchAll();

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
    <h1>Order Management</h1>

    <a href="./dashboard.php">Go Back</a>

    <table>
        <thead>
            <tr>
                <th>Ordered Products</th>
                <th>Customer</th>
                <th>Total Amount</th>
                <th>Address</th>
                <th>Status</th>
                <th>Update Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($query as $q) { ?>
                <tr>
                    <td><?php echo implode(', ', json_decode($q->product_name) )?></td>
                    <td><?php echo $q->user ?></td>
                    <td><?php echo $q->price ?></td>
                    <td><?php echo $q->address ?></td>
                    <td><?php echo $q->status ?></td>
                    <?php if($q->status == 'Pending') { ?>
                        <td><a href="./accept.php?user=<?php echo $q->user ?>&products=<?php echo urlencode($q->product_name) ?>">Accept</a></td>
                    <?php } else {?>
                        <td><?php echo 'Accepted' ?></td>
                    <?php } ?>
                </tr>    
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
