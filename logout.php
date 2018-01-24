<?php
?>
<form method='POST'>
<input type='submit' name='logout' id='logout' value='logout'>
</form>
<?php
function logout() {
    session_destroy();
}
if(array_key_exists('logout',$_POST)){
	logout();
}
?>

