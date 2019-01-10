<html>
<head>
<link href="pages.css" type="text/css" rel="stylesheet">
<title>
Population
</title>
</head>
<body>
    <a href="index2.html"><img src="flag_sys.png" id="fbaaza"></a>
<center>
    
<h1><a href="population.php" style="text-decoration: none;color: black;">Population of A State</a></h1>
<?php 
$conn=new mysqli('localhost','root','','project');
		if($conn->connect_error)
		{
			die ("Connection End".$conn->connect_error);
		}
?>
<div name="total_population">
<?php
if(!isset($_POST['next']) && !! !isset($_POST['show'])){
echo "
<form name='first' method='POST' action = 'population.php'>
State:
<select name='state' id='state'>";
echo "<option value=''>-----select your state-----</option>";
		$sql="select distinct state from state_religion order by state";
		$result=$conn->query($sql);
		while($row=$result->fetch_assoc())
			{
				echo "<option value='".$row['state']."'>".$row['state']."</option>";
			}
echo "
</select>
<input type='submit' name='next' value='Next' id='next'/>
</form>";}
if(isset($_POST['next'])){
$state=$_POST['state'];
echo "<form name='last' method='POST' action = 'population.php'>
Type:
<select name='type' id='type'>";
		$sql="select type from state_religion where state='$state' ";
		$result=$conn->query($sql);
		while($row=$result->fetch_assoc())
			{
				echo "<option value='".$row["type"]."'>".$row['type']."</option>";
			}
echo "
</select>
Population:
<select name='rel' id='rel'>
<option value='total'>Total Population</option>
<option value='Males'>Male Population</option>
<option value='Females'>Female Population</option>
</select>
<input type='submit' name='show' value='SHOW' id='show'/>
</form>";
		$sql="create or replace view temp as select * from state_religion where state='$state' ";
		$result=$conn->query($sql);
		$sql="select * from state_religion where state='$state' ";
		$result=$conn->query($sql);
		echo "<table border=1px>";
		echo "<tr><th>State</th>
			  <th>Type</th>
			  <th>Total Population</th>
			  <th>Male Population</th>
			  <th>Female Population</th>
			  </tr>";
		while($row=$result->fetch_assoc())
		{
				echo "<tr>";
				echo "<td>".$row['state']."</td>";
				echo "<td>".$row['type']."</td>";
				echo "<td>".$row['total']."</td>";
				echo "<td>".$row['Males']."</td>";
				echo "<td>".$row['Females']."</td>";
				echo "</tr>";
		}
		echo "</table>";}
if(isset($_POST['show'])) {
		$type=$_POST['type'];
		$rel=$_POST['rel'];
	    $sql="select distinct state from temp";
	    $result=$conn->query($sql);
	    while($row=$result->fetch_assoc())
			{
				echo "The ".$type." ".$rel." Population of ".$row['state']." is : ";
			}
		$sql="select * from temp where type='$type'";
		$result=$conn->query($sql);
		if($result->num_rows>0)
		{
			while($row=$result->fetch_assoc())
			{
				echo $row[$rel];
			}
		}
		else
			echo "0 Results";
		$conn->close();
		}
		?>
		</div>
		<iframe name="myiframe" style="display: none;"></iframe>
		</center>
</body>
</html>