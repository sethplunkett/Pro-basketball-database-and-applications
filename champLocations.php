<html>
<head>
  <title>Championships</title>
  </head>
  <body>

<?php
include('connectData.txt');

$conn = new mysqli($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');
?>

<?php
//execute the SQL query and return records
$query1 = "SELECT Team.championships as champs, State.state_Name as state FROM Team 
JOIN State ON (state_id = State_state_id) GROUP BY state_name 
ORDER BY championships DESC";
$result1 = mysqli_query($conn, $query1)
or die(mysqli_error($conn));


?>
        <style>
        thead {color:black;}
        </style>
        <h3>Championships by State</h3>
         <table cellpadding="5"  order="5" style= "font-family:arial; width: 20%; background-color: #84ed86; color: #761a9b;" >
      <thead>
       <tr>
        <th align="left">State</th>
        <th align="left">Championships</th>
       </tr>
        </thead>
        <tbody>
        <?php
          while( $row = mysqli_fetch_array($result1) ){

            echo
            "<tr>       
              <td>{$row['champs']}</td> 
              <td>{$row['state']}</td>   
            </tr>\n";
          }
        ?>
      </tbody>
    </table>
    
<?php

//execute the SQL query and return records
$query2 = "SELECT SUM(Team.championships) as champions, State.state_Location as loc FROM Team 
JOIN State ON (state_id = State_state_id) GROUP BY state_Location
ORDER BY championships DESC
";
$result1 = mysqli_query($conn, $query2)
or die(mysqli_error($conn));

?>
        <style>
        thead {color:black;}
        </style>
        <h3>Championships by Region</h3>
         <table cellpadding="5"  order="5" style= "font-family:arial; width: 20%; background-color: #84ed86; color: #761a9b;" >
      <thead>
       <tr>
        <th align="left">Region</th>
        <th align="left">Championships</th>
       </tr>
        </thead>
        <tbody>
        <?php
          while( $row = mysqli_fetch_array($result1)){

            echo
            "<tr>       
              <td>{$row['loc']}</td> 
              <td>{$row['champions']}</td>   
            </tr>\n";
          }
        ?>
      </tbody>
    </table>

    <?php mysqli_close($conn); ?>
    <a href="champLocations.txt" >Contents</a>
    of this page.
    
    </body>
    </html>