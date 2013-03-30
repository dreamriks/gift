<?php

/*
$username="root";
$password="";
$database="arnium";
mysql_connect("localhost",$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="SELECT * FROM record";
$result=mysql_query($query);
$num=mysql_num_rows($result);
mysql_close();
*/
$values=array(
		"Jan" => 110,
		"Feb" => 130,
		"Mar" => 215,
		"Apr" => 81,
		"May" => 310,
		"Jun" => 110,
		"Jul" => 190,
		"Aug" => 175,
		"Sep" => 450,
		"Oct" => 286,
		"Nov" => 150,
		"Dec" => 196
	);
	
	/*
	<?php
		echo values[0];
		for(i){
			echo ','.values[i];
		}
	?>
	*/
	
?>

<html>
<head>

	<script language="javascript" type="text/javascript" src="./jqplot/jquery.min.js"></script>

	<script language="javascript" type="text/javascript" src="./jqplot/jquery.jqplot.min.js"></script>


	<script type="text/javascript" src="./jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
	<script type="text/javascript" src="./jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="./jqplot/jquery.jqplot.min.css" />

	<script class="code" type="text/javascript">
	$(document).ready(function(){
		var plot1 = $.jqplot ('chart1', [[<?php echo $values['Jan'].','.$values['Feb'].','.$values['Mar'].','.$values['Apr'].','.$values['May']; ?>]]);
	});

});
	</script>
</head>

<body>

<div id="chart1" style="height:300px; width:500px;"></div>

</body>
</html>