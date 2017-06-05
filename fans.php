<html>
<head>
  <title>Merchandise</title>
  </head>
  <body>

<?php
include('connectData.txt');

$conn = new mysqli($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');
?>

<?php
//execute the SQL query and return records
$query1 = "SELECT f.fan_name as fan, f.Teams_team_name as team, 
sum(m.purch_item_value) as value FROM Fans f 
JOIN MerchPurchases m ON (m.Fans_fan_id = f.fan_id) 
GROUP BY fan_name ORDER BY value DESC";
$result1 = mysqli_query($conn, $query1)
or die(mysqli_error($conn));
?>
       

        <style>
        thead {color:black;}
        </style>
        <h3>Merchandise Value</h3>
         <table cellpadding="5"  order="5" style= "font-family:arial; width: 20%; background-color: #84ed86; color: #761a9b;" >
      <thead>
       <tr>
        <th align="left">Fan</th>
        <th align="left">Team</th>
        <th align="left">Value</th>
       </tr>
        </thead>
        <tbody>
        <?php
          while( $row = mysqli_fetch_array($result1) ){

            echo
            "<tr>       
              <td>{$row['fan']}</td> 
              <td>{$row['team']}</td>  
              <td>{$row['value']}</td>  
            </tr>\n";
          }
        ?>
      </tbody>
    </table>
    <?php mysqli_close($conn); ?>

    <a href="fans.txt" >Contents</a>
    of this page.
    </body>
    </html>