<?php  

$hostname = 'Pi3WebServer4G';
$username = 'pi_select';
$password = 'raspberry';
$database = 'db_cpu';
$filename = 'userData.csv';

$dbh = new PDO("mysql:host=$hostname;dbname=$database", 
$username, $password);

/*** The SQL SELECT statement ***/
$sth = $dbh->prepare("
    SELECT  `dateTime`,`TValue`
    FROM  `TAB_CPU`
    ORDER BY `dateTime` desc
    LIMIT 0,80
");
$sth->execute();

/* Fetch all of the remaining rows in the result set */
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

/*** close the database connection ***/
$dbh = null;

 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Export Mysql Table Data to CSV file in PHP</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  

           <div class="container" style="width:900px;">  
                <h2 align="center">Export Mysql Table Data to CSV file in PHP</h2>  
                <h3 align="center">Pi CPU Temperature</h3>                 
                <br />  
                <form method="post" action="exportToCSV.php" align="center">  
                     <input type="submit" name="export" value="CSV Export" class="btn btn-success" />  
                </form>  
                <br />  
                <div class="table-responsive" id="CPUTemperature">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="25%">dateTime</th>  
                               <th width="25%">TValue</th>  
                          </tr>  
                     <?php  
                     foreach ($result as $row): 
                     ?>  
                          <tr>  
                               <td><?php echo $row["dateTime"]; ?></td>  
                               <td><?php echo $row["TValue"]; ?></td>  
                          </tr>  
                     <?php       
                     endforeach
                     ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  