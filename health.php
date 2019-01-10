<html>
<head>
    
    <title>
    Healthcare System
    </title>
    <link href='pages.css' rel='stylesheet' type="text/css">
    
    </head>
<body>
    <a href="index2.html"><img src="flag_sys.png" id="fbaaza"></a>
    <div id='zero'>
        <center>
            <h1><u>Healthcare System</u></h1>
            Select to see the No of Hospitals , No of Dispensaries , No of Health Centres and respective Beds in them (statewise) :
            <form method='POST' action='health.php'>
            <input type='submit' value=" Go " name='tab1'>
            </form>
            <?php
            if(isset($_POST['tab1']))
            {
                    $con=new mysqli("localhost","root","","project");
                    if($con->connect_error)
                        echo "database not connected";
                    $sql="select state.state as s0, cast(sum(hospitals) as decimal(7,2)) as s1, sum(hos_beds) as s2, sum(disp) as s3,sum(disp_beds) as s4,sum(health_ctr) as s5,sum(hc_beds) as s6 from main, state where main.ST_CODE=state.s_no group by  main.ST_CODE  order by state.state;";
                    $result=$con->query($sql);
                    echo "<table border=1px><tr><th>State</th><th>Hospitals</th><th>Hospital Beds</th><th>Dispensaries</th><th>Dispensary Beds</th><th>Health Centres</th><th>Health Centre Beds</th></tr>";
                    while($rows=$result->fetch_assoc())
                    {
                        echo "<tr><td>".$rows['s0']."</td><td>".$rows['s1']."</td><td>".$rows['s2']."</td><td>".$rows['s3']."</td><td>".$rows['s4']."</td><td>".$rows['s5']."</td><td>".$rows['s6']."</td></tr>";
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
            echo "<center><form method='POST' action='health.php'>Select State : <select id='state1' name='state1'> ";
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
            echo "<center><form method='POST' action='health.php'>Select State : <select id='state1' name='state1'> ";
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
            $sql="select cast(sum(hospitals) as decimal(7,2)) as sm, sum(hos_beds) as s1, sum(disp) as s2,sum(disp_beds) as s3,sum(health_ctr) as s4,sum(hc_beds) as s5 from main group by main.ST_CODE having main.ST_CODE = (select s_no from state where state.state like'$st') ";
            $result=$con->query($sql);
            
            if($rows=$result->fetch_assoc())
            {
                echo "<table><tr><th>State</th><th>Hospitals</th><th>Hospital Beds</th><th>Dispensaries</th><th>Dispensary Beds</th><th>Health Centres</th><th>Health Centre Beds</th></tr><tr><td>$st</td><td>".$rows['sm']."</td><td>".$rows['s1']."</td><td>".$rows['s2']."</td><td>".$rows['s3']."</td><td>".$rows['s4']."</td><td>".$rows['s5']."</td></tr></table>";
            }
            
            else
                echo "Not found<br>";
            echo "<br><br></center>";
            $con->close();
        }
        ?>
    </div>
   
    
    
    <div id="twenty">
        <form method='POST' action ='health.php'>
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
            $sql="select hospitals as s1, hos_beds as s2, disp as s3,disp_beds as s4,health_ctr as s5,hc_beds as s6 from main where TOWN_NAME like '$st'";
            $result=$con->query($sql);
            
            if($rows=$result->fetch_assoc())
            {
                echo "<table><tr><th>Town</th><th>Hospitals</th><th>Hospital Beds</th><th>Dispensaries</th><th>Dispensary Beds</th><th>Health Centres</th><th>Health Centre Beds</th></tr><tr><td>$st</td><td>".$rows['s1']."</td><td>".$rows['s2']."</td><td>".$rows['s3']."</td><td>".$rows['s4']."</td><td>".$rows['s5']."</td><td>".$rows['s6']."</td></tr></table>";
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