<?php

$hostname = 'Pi2WebServer4G';
$username = 'pi_select';
$password = 'raspberry';
$database = 'db_cpu';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$database", 
                               $username, $password);

    /*** The SQL SELECT statement ***/
    $sth = $dbh->prepare("
       SELECT  `dateTime`,`TValue`
       FROM  `TAB_CPU`
       ORDER BY `dateTime` desc
       LIMIT 0,800
    ");
    $sth->execute();

    /* Fetch all of the remaining rows in the result set */
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);

    /*** close the database connection ***/
    $dbh = null;
    
}
catch(PDOException $e)
    {
        echo $e->getMessage();
        echo "</br>$hostname</br>";
        echo "Darn we need to fix this!";
    }

$json_data = json_encode($result); 

?>

<!DOCTYPE html>
<meta charset="utf-8">
<style> /* set the CSS */

body { font: 12px Arial;}

path { 
    stroke: steelblue;
    stroke-width: 1;
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
<body>

<center><h1> Home office P2WebServer4G CPU temperature</h1></center>

<!-- load the d3.js library -->    
<!--<script src="http://d3js.org/d4.v3.min.js"></script>-->
<script src="http://d3js.org/d3.v3.min.js"></script>

<script>

// Set the dimensions of the canvas / graph
var margin = {top: 30, right: 20, bottom: 30, left: 50},
    width = 1200 - margin.left - margin.right,
//    height = 270 - margin.top - margin.bottom;
    height = 570 - margin.top - margin.bottom;

// Parse the date / time
var parseDate = d3.time.format("%Y-%m-%d %H:%M:%S").parse;

// Set the ranges
var x = d3.time.scale().range([0, width]);
var y = d3.scale.linear().range([height, 0]);

// Define the axes
var xAxis = d3.svg.axis().scale(x)
    .orient("bottom");

var yAxis = d3.svg.axis().scale(y)
//    .orient("right").ticks(20);
//    .orient("left").ticks(5);
        .orient("left");
// Define the line
var valueline = d3.svg.line()
    .x(function(d) { return x(d.dateTime); })
    .y(function(d) { return y(d.TValue); });
    
// Adds the svg canvas
var svg = d3.select("body")
    .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
    .append("g")
        .attr("transform", 
              "translate(" + margin.left + "," + margin.top + ")");

// Get the data
<?php echo "data=".$json_data.";" ?>
data.forEach(function(d) {
	d.dateTime = parseDate(d.dateTime);
//	d.temperature = +d.temperature;
	d.TValue = +d.TValue*(9/5)+32;
});

// Scale the range of the data
x.domain(d3.extent(data, function(d) { return d.dateTime; }));
y.domain([d3.min(data, function(d) { return d.TValue; })-.5, d3.max(data, function(d) { return d.TValue; })]);

// Add the valueline path.
svg.append("path")
	.attr("d", valueline(data));

// Add the X Axis
svg.append("g")
	.attr("class", "x axis")
	.attr("transform", "translate(0," + height + ")")
	.call(xAxis);

// Add the Y Axis
svg.append("g")
	.attr("class", "y axis")
	.call(yAxis);

</script>

<center><h3 id="lastTemp"> </h3></center>

<script>
    document.getElementById("lastTemp").innerHTML = "Last temp " + data[0].TValue + " at " + data[0].dateTime;
</script>
</body>
