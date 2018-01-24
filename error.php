<?php
$itemErr = $quantErr = $priceErr = "";
$item = $quantity = $price = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['item'])) {
        $itemErr = "*";
    }
    else {
        $item = test_input($_POST['item']);
    }
    
    if (empty($_POST['quantity'])) {
        $quantErr = "";
    }
    else {
        $quantity = test_input($_POST['quantity']);
    }
    
    if (empty($_POST['price'])) {
        $priceErr = "";
    }
    else {
        $price = test_input($_POST['price']);
    }
    
}
?>
