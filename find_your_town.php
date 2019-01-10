<html>
<head>
<link href="pages.css" type="text/css" rel="stylesheet">
<title>
Find Your Town
</title>
</head>
<body>
    <a href="index2.html"><img src="flag_sys.png" id="fbaaza"></a>
<center>
<h1><a href="find_your_town.php" style="text-decoration: none;color: black;">Find your Town</a></h1>
<?php 
$conn=new mysqli('localhost','root','','project');
		if($conn->connect_error)
		{
			die ("Connection End".$conn->connect_error);
		}
if(!isset($_POST['show']) && !isset($_POST['next'])  && !isset($_POST['next1'])){
echo "
<form name='first' method='POST' action = 'find_your_town.php'>
State:
<select name='state' id='state'>";
echo "<option value=''>-----select your state-----</option>";
		$sql="select distinct state from dis_state order by state";
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
echo "<form name='student' method='POST' action = 'find_your_town.php'>
District:
<select name='district' id='district'>";
echo "<option value=''>-----select your district-----</option>";
		$sql="select DIST_H_NA from dis_state where state='$state' order by DIST_H_NA";
		$result=$conn->query($sql);
		while($row=$result->fetch_assoc())
			{
				echo "<option value='".$row["DIST_H_NA"]."'>".$row['DIST_H_NA']."</option>";
			}
echo "
</select>
<input type='submit' name='next1' value='NEXT' id='next1'/>
</form>";}
if(isset($_POST['next1'])){
$district=$_POST['district'];
echo "<form name='last' method='POST' action = 'find_your_town.php'>
Town:
<select name='town' id='town'>";
echo "<option value=''>-----select your town-----</option>";
		$sql="create or replace view temp as select * from main where dist_h_na='$district' order by town_name ";
		$result=$conn->query($sql);
		$sql="select town_name from main where dist_h_na='$district' order by town_name";
		$result=$conn->query($sql);
		while($row=$result->fetch_assoc())
			{
				echo "<option value='".$row["town_name"]."'>".$row['town_name']."</option>";
			}
echo "
</select>
<input type='submit' name='show' value='SHOW' id='show'/>
</form>";}
if(isset($_POST['show'])) {
		$town=$_POST['town'];
		$sql="select * from temp,state where state.s_no=temp.st_code and town_name='$town'";
		$result=$conn->query($sql);
		echo "<table border=1px>";
		echo "<tr>
			  <th>State</th>
			  <th>District</th>
			  <th>Town Name</th>
			  <th>Households</th>
			  <th>Population</th>
			  <th>Sex Ratio</th>
			  <th>Area</th>
			  <th>Railway Station</th>
			  <th>Bus Route</th>
			  <th>State Headquartes</th>
			  <th>City Distance</th>
			  </tr>";
		while($row=$result->fetch_assoc())
		{
				echo "<tr>";
				echo "<td>".$row['state']."</td>";
				echo "<td>".$row['DIST_H_NA']."</td>";
				echo "<td>".$row['TOWN_NAME']."</td>";
				echo "<td>".$row['HOUSEHOLD']."</td>";
				echo "<td>".$row['POP_2001']."</td>";
				echo "<td>".$row['SEX_2001']."</td>";
				echo "<td>".$row['AREA']."</td>";
				echo "<td>".$row['RAILWAY_ST']."</td>";
				echo "<td>".$row['BUS_ROUTE']."</td>";
				echo "<td>".$row['STATE_H_NA']."</td>";
				echo "<td>".$row['CITY_DIST']."</td>";
				echo "</tr>";
		}
		echo "</table>";
		$conn->close();
		}
		?>
		</center>
		<iframe name="myiframe" style="display: none;"></iframe>
</body>
</html>