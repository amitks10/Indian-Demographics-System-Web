<html>
<head>
    
    <title>
    Climate
    </title>
    <link href='pages.css' rel='stylesheet' type="text/css">
    
    </head>
<body>
    <a href="index2.html"><img src="flag_sys.png" id="fbaaza"></a>
    <div id='zero'>
        <center>
            <h1><u>Climate in Our Country</u></h1>
            Select to see the average rainfall, max and min temperature in tabular form (statewise) :
            <form method='POST' action='climate.php'>
            <input type='submit' value=" Go " name='tab1'>
            </form>
            <?php
            if(isset($_POST['tab1']))
            {
                    $con=new mysqli("localhost","root","","project");
                    if($con->connect_error)
                        echo "database not connected";
                    $sql="select state.state as s0, cast(avg(AVG_RAIN) as decimal(7,2)) as s1, max(MAX_TEMP) as s2, MIN(MIN_TEMP) as s3 from main, state where main.ST_CODE=state.s_no group by  main.ST_CODE  order by state.state;";
                    $result=$con->query($sql);
                    echo "<table border=1px><tr><th>State</th><th>Average Rainfall</th><th>Max Temp</th><th>Min Temp</th></tr>";
                    while($rows=$result->fetch_assoc())
                    {
                        echo "<tr><td>".$rows['s0']."</td><td>".$rows['s1']."</td><td>".$rows['s2']."</td><td>".$rows['s3']."</td></tr>";
                    }
                    echo "</table><br><br>";
                    $con->close();
            }
            ?>
            
        
        </center><br><br>
    </div>
    
    
    <div id="one">
    <?php
        if(!isset($_POST['submit1']))
        {
            $con=new mysqli("localhost","root","","project");
            if($con->connect_error)
                echo "database not connected";
            $sql="select distinct(state) from literacy order by state;";
            $result=$con->query($sql);
            echo "<center><form method='POST' action='climate.php'>Select State : <select id='state1' name='state1'> ";
            echo "<option value='None' selected>-----Select State-----</option>";
            while($rows=$result->fetch_assoc())
            {
                $tp=$rows['state'];
                echo "<option value='$tp' >$tp</option><br>";
            }
            echo "</select><br><br><input type='submit' name='submit1' value='Submit'></form></center>";
            $con->close();
        }
        else
        {
            $con=new mysqli("localhost","root","","project");
            if($con->connect_error)
                echo "database not connected";
            $sql="select distinct(state) from literacy order by state;";
            $result=$con->query($sql);
            $st=$_POST['state1'];
            echo "<center><form method='POST' action='climate.php'>Select State : <select id='state1' name='state1'> ";
            while($rows=$result->fetch_assoc())
            {
                $tp=$rows['state'];
                if(!strcmp($st,$tp))
                    echo "<option value='$tp' selected>$tp</option><br>";
                else
                    echo "<option value='$tp' >$tp</option><br>";
            }
            echo "</select><br><br><input type='submit' name='submit1' value='Submit'></form></center>";
            $con->close();
        }
            ?>

    </div>
      
    
    <div id="ten">
    
        <?php
        if(isset($_POST['submit1']))
        {
            $con=new mysqli("localhost","root","","project");
            if($con->connect_error)
                echo "database not connected";
            $st=$_POST['state1'];
            echo "<center><br>";
            $sql="select cast(avg(AVG_RAIN) as decimal(7,2)) as sm, max(MAX_TEMP) as s1, min(MIN_TEMP) as s2 from main group by main.ST_CODE having main.ST_CODE = (select s_no from state where state.state like'$st') ";
            $result=$con->query($sql);
            
            if($rows=$result->fetch_assoc())
            {
                echo "<table><tr><th>State</th><th>Average rainfall</th><th>Max Temp</th><th>Min Temp</th></tr><tr><td>$st</td><td>".$rows['sm']."</td><td>".$rows['s1']."</td><td>".$rows['s2']."</td></tr></table>";
            }
            
            else
                echo "Not found<br>";
            echo "<br><br></center>";
            $con->close();
        }
        ?>
    </div>
   
    
    
    <div id="twenty">
        <form method='POST' action ='climate.php'>
          <center>  Select city : <select id='city1' name='city1'><option>-----Select City-----</option>
        <?php
        if(isset($_POST['submit1']))
        {
            $con=new mysqli("localhost","root","","project");
            if($con->connect_error)
                echo "database not connected";
            $st=$_POST['state1'];
            echo "<br>";
            $sql="select TOWN_NAME from main where ST_CODE =(select s_no from state where state like '$st') order by TOWN_NAME";
            $result=$con->query($sql);
             while($rows=$result->fetch_assoc())
            {
                $tp=$rows['TOWN_NAME'];                
                echo "<option value='$tp' selected>$tp</option><br>";
            }
            
            echo "<br><br>";
            $con->close();
        }
        ?>
            </select><br><br>
              <input type ='submit' value='Submit' name='submit2'>
            </center>
        </form>
        
    </div>
    
    
    <div id="twentyone">
        <?php
        if(isset($_POST['submit2']))
        {
            $con=new mysqli("localhost","root","","project");
            if($con->connect_error)
                echo "database not connected";
            $st=$_POST['city1'];
            $sql="select AVG_RAIN as s1, MAX_TEMP as s2, MIN_TEMP as s3 from main where TOWN_NAME like '$st'";
            $result=$con->query($sql);
            
            if($rows=$result->fetch_assoc())
            {
                echo "<table><tr><th>Town</th><th>Average rainfall</th><th>Max Temp</th><th>Min Temp</th></tr><tr><td>$st</td><td>".$rows['s1']."</td><td>".$rows['s2']."</td><td>".$rows['s3']."</td></tr></table>";
            }
            else
                echo "Not found<br>";
            echo "<br><br>";
            $con->close();
        }
        ?>
        
    </div>
    
    
    </body>

</html>