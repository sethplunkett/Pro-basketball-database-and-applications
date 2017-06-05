<html>
<head>
  <title>Fan Merch Value</title>
  </head>
  <body>

<?php
include('connectData.txt');

$mysqli = new mysqli($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');


$fan_name = $_POST['fan_name'];
//execute the SQL query and return records
$query = "SELECT f.fan_name , m.purch_item_name, m.purch_item_value as merch_name FROM Fans f 
JOIN MerchPurchases m ON (m.Fans_fan_id = f.fan_id) where f.fan_name = ?
order by purch_item_value DESC limit 1";
$query = $query."'".$fan_name."';";


if (!($stmt = $mysqli->prepare("SELECT f.fan_name as fan, m.purch_item_name as name, m.purch_item_value as value FROM Fans f 
JOIN MerchPurchases m ON (m.Fans_fan_id = f.fan_id) where f.fan_name = ?
order by value DESC limit 1"))) {
     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

/* Bind */
if (!$stmt->bind_param("s", $fan_name)) {
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
        <h3>Fan Mechandise</h3>
         <table cellpadding="5" order="5" style= "font-family:arial; width: 50%; background-color: #84ed86; color: #761a9b;" >
      <thead>
       <tr>
        <th align="left">Fan</th>
        <th align="left">Item</th>
        <th align="left">Value</th>
       </tr>
        </thead>
        <tbody>
        <?php
          while( $row = mysqli_fetch_array($result) ){

            echo
            "<tr>       
              <td>{$row['fan']}</td>
              <td>{$row['name']}</td> 
              <td>{$row['value']}</td> 
            </tr>\n";
          }
        ?>
      </tbody>
    </table>
    <?php mysqli_close($mysqli); ?>
    <p>
  <a href="fanValue.txt" >Contents</a>
  of this page.

    </body>
    </html>