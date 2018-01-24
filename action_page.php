<?php
require_once 'database.php';
if (array_key_exists('item', $_POST)) {
    $item=$_POST['item'];
    $quantity=$_POST['quantity'];
    $price=$_POST['price'];
    $db->query("INSERT INTO list SET item='$item', quantity='$quantity', price='$price'");
    echo 'item added';
}
?>
