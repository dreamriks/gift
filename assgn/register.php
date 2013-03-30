<?php
	session_start();session_destroy(); session_start();
	if($_GET["tf_FirstName"] && $_GET["tf_DOB"] && $_GET["tf_Mobile"] && $_GET["tf_Email"] && $_GET["tf_AccPwd"] && $_GET["tf_ReAccPwd"] )
	{
		if($_GET["tf_AccPwd"]==$_GET["tf_ReAccPwd"])
		{
			$servername="localhost";
			$username="giftjaip_naman";
    			$conn=  mysql_connect($servername,$username,"boroplus88")or die(mysql_error());
			mysql_select_db("giftjaip_shaadi",$conn);
			$sql="insert into users (name,email,password,phoneno,dob)values('$_GET[tf_FirstName]','$_GET[tf_Email]','$_GET[tf_AccPwd]','$_GET[tf_Mobile]','$_GET[tf_DOB]')";
			$result=mysql_query($sql,$conn) or die(mysql_error());		
			print "<h1>you have registered sucessfully</h1>";
			print "<a href='index.php'>go to login page</a>";
		}
	else 
		print "passwords doesnt match";
	}
	else
		print"invaild input data";
?>