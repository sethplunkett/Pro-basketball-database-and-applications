<html>
<head>
  <title>Player Per by Age</title>
  </head>
  <body>

<?php
include('connectData.txt');

$conn = new mysqli($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');



//execute the SQL query and return records
$query = "SELECT player_age, ROUND(AVG(player_per),1) as per FROM Player 
GROUP BY player_age ORDER BY player_age";
$result = mysqli_query($conn, $query)
or die(mysqli_error($conn));


?>
        <style>
        thead {color:black;}
        </style>
        <h2>Player Information</h2>
         <table cellpadding="5" order="5" style= "font-family:arial; width: 20%; background-color: #84ed86; color: #761a9b;" >
      <thead>
       <tr>
        <th align="left">Age</th>
        <th align="left">PER</th>
       </tr>
        </thead>
        <tbody>
        <?php
          while( $row = mysqli_fetch_array($result) ){

            echo
            "<tr>       
              <td>{$row['player_age']}</td> 
              <td>{$row['per']}</td>   
            </tr>\n";
          }
        ?>
      </tbody>
    </table>
    <?php mysqli_close($conn); ?>
    <a href="playerPer.txt" >Contents</a>
  of this page.

    </body>
    </html>