<html>
<head>
<link href="pages.css" type="text/css" rel="stylesheet">
<title>
Area
</title>
</head>
<body>
    <a href="index2.html"><img src="flag_sys.png" id="fbaaza"></a>
<center>
<h1><a href="getarea.php" style="text-decoration: none;color: black;">State Wise Area</a></h1>
<?php 
$conn=new mysqli('localhost','root','','project');
		if($conn->connect_error)
		{
			die ("Connection End".$conn->connect_error);
		}
?>
<div name="getarea">
<?php
	    $sql="call getarea() ";
		$result=$conn->query($sql);
		echo "<table border=1px>";
		echo "<tr><th>State Number</th>
			  <th>State</th>
			  <th>Total Area</th>
			  <th>Urban Area</th>
			  <th>Rural Area</th>
			  </tr>";
		while($row=$result->fetch_assoc())
		{
				echo "<tr>";
				echo "<td>".$row['s_no']."</td>";
				echo "<td>".$row['state']."</td>";
				echo "<td>".$row['tot_area']."</td>";
				echo "<td>".$row['urb_area']."</td>";
				echo "<td>".$row['rur_area']."</td>";
				echo "</tr>";
		}
		echo "</table>";
		$conn->close();
		?>
		</div>
		<iframe name="myiframe" style="display: none;"></iframe>
		</center>
</body>
</html>