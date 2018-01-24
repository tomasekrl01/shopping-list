<?php
require_once 'database.php';
session_start();
if (array_key_exists('name', $_POST)) {
    $name=$db->escape_string($_POST['name']);
    $rs=$db->query("SELECT password FROM users WHERE name = '$name'");
    $row=$rs->fetch_assoc();
    $hash=$row['password'];
    $password=$_POST['password'];
    if(password_verify($password, $hash)) {
        $_SESSION['name']=$name;
        header('Location: /index.php');
        exit;
    }
    else {
        echo 'failure';
    }
}
else {
?>
<form method='POST'>
<input type='text' name='name'>
<input type='text' name='password'>
<input type=submit>
</form>
<?php
}
?>

