﻿<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>

<body>

<?php
$servername = "localhost";
$username = "yassine";
$password = "2217";
$dbname = "eos";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Convert the query result into utf8
$conn->query("SET character_set_results=utf8");
/*
mb_language('uni'); 
mb_internal_encoding('UTF-8');
$conn->query("set names 'utf8'");
*/

$sql="
SELECT 
    item_no, 
    model, 
    wholesale, 
    ordered_qty,  
    wholesale * ordered_qty as total 
FROM 
    ITEM, 
    INVENTORY 
WHERE ITEM.upc = INVENTORY.upc";

$result = $conn->query($sql);

echo "
<table>
    <tr>
        <th>Item<br>Number</th>
        <th>Model</th>
        <th>Wholesale</th>
        <th>Ordered<br>Quantity</th>
        <th>Total</th>
    </tr>";
    
while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['item_no'] . "</td>";
    echo "<td>" . $row['model'] . "</td>";
    echo "<td>" . $row['wholesale'] . "</td>";
    echo "<td>" . $row['ordered_qty'] . "</td>";
    echo "<td>" . $row['total'] . "</td>";
    echo "</tr>";
}
echo "</table>";

$conn->close();
echo "connexion ended"
?>
</body>
</html>