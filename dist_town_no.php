<html>
<head>
<link href="pages.css" type="text/css" rel="stylesheet">
<title>
Total districts and towns
</title>
</head>
<body>
<center>
<a href="index2.html"><img src="flag_sys.png" id="fbaaza"></a>
<h1><a href="population.php" style="text-decoration: none;color: black;">State</a></h1>
<?php 
$conn=new mysqli('localhost','root','','project');
		if($conn->connect_error)
		{
			die ("Connection End".$conn->connect_error);
		}
?>
<div name="getdisttown">
<?php
	    $sql="call getdisttown() ";
		$result=$conn->query($sql);
		echo "<table border=1px>";
		echo "<tr><th>State Number</th>
			  <th>State</th>
			  <th>Number of Districts</th>
			  <th>Number of Towns</th>
			  </tr>";
		while($row=$result->fetch_assoc())
		{
				echo "<tr>";
				echo "<td>".$row['st_code']."</td>";
				echo "<td>".$row['state']."</td>";
				echo "<td>".$row['dist_no']."</td>";
				echo "<td>".$row['town_no']."</td>";
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