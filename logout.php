<?php
//continue last session
session_start();
//stop session
session_destroy();
echo "You've been successfully logged out!. <a href='index.php'>Click here</a> to login again.";

?>
