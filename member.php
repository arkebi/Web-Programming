<?php
//continue last session
session_start();
if($_SESSION['username']){
	echo "Welcome ".$_SESSION['username']." !<br/><a href='logout.php'>Logout</a>";
}
//error message when accessed otherwise
else{die("You must be logged in to enter this page!");}

?>
