<?php
 session_start();session_destroy(); session_start();
	if($_GET["tf_FirstName"] && $_GET["tf_DOB"] && $_GET["tf_Mobile"] && $_GET["tf_Email"]&& $_GET["id"] )
	{
		$servername="localhost";
		$username="giftjaip_naman";
		$conn=  mysql_connect($servername,$username,"boroplus88")or die(mysql_error());
		mysql_select_db("giftjaip_shaadi",$conn);   
		mysql_query("UPDATE users SET name='$_GET[tf_FirstName]', dob='$_GET[tf_DOB]', phoneno='$_GET[tf_Mobile]', email='$_GET[tf_Email]' WHERE id='$_GET[id]'");
		echo  "<h2>Update successful</h2><br> ";
		mysql_close($conn);
	}
?>
<a href="index.php">Click here</a> to go to login page