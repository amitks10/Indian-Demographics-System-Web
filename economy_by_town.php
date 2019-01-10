<html>
<head>
<link href="pages.css" type="text/css" rel="stylesheet">
<title>
Economy
</title>
</head>
<body>
    <a href="index2.html"><img src="flag_sys.png" id="fbaaza"></a>
<center>
<h1><a href="economy_by_town.php" style="text-decoration: none;color: black;">Economy of A Town</a></h1>
<div name="economy_by_town">
<?php 
$conn=new mysqli('localhost','root','','project');
		if($conn->connect_error)
		{
			die ("Connection End".$conn->connect_error);
		}
if(!isset($_POST['show'])){
echo "
<form name='first' method='POST' action = 'economy_by_town.php'>
Town:
<select name='town' id='town'>";
echo "<option value=''>-----select your town-----</option>";
		$sql="select distinct name_of_town from eco order by name_of_town";
		$result=$conn->query($sql);
		while($row=$result->fetch_assoc())
			{
				echo "<option value='".$row['name_of_town']."'>".$row['name_of_town']."</option>";
			}
echo "
</select>
<input type='submit' name='show' value='Show' id='show'/>
</form>";}
if(isset($_POST['show'])) {
		$town=$_POST['town'];
		$sql="select * from eco where name_of_town='$town' ";
		$result=$conn->query($sql);
		echo "<table border=1px>";
		echo "<tr><th>Name of Town</th>
			  <th>Annual Income</th>
			  <th>Annual Expenditure</th>
			  <th>Most Important Commodities Imported</th>
			  <th>Most Important Commodities Exported</th>
			  <th>Most Important Commodities Manufactured</th>
			  </tr>";
		while($row=$result->fetch_assoc())
		{
				echo "<tr>";
				echo "<td>".$row['Name_of_Town']."</td>";
				echo "<td>".$row['Annual_income']."</td>";
				echo "<td>".$row['Annual_expenditure']."</td>";
				echo "<td>".$row['Most_important_commodities_imported']."</td>";
				echo "<td>".$row['Most_important_commodities_exported']."</td>";
				echo "<td>".$row['Most_important_commodities_manufactured']."</td>";
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