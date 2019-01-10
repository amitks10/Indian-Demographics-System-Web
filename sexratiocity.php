<html>
<head>
<link href="pages.css" type="text/css" rel="stylesheet">
<title>
Gender Ration By District
</title>
</head>
<body>
    <a href="index2.html"><img src="flag_sys.png" id="fbaaza"></a>
<center>
<h1><a href="sexratiocity.php" style="text-decoration: none;color: black;">District Wise Gender Ratio</a></h1>
<div name="economy_by_town">
<?php 
$conn=new mysqli('localhost','root','','project');
		if($conn->connect_error)
		{
			die ("Connection End".$conn->connect_error);
		}
if(!isset($_POST['show'])){
echo "
<form name='first' method='POST' action = 'sexratiocity.php'>
State:
<select name='state' id='state'>";
echo "<option value=''>-----select your state-----</option>";
		$sql="select distinct state from literacy order by state";
		$result=$conn->query($sql);
		while($row=$result->fetch_assoc())
			{
				echo "<option value='".$row['state']."'>".$row['state']."</option>";
			}
echo "
</select>
<input type='submit' name='show' value='Show' id='show'/>
</form>";}
if(isset($_POST['show'])) {
		$state=$_POST['state'];
		$sql="call getsexratiocity('$state')";
		$result=$conn->query($sql);
		echo "<table border=1px>";
		echo "<tr>
			  <th>State</th>
			  <th>District</th>
			  <th>Sex Ratio</th>
			  <th>Child Sex Ratio</th>
			  </tr>";
		while($row=$result->fetch_assoc())
		{
				echo "<tr>";
				echo "<td>".$row['state']."</td>";
				echo "<td>".$row['city']."</td>";
				echo "<td>".$row['sex_ratio']."</td>";
				echo "<td>".$row['child_sex_ratio']."</td>";
				echo "</tr>";
		}
		echo "</table>";
	}
		$conn->close();
		?>
		</div>
		<iframe name="myiframe" style="display: none;"></iframe>
		</center>
</body>
</html>