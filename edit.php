<?php
include_once 'database.php';

if(isset($_POST['edit'])) {
    $id=$_POST['id'];
    $item=$_POST['item'];
    $quantity=$_POST['quantity'];
    $price=$_POST['price'];
    
    if(empty($item)) {
        echo "<font color='red'>Name field is empty.</font></br>";
    }
}
else {
    $result = mysqli_query($db, "UPDATE list SET item='$item', quantity='$quantity', price='$price' WHERE id='$id'");
}

    $id=$_GET['id'];
    $result=mysqli_query($db, "SELECT * FROM list WHERE id=$id");
    
    while($res=mysqli_fetch_array($result))
    {
        $item=$res['item'];
        $quantity=$res['quantity'];
        $price=$res['price'];
    }
?>
<html>
<head>
    <title>Edit</title>
</head>
</html>
<body>
    <form method='POST'>
    <fieldset>
        <legend>Edit display:</legend>
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
        <input type='submit' value='update' id='update' name='update'>
    </fieldset>
    </form> <br>
</body>
