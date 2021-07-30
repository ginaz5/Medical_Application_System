
<?php
    header("Content-Type:text/html; charset=utf-8");
    $serverName = "GINALIN7DF1\SQLEXPRESS";
    $connectionInfo = array("Database"=>"Final_Project", "UID"=>"Final", "PWD"=>"200628", "CharacterSet"=>"UTF-8");
    $conn = sqlsrv_connect($serverName,$connectionInfo);
    /*
        if($conn){
            echo"Connect Database Successfully!";
        }else{
            echo"Error!!!";
            die(print_r(sqlsrv_errors(),true));
        }
    */
?>