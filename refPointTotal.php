<html>
<head>
  <title>Ref Point Totals</title>
  </head>
  <body>

<?php
include('connectData.txt');

$conn = new mysqli($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');



//execute the SQL query and return records
$query = "SELECT Referee.referee_name as ref, SUM(PlaysIn.point_total) AS points FROM Referee 
JOIN RefereesIn on (Referee.referee_id = RefereesIn.Referee_referee_id) 
JOIN Game ON (Game.game_id = RefereesIn.Game_game_id)
JOIN PlaysIn ON (PlaysIn.Game_game_id = Game.game_id)
GROUP BY ref ORDER BY points DESC";
$result = mysqli_query($conn, $query)
or die(mysqli_error($conn));


?>
        <style>
        thead {color:black;}
        </style>
        <h2>Referee Point Totals</h2>
         <table cellpadding="5"  order="5" style= "font-family:arial; width: 20%; background-color: #84ed86; color: #761a9b;" >
      <thead>
       <tr>
        <th align="left">Referee</th>
        <th align="left">Total Points</th>
       </tr>
        </thead>
        <tbody>
        <?php
          while( $row = mysqli_fetch_array($result) ){

            echo
            "<tr>       
              <td>{$row['ref']}</td> 
              <td>{$row['points']}</td>   
            </tr>\n";
          }
        ?>
      </tbody>
    </table>
    <?php mysqli_close($conn); ?>
    
    <a href="refPointTotal.txt" >Contents</a>
  of this page.
    </body>
    </html>