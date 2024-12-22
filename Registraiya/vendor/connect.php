<?php
$connect = mysqli_connect('MySQL-8.2', 'root', '', 'program');
    //$connect = mysqli_connect('localhost', 'root', '', 'project');

    if (!$connect) {
        die('Error connect to DataBase');
    }

?>