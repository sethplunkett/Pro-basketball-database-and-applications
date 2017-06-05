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
$query1 = "SELECT (SELECT sum(purch_item_value) as sum1
        FROM MerchPurchases 
        join Fans on (MerchPurchases.Fans_fan_id = Fans.fan_id) 
        where Fans.season_ticket_id is not null) AS yeah,
       (SELECT sum(purch_item_value) as sum1
        FROM MerchPurchases 
        join Fans on (MerchPurchases.Fans_fan_id = Fans.fan_id) 
        where Fans.season_ticket_id is  null) no_way";
$result1 = mysqli_query($conn, $query1)
or die(mysqli_error($conn));
?>
       

        <style>
        thead {color:black;}
        </style>
        <h3>Season Ticket Holders</h3>
         <table cellpadding="5"  order="5" style= "font-family:arial; width: 20%; background-color: #84ed86; color: #761a9b;" >
      <thead>
       <tr>
        <th align="left">Yes</th>
        <th align="left">No</th>
       </tr>
        </thead>
        <tbody>
        <?php
          while( $row = mysqli_fetch_array($result1) ){

            echo
            "<tr>       
              <td>{$row['yeah']}</td> 
              <td>{$row['no_way']}</td>   
            </tr>\n";
          }
        ?>
      </tbody>
    </table>
    

    <?php mysqli_close($conn); ?>
    <a href="fanMerchandise.txt" >Contents</a>
  of this page.
    </body>
    </html>