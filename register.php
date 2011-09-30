<?php

	echo "<h3>Register</h3>";
	//defining constants for freq. use
	define("DB_HOST","localhost");
	define("DB_USER","root");
	define("DB_PASS","iapor6$");
	define("DB_NAME","cea_fest_2012");

	
	$submit=strip_tags($_POST['submit']);
	
	//form data
	$fullname=strip_tags($_POST['fullname']);
	$username=strip_tags($_POST['username']);
	$password=strip_tags($_POST['password']);
	$repeatpassword=strip_tags($_POST['repeatpassword']);
	$date=date("Y-m-d");
	
	if($submit){
	
		//open database
		$connect = mysql_connect(DB_HOST,DB_USER,DB_PASS);
		mysql_select_db(DB_NAME);
		
		//search for matching username
		$namecheck = mysql_query("SELECT username FROM accounts WHERE username='$username'");
		$count = mysql_num_rows($namecheck);
		
		if($count != 0) {
			die("<span style='color:red'>Username already taken!</span><br/><a href='register.php'>Register again.</a>");
		}
		
		//check for existance
		if($fullname&&$username&&$password&&$repeatpassword){
		
			if($password==$repeatpassword){
			
				//check char length of username and password		
				if(strlen($fullname)>25||strlen($username)>25){
					echo "<span style='color:red'>Fullname and username should have less than 25 charaters.</span>";
				}
				
				else{
				
					//check password
					if(strlen($password)>25||strlen($password)<6){
						echo "<span style='color:red'>Password length should be greater than 6 and less than 25.</span>";
					}
					
					else{
						//register the user
						
						//encrypt password
						$password=md5($password);
						$repeatpassword=md5($repeatpassword);
						
						
						//insert user's data into the table in the db
						$queryreg = mysql_query("
						
						INSERT INTO accounts VALUES('','$fullname','$username','$password','$date') ");
						
						die("You have successfully been registered!<br/> <a href='index.php'>Click here </a>to log in.");
					}
				}
			}
			
			else{echo "<span style='color:red'>Passwords do not match.</span>";}
		
		
		}
		
		else{echo "Please fill <b>all</b> the fields.";}
	}
		
?>

<html>
	<body>
		<form action="" method="post">
			<table>
				<tr>
					<td>Your full name:</td>
					<!--type content will be retained to avoid retyping-->
					<td><input type="text" name="fullname" value="<?php echo $fullname;?>"></td>
				</tr>
				<tr>
					<td>Username:</td>
					<!--type content will be retained to avoid retyping-->
					<td><input type="text" name="username" value="<?php echo $username;?>"></td>
				</tr>
				<tr>
					<td>Choose a password:</td>
					<td><input type="password" name="password"></td>
				</tr>
				<tr>
					<td>Repeat password:</td>
					<td><input type="password" name="repeatpassword"></td>
				</tr>
			</table>
			<input type="submit" name="submit" value="Register">
		</form>
	</body>
</html>
