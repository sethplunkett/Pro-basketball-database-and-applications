<html>
<head>
  <title>Team by Region</title>
  </head>
  <body>

<?php
include('connectData.txt');

$mysqli = new mysqli($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');


$state_Location = $_POST['state_Location'];
//execute the SQL query and return records
$query = "SELECT city, team_name, championships, team_value, revenue FROM Team 
JOIN State ON (Team.State_state_id = State.state_id) WHERE State.state_Location = ? ORDER BY city";
$query = $query."'".$state_Location."';";


if (!($stmt = $mysqli->prepare("SELECT city, team_name, championships, team_value, revenue FROM Team 
JOIN State ON (Team.State_state_id = State.state_id) WHERE state_Location = ? ORDER BY city"))) {
     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

/* Bind */
if (!$stmt->bind_param("s", $state_Location)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}
/* Execute */
if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

$result = mysqli_stmt_get_result($stmt);

/* explicit close recommended */
$stmt->close();
?>
        <style>
        thead {color:black;}
        </style>
        <h3>Team Info</h3>
         <table cellpadding="5" order="5" style= "font-family:arial; width: 50%; background-color: #84ed86; color: #761a9b;" >
      <thead>
       <tr>
        <th align="left">City</th>
        <th align="left">Team</th>
        <th align="left">Revenue</th>
        <th align="left">Value</th>
        <th align="left">Championships</th>
       </tr>
        </thead>
        <tbody>
        <?php
          while( $row = mysqli_fetch_array($result) ){

            echo
            "<tr>       
              <td>{$row['city']}</td>
              <td>{$row['team_name']}</td> 
              <td>{$row['revenue']}</td>  
              <td>{$row['team_value']}</td> 
              <td>{$row['championships']}</td> 
            </tr>\n";
          }
        ?>
      </tbody>
    </table>
    <?php mysqli_close($mysqli); ?>
    <p>
  <a href="teamByRegion.txt" >Contents</a>
  of this page.

    </body>
    </html>