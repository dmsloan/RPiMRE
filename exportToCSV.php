<?php
    //exportToCSV.php
    // the following block exports the data to a csv file that can be imported to excel
    // the contents of the file are ereased first

if(isset($_POST["export"]))  
{  
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

    
    echo "The result is:<br><br>";
    echo "The final result is:".print_r(array_values($result))."<br><br>";

    echo "The array keys are:<br><br>";
    echo print_r(array_keys($result[0]))."<br><br>";

    echo "The output for the foreach is:<br><br>";
    foreach($result as $row)       
    {  
         echo print_r($row);  
    }       
    
    
// the following block exports the data to a csv file that can be imported to excel
// the contents of the file are ereased first
header("Content-type: text/csv");       
header("Content-Disposition: attachment; filename=$filename");       
$output = fopen($filename, "w");       
$header = array_keys($result[0]);       
fputcsv($output, $header);
fputcsv($output,"test");       
foreach($result as $row)       
{  
     fputcsv($output, $row);  
}       
fclose($output);  


}  
?>