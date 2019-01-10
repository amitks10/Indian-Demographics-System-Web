<html>
<head>
<link href="pages.css" type="text/css" rel="stylesheet">
<title>
Gender Ratio
</title>
</head>
<body>
    <a href="index2.html"><img src="flag_sys.png" id="fbaaza"></a>
<center>
<h1><a href="sexratio.php" style="text-decoration: none;color: black;">State Wise Gender Ratio</a></h1>
<?php 
$conn=new mysqli('localhost','root','','project');
		if($conn->connect_error)
		{
			die ("Connection End".$conn->connect_error);
		}
?>
<div name="getarea">
<?php
	    $sql="call getsexratio() ";
		$result=$conn->query($sql);
		echo "<table border=1px>";
		echo "<tr><th>State Number</th>
			  <th>State</th>
			  <th>Sex Ratio</th>
			  <th>Child Sex Ratio</th>
			  </tr>";
		while($row=$result->fetch_assoc())
		{
				echo "<tr>";
				echo "<td>".$row['st_code']."</td>";
				echo "<td>".$row['state']."</td>";
				echo "<td>".$row['sex_ratio']."</td>";
				echo "<td>".$row['child_sex_ratio']."</td>";
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