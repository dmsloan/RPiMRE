<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Debugging</title>
    </head>
    <body>
        <?php
        $number = 99;
        $string = "Ralph";
        $ages = array(4, 8, 16, 23, 42);
        $array = array(1 => "Homepage", 2 => "About Us", 3 => "Services");

        echo "<br />";

        echo $string . "<br /><br />";     // output variable value for testing
        echo "This is print_r: ";
        print_r($ages);
        echo "<br /><br />"; // print readable array
        echo "This is gettype for a var: " . gettype($string) . "<br /><br />";
        echo "This is gettype for an array: " . gettype($ages);
        echo "<br /><br />";
        echo "This is var_dump for two arrays: ";
        var_dump($array, $ages);
        echo "<br /><br />";
        echo "This is var_dump for a string: ";
        var_dump($string);
        echo "<br /><br />";
        echo "This is var_dump for a number: ";
        var_dump($number);
        echo "<br /><br />";
        ?>

        <pre>
<?php
echo "This is get_defined_vars with 'pre' tags: ";
print_r(get_defined_vars());
echo "<br /><br />";
echo "This is deug_backtrace: ";
print_r(get_defined_vars());
echo "<br /><br />";
?>
        </pre>
    </body>
</html>
