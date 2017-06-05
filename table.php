<html>
<head>
  <title>Player Statistics</title>
  </head>
  <body>

<?php
include('connectData.txt');

$mysqli = new mysqli($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');


$team_name = $_POST['team_name'];
//execute the SQL query and return records
$query = "SELECT player_name, player_age, contract_yrs, contract_avg, 
player_per FROM Player JOIN Team ON (Player.Teams_team_name = Team.team_name) 
WHERE team_name = ? ORDER BY Player.player_per DESC";
$query = $query."'".$team_name."';";


if (!($stmt = $mysqli->prepare("SELECT player_name, player_age, contract_yrs, contract_avg, player_per 
  FROM Player JOIN Team ON (Player.Teams_team_name = Team.team_name) WHERE team_name = ? ORDER BY Player.player_per DESC"))) {
     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

/* Bind */
if (!$stmt->bind_param("s", $team_name)) {
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
        <h3>Player Info</h3>
         <table cellpadding="5" order="5" style= "font-family:arial; width: 50%; background-color: #84ed86; color: #761a9b;" >
      <thead>
       <tr>
        <th align="left">Name</th>
        <th align="left">Age</th>
        <th align="left">Contract Years</th>
        <th align="left">Contract Average</th>
        <th align="left">PER</th>
       </tr>
        </thead>
        <tbody>
        <?php
          while( $row = mysqli_fetch_array($result) ){

            echo
            "<tr>       
              <td>{$row['player_name']}</td>
              <td>{$row['player_age']}</td> 
              <td>{$row['contract_yrs']}</td> 
              <td>{$row['contract_avg']}</td>
              <td>{$row['player_per']}</td>   
            </tr>\n";
          }
        ?>
      </tbody>
    </table>
    <?php mysqli_close($mysqli); ?>
    <p>
  <a href="table.txt" >Contents</a>
  of this page.

    </body>
    </html>