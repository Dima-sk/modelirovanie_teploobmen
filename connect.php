<?php
$connect = mysqli_connect('MySQL-8.2', 'root', '', 'program');
    //$connect = mysqli_connect('localhost', 'root', '', 'project');

    if (!$connect) {
        die('Error connect to DataBase');
    }

//phpinfo()
// $serverName = "DESKTOP-UGKRR2M"; //serverName\instanceName

// // Since UID and PWD are not specified in the $connectionInfo array,
// // The connection will be attempted using Windows Authentication.
// $connectionInfo = array( "Database"=>"project");
// $connect = sqlsrv_connect( $serverName, $connectionInfo);

if (!$connect) {
    die('Error connect to DataBase');
}
?>