<?php
	session_start();
	if($_GET["id"])
		$servername="localhost";
		$username="giftjaip_naman";
		$conn=  mysql_connect($servername,$username,"boroplus88")or die(mysql_error());
		mysql_select_db("giftjaip_shaadi",$conn);
		$sql= "SELECT * FROM users where id ='$_GET[id]' ";
		$result = mysql_query($sql,$conn)or die ("Bad query: " . mysql_error() );
    		while($row = mysql_fetch_array($result))
    		{
//**** Edit html form***
?>
<h2>Edit Form</h2>
<h3>Customize the information about the user as you want</h3>
<form name="input" action="update.php?<?php echo $row[name]?>" method="get"><input type="hidden" id="a" name="id" value=<?php echo $row['id']?>/><br/>First name: <input type="text" name="tf_FirstName" value=<?php echo $row['name'];?> /><br />Email id: <input type="text" name="tf_Email" value=<?php echo $row['email']?> /> &nbsp &nbspDate Of Birth: <input type="text" name="tf_DOB" value=<?php echo $row['dob'];?> /><br /<br />Phone no: <input type="text" name="tf_Mobile" value=<?php echo $row['phoneno']?> /><br/><input type="submit" value="Update" />
<?php
		}
?>