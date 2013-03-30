<?php
	$con = mysql_connect("localhost","giftjaip_naman","boroplus88");
	if (!$con)
	{
  		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("giftjaip_shaadi", $con);
	$result = mysql_query("SELECT * FROM users ORDER BY ID");
	echo "<h2> User's List</h2><br>
	<table border='2'>
	<tr>
	<th>ID</th>
	<th>Name</th>
	<th>Email Id</th>
	<th>Mobile no.</th>
	<th>Date Of Birth</th>
	</tr>";
	while($row = mysql_fetch_array($result))
	{
  		echo "<tr>";
		echo "<td>" . $row['id'] . "</td>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['email'] . "</td>";
		echo "<td>" . $row['phoneno'] . "</td>";
		echo "<td>" . $row['dob'] . "</td>";
//*** Table form in HTML***
?>
  <td><form name="input" action="comment.php?<?php echo $row['username']?>" method="get"><input type="hidden" id="a" name="id" value=<?php echo $row['tblname']?> /><input type="submit" value="Edit" /></form></td>
<?php
	echo "</tr>";
	}
	echo "</table>";
	mysql_close($con);
?>