<?php
require_once 'database.php';
//echo $_POST['test'];
$rs=$db->query('SELECT * FROM things');
foreach($rs as $row) {
	echo $row ['name'];
}
?>
<form method='POST'>
<input type='text' name='test'>
<input type=submit>
</form>

