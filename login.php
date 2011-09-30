<?php

session_start(); /*this function keeps the user logged in(even if you restart the browser) for 
					all the subsequent pages (you have to use in those pages also)*/

define("DB_HOST","localhost"); /*defining consts. for freq. usage*/
define("DB_USER","root");
define("DB_PASS","iapor6$");
define("DB_NAME","cea_fest_2012");

$username = $_POST['username']; /*since we used the 'post' method in the form in 'index.php'*/
$password = $_POST['password']; /*we obtain the values with $_POST['*']*/

if($username&&$password) {      /*conn. to db server only if the user fills all the fields*/
	$connect = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die("Can't connect!"); /*halt the script if can't connect*/
	mysql_select_db(DB_NAME) or die("Database error!");
	
	//retrieve data from table relevant to "$username"
	$query = mysql_query("SELECT * FROM accounts WHERE username = '$username'"); 
	$numrows = mysql_num_rows($query);
/*	echo $numrows;*/
	if($numrows!=0){
		while($row = mysql_fetch_assoc($query)){
			$dbusername = $row["username"];
			$dbpassword = $row["password"];
			
			// check to see if they match
			if($username==$dbusername&&md5($password)==$dbpassword){
				echo "You are in! <a href='member.php'>Click here</a> to enter the member page.";
				//start session for the user "$username"
				$_SESSION['username'] = $username; 
			}
			else{echo 'Incorrect username or password.';}
		}
		mysql_free_result($query);
	}
	else{die("That user doesn't exist!");}
}
else {die("Please enter username & password.");}

?>
