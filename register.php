<?php
require_once 'database.php';
?>
<html>
<head>
  <title>Registration Form</title>
</head>
<body>
<?php
if (array_key_exists('name', $_POST)) {
    $name=$_POST['name'];
    $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
    $db->query("INSERT INTO users SET name='$name', password='$password'");
    echo 'user created';
}
else {
?>
<form method='POST'>
    <h4>Input your username</h4>
<input type='text' name='name'><br>
    <h4>Input your password</h4>
<input type='text' name='password'><br> <br>
<input type=submit>
</form>
<?php
}
?>
</body>
</html>
