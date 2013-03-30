<?php
	session_start();
?>
<html>
<head>
<title>login page</title>
</head>
<body>
<form action="index.php" method=get>
<h1 align="center" style="color:gray" >Welcome to Login/Registration application</h1>
<?php
	if( $_SESSION["logging"]&& $_SESSION["logged"])
	{
 		print_secure_content();
	}
	else
	{
		if(!$_SESSION["logging"])
    		{  
			$_SESSION["logging"]=true;
			loginform();
    		}
    		else if($_SESSION["logging"])
    		{
        		$number_of_rows=checkpass();
        		if($number_of_rows==1)
            		{	
	         		$_SESSION[user]=$_GET[userlogin];
	         		$_SESSION[logged]=true;
	         		print"<h1>You have logged in successfully</h1>";
	         		print_secure_content();
            		}
            		else
            		{
               		print "wrong pawssword or username, please try again";	
                	loginform();
            		}
        	}
     	}
     
	function loginform()
	{
		print "please enter your login information to proceed with our site";
		print ("<table border='2'><tr><td>Name</td><td><input type='text' name='userlogin' size'20'></td></tr><tr><td>password</td><td><input type='password' name='password' size'20'></td></tr>	</table>");
		print "<input type='submit' >";	
	 	print ("<br><br><font align='center'> <h2>Features available in this application are</h2></font><br><table border='2' width='800px' align='center'><tr><td width='30%'><a href='userlist.php'><h3>User's list</h3></a>You can edit the user detail on this page</td><td width='30%'><h3><a href='registrationform.html'>Register now!</a></h3>Create your account on this page</td><td width='30%'><a href='logout.php'><h3>Logout</h3></a>Logging out of this application</td></tr></table><br>");	
		
	}
	function checkpass()
	{
		$servername="localhost";
		$username="giftjaip_naman";
		$conn=  mysql_connect($servername,$username,"boroplus88")or die(mysql_error());
		mysql_select_db("giftjaip_shaadi",$conn);
		$sql="select * from users where name='$_GET[userlogin]' and password='$_GET[password]'";
		$result=mysql_query($sql,$conn) or die(mysql_error());
		return  mysql_num_rows($result);
	}

	function print_secure_content()
	{
		print ("<br><br><font align='center'> <h2>Features available in this application are</h2></font><br><table border='2' width='800px' align='center'><tr><td width='30%'><a href='userlist.php'><h3>User's list</h3></a>You can edit the user detail on this page</td><td width='30%'><h3><a href='registrationform.html'>Register now!</a></h3>Create your account on this page</td><td width='30%'><a href='logout.php'><h3>Logout</h3></a>Logging out of this application</td></tr></table><br>");	
	}
?>
</form>
</body>
</html>