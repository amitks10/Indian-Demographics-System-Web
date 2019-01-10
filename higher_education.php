<html>
<head>
    
    <title>
    Higher Education
    </title>
    <link href='pages.css' rel='stylesheet' type="text/css">
    
    </head>
<body>
    <a href="index2.html"><img src="flag_sys.png" id="fbaaza"></a>
    <div id='zero'>
        <center>
            <h1><u>Higher Education in Our Country</u></h1>
            Select to see the various government institutions in tabular form (statewise) :
            <form method='POST' action='higher_education.php'>
            <input type='submit' value=" Go " name='tab1'>
            </form>
            <?php
            if(isset($_POST['tab1']))
            {
                    $con=new mysqli("localhost","root","","project");
                    if($con->connect_error)
                        echo "database not connected";
                    $sql="select state.state as s0, sum(ARTS) as s1, sum(SCIENCE) as s2, sum(COMMERCE) as s3, sum(ART_SC_CO) as s5, sum(LAW) as s6, sum(UNIV) as s7, sum(OTH_COL) as s8 from main, state where main.ST_CODE=state.s_no group by  main.ST_CODE  order by state.state;";
                    $result=$con->query($sql);
                    echo "<table><tr><th>State</th><th>ARTS</th><th>Science</th><th>Commerce</th><th>Arts&Science&Commerce</th><th>Law</th><th>Other Universities</th><th>Other Colleges</th></tr>";
                    while($rows=$result->fetch_assoc())
                    {
                        echo "<tr><td>".$rows['s0']."</td><td>".$rows['s1']."</td><td>".$rows['s2']."</td><td>".$rows['s3']."</td><td>".$rows['s5']."</td><td>".$rows['s6']."</td><td>".$rows['s7']."</td><td>".$rows['s8']."</td></tr>";
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
            echo "<center><form method='POST' action='higher_education.php'>Select State : <select id='state1' name='state1'> ";
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
            echo "<center><form method='POST' action='higher_education.php'>Select State : <select id='state1' name='state1'> ";
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
            $sql="select state.state as s0, sum(ARTS) as s1, sum(SCIENCE) as s2, sum(COMMERCE) as s3, sum(ART_SC_CO) as s5, sum(LAW) as s6, sum(UNIV) as s7, sum(OTH_COL) as s8 from main, state where main.ST_CODE=state.s_no group by  main.ST_CODE  having state.state like '$st';";
            $result=$con->query($sql);
            echo "<table><tr><th>State</th><th>ARTS</th><th>Science</th><th>Commerce</th><th>Arts&Science&Commerce</th><th>Law</th><th>Other Universities</th><th>Other Colleges</th></tr>";
            if($rows=$result->fetch_assoc())
            {
                echo "<tr><td>".$rows['s0']."</td><td>".$rows['s1']."</td><td>".$rows['s2']."</td><td>".$rows['s3']."</td><td>".$rows['s5']."</td><td>".$rows['s6']."</td><td>".$rows['s7']."</td><td>".$rows['s8']."</td></tr>";
            }
            
            else
                echo "Not found<br>";
            echo "<br><br></center>";
            $con->close();
        }
        ?>
    </div>
   
    
    
    <div id="twenty">
        <form method='POST' action ='higher_education.php'>
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
            $sql="select TOWN_NAME as s0, ARTS as s1, SCIENCE as s2, COMMERCE as s3, ART_SC_CO as s5, LAW as s6, UNIV as s7, OTH_COL as s8 from main where TOWN_NAME like '$st';";
            $result=$con->query($sql);
            echo "<table><tr><th>Town</th><th>ARTS</th><th>Science</th><th>Commerce</th><th>Arts&Science&Commerce</th><th>Law</th><th>Other Universities</th><th>Other Colleges</th></tr>";
            if($rows=$result->fetch_assoc())
                {
                    echo "<tr><td>".$rows['s0']."</td><td>".$rows['s1']."</td><td>".$rows['s2']."</td><td>".$rows['s3']."</td><td>".$rows['s5']."</td><td>".$rows['s6']."</td><td>".$rows['s7']."</td><td>".$rows['s8']."</td></tr>";
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