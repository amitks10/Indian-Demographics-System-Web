<html>
<head>
    
    <title>
    Literacy
    </title>
    <link href="pages.css" rel="stylesheet" type="text/css">
    </head>
<body>
    <a href="index2.html"><img src="flag_sys.png" id="fbaaza"></a>
    <div id='zero'>
        <center>
            <h1><u>Literacy in Our Country</u></h1>
            Select to see the number of literates in tabular form (statewise) :
            <form method='POST' action='literacy.php'>
            <input type='submit' value=" Go " name='tab1'>
            </form>
            <?php
            if(isset($_POST['tab1']))
            {
                    $con=new mysqli("localhost","root","","project");
                    if($con->connect_error)
                        echo "database not connected";
                    $sql="select state, sum(literates) as s1, sum(male_literates) as s2, sum(female_literates) as s3 from literacy group by state order by state;";
                    $result=$con->query($sql);
                    echo "<table border=1px><tr><th>State</th><th>Total Literates</th><th>Male Literates</th><th>Female Literates</th></tr>";
                    while($rows=$result->fetch_assoc())
                    {
                        echo "<tr><td>".$rows['state']."</td><td>".$rows['s1']."</td><td>".$rows['s2']."</td><td>".$rows['s3']."</td></tr>";
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
            echo "<center><form method='POST' action='literacy.php'>Select State : <select id='state1' name='state1'> ";
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
            echo "<center><form method='POST' action='literacy.php'>Select State : <select id='state1' name='state1'> ";
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
            $sql="select sum(literates) as sm from literacy group by state having state like '$st' ";
            $result=$con->query($sql);
            
            if($rows=$result->fetch_assoc())
                echo "Number of literates in $st is ".$rows['sm'].".<br>";
            
            else
                echo "Not found<br>";
            echo "<br><br></center>";
            $con->close();
        }
        ?>
    </div>
   
    
    
    <div id="twenty">
        <form method='POST' action ='literacy.php'>
          <center>  Select city : <select id='city1' name='city1'><option>-----Select City-----</option>
        <?php
        if(isset($_POST['submit1']))
        {
            $con=new mysqli("localhost","root","","project");
            if($con->connect_error)
                echo "database not connected";
            $st=$_POST['state1'];
            echo "<br>";
            $sql="select city from literacy where state like '$st' order by city";
            $result=$con->query($sql);
             while($rows=$result->fetch_assoc())
            {
                $tp=$rows['city'];                
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
            $sql="select literates as sm from literacy where city like '$st'";
            $result=$con->query($sql);
            
            if($rows=$result->fetch_assoc())
                echo "<center>Number of literates in $st is ".$rows['sm'].".<br></center>";
            else
                echo "Not found<br>";
            echo "<br><br>";
            $con->close();
        }
        ?>
        
    </div>
    
    
    </body>

</html>