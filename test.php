<!DOCTYPE html>
<html>
<head>
<title>shopping list</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script>
function action(a) {
    location.href="<?php echo $_SERVER['PHP_SELF']?>?action="+a;
}
</script>
</head>
<body>
    <h1>Shopping list</h1><br> <br>
    
<?php 
 
require_once 'database.php';
if (array_key_exists('action', $_REQUEST)) {
    $action=$_REQUEST['action'];
}
else {
    $action=NULL;
}
if ($action=='create') {
    createItem();
}
elseif ($action=='update') {
    updateItem();
}
elseif ($action=='list') {
    displayList();
}
elseif ($action=='clear') {
    displayClear();
}
elseif ($action =='delete') {
    deleteItem();
}
elseif ($action =='edit') {
    editItem();
}
else {
    displayNew();
}
?>

    <input type='button' onclick='action("list")' value='Display list'>
    <input type='button' onclick='action("clear")' value='Clear list'>
<br>
<?php

function deleteItem() {
    global $db;
    $del_id=$_GET['id'];
    $sql="Delete FROM list WHERE id=$del_id";
    mysqli_query($db, $sql);
    displayList();
}

function createItem() {
    global $db;
    $item=$_POST['item'];
    $quantity=$_POST['quantity'];
    $price=$_POST['price'];
    $db->query("INSERT INTO list SET item='$item', quantity='$quantity', price='$price'");
    ?> <h4>Item added</h4> <?php
    displayList();
}

function updateItem() {
    global $db;
    $item=$_POST['item'];
    $quantity=$_POST['quantity'];
    $price=$_POST['price'];
    $id=$_POST['id'];
    $db->query("UPDATE list SET item='$item', quantity='$quantity', price='$price' WHERE id=$id");
    ?> <h4>Item updated</h4> <?php
    displayList();
}

function editItem() {
    global $db;
    $id=$_GET['id'];
    $sql = "SELECT * FROM list WHERE id=$id";
    $result = $db->query($sql);
    $row=$result->fetch_assoc();
    ?>
    
    <form method='POST'>
    <fieldset>
        <legend>Edit display:</legend>
        <h4 class='req'>*Item is required</h4>
            <label for='item'>Item:</label>   
                <input type='text' name='item' value='<?php echo $row['item'] ?>'>
                    <span class='error'> <?php echo $itemErr; ?></span> <br>
            <label for='quantity'>Quantity:</label> 
                <input type='number' name='quantity' value='<?php echo $row['quantity'] ?>'>
                    <span class='error'> <?php echo $quantErr; ?></span> <br>
            <label for='price'>Price:</label>
                <input type ='number' name='price' step='0.01' value='<?php echo $row['price']?>'>
                    <span class='error'> <?php echo $priceErr; ?></span> <br>
        <input type='hidden' name='id' value='<?php echo $row['id'] ?>'>
        <input type='hidden' name='action' value='update'>
        <input type='submit' value='update' id='update' name='update'>
    </fieldset>
    </form> <br>
    <?php
}

function displayClear() {
    global $db;
    $sql = "TRUNCATE TABLE list";
    mysqli_query($db, $sql);

    ?> <h4>List has been cleared.</h4> <?php
    displayNew();
}

function displayList() {
    global $db;
    $sql = "SELECT * FROM list";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
    ?>
        <table>
            <thead>
                <tr>
                    <th>aquired</th>
                    <th>id number</th>
                    <th>item</th>
                    <th>quantity</th>
                    <th>price</th>
                    <th>remove item</th>
                    <th>edit item</th>
                </tr>
            </thead>
            <tbody>
        <?php

        while ($row = $result->fetch_assoc()) {
            ?><tr>
                <td>
                    <input type='checkbox' name='aquired' value='yes'>yes
                </td>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['item']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <?php $id = $row['id']; ?>
                <td>
                    <button name='delete' onclick='action("delete&id=<?php echo $id ?>")' value='delete'>delete</button>
                </td>
                <td>
                    <input type='submit' name='edit' value='edit' onclick='action("edit&id=<?php echo $id ?>")'>
                </td>
            </tr>
            <?php
        }
        ?>
            </tbody>
        </table>
        <?php
    }
    else {
        ?> <h4>0 results</h4> <?php
    }
}

function displayNew() {
    ?>
    <form method='POST'>
    <fieldset>
        <legend>Grocery List:</legend>
        <h4 class='req'>*Item is required</h4>
            <label for='item'>Item:</label>   
                <input type='text' name='item'>
                    <span class='error'> <?php echo $itemErr; ?></span> <br>
            <label for='quantity'>Quantity:</label> 
                <input type='number' name='quantity'>
                    <span class='error'> <?php echo $quantErr; ?></span> <br>
            <label for='price'>Price:</label>
                <input type ='number' name='price' step='0.01'>
                    <span class='error'> <?php echo $priceErr; ?></span> <br>
        <input type='hidden' name='action' value='create'>
        <input type='submit' value='add item' id='add item' name='add item'>
    </fieldset>
    </form> <br>
    <?php
}
 ?>

</body>
</html>
