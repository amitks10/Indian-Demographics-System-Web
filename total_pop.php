<html>
<head>
<link href="pages.css" type="text/css" rel="stylesheet">
<title>
Total Population
</title>
</head>
<body>
    <a href="index2.html"><img src="flag_sys.png" id="fbaaza"></a>
<center>
<h1><a href="total_pop.php" style="text-decoration: none;color: black;">State Wise Population</a></h1>
<?php 
$conn=new mysqli('localhost','root','','project');
		if($conn->connect_error)
		{
			die ("Connection End".$conn->connect_error);
		}
?>
<div name="gettotalpop">
<?php
	    $sql="call gettotalpop() ";
		$result=$conn->query($sql);
		echo "<table border=1px>";
		echo "<tr><th>State Number</th>
			  <th>State</th>
			  <th>Total Population</th>
			  <th>Male Population</th>
			  <th>Female Population</th>
			  </tr>";
		while($row=$result->fetch_assoc())
		{
				echo "<tr>";
				echo "<td>".$row['st_code']."</td>";
				echo "<td>".$row['state']."</td>";
				echo "<td>".$row['total']."</td>";
				echo "<td>".$row['Males']."</td>";
				echo "<td>".$row['Females']."</td>";
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