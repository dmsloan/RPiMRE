
<!DOCTYPE html>

<meta charset="utf-8">
<style>
    /* set the CSS */

    body {
        font: 12px Arial;
    }

    path {
        stroke: steelblue;
        stroke-width: 2;
        fill: none;
    }

    .axis path,
    .axis line {
        fill: none;
        stroke: grey;
        stroke-width: 1;
        shape-rendering: crispEdges;
    }
</style>
<html>

<body>

    <center>
        <h1> Home CPU temperature</h1>
    </center>

    <!-- load the d3.js library -->
    <!--<script src="http://d3js.org/d4.v3.min.js"></script>-->
    <script src="http://d3js.org/d3.v3.min.js"></script>

    <?php
$hostname = 'Pi2WebServer4G';
$username = 'pi';
$password = 'raspberry';
$database = 'db_cpu';

//try {
    echo "Hello World\n";
//    db = MySQLdb.connect('Pi2WebServer4G', 'root', 'raspberry', 'db_cpu');

//    $dbh = new PDO("mysql:host=$hostname;dbname=$database", 
//                               $username, $password);

//     /*** The SQL SELECT statement ***/
//     $sth = $dbh->prepare("
//        SELECT  `TValue`, `T_Date`
//        FROM  `TAB_CPU`
//        ORDER BY `T_Date` DESC
//        LIMIT 0,8000
//     ");
//     $sth->execute();

//     /* Fetch all of the remaining rows in the result set */
//     $result = $sth->fetchAll(PDO::FETCH_ASSOC);

//     /*** close the database connection ***/
//     $dbh = null;
    
// }
//catch(Exception $e)
 // catch(PDOException $e)
//     {
//        echo 'Caught exception: ',  $e->getMessage(), "\n";
//         echo $e->getMessage();
//     }

// $json_data = json_encode($result); 

?>

</body>

</html>