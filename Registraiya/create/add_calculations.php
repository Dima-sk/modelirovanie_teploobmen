<?php

//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
ob_start();
session_start();
include ("../../connect.php");

    if (!$connect) {
        die('Error connect to DataBase');
    }

if (!$_SESSION['user']) {
    header('Location: /');
    
}
$id_user=$_SESSION['user']['id'];
//var_dump($_POST['id_tool']);
$name_calculations = $_POST['name_calculations'];
$layer_height = $_POST['layer_height'];
$initial_material_temperature = $_POST['initial_material_temperature'];
$initial_gas_temperature = $_POST['initial_gas_temperature'];
$gas_speed = $_POST['gas_speed'];
$average_heat_capacity_of_gas = $_POST['average_heat_capacity_of_gas'];
$material_consumption = $_POST['material_consumption'];
$heat_capacity_of_materials = $_POST['heat_capacity_of_materials'];
$volumetric_heat_transfer_coefficient = $_POST['volumetric_heat_transfer_coefficient'];
$device_diameter = $_POST['device_diameter'];

$sql="INSERT INTO `source_data`( `id_user`,`name_calculations`, `layer_height`, `initial_material_temperature`, `initial_gas_temperature`, 
                                `gas_speed`, `average_heat_capacity_of_gas`, `material_consumption`, `heat_capacity_of_materials`,
                                 `volumetric_heat_transfer_coefficient`, `device_diameter`) 
        VALUES ($id_user,'$name_calculations', $layer_height,$initial_material_temperature,$initial_gas_temperature,
                $gas_speed,$average_heat_capacity_of_gas,$material_consumption,$heat_capacity_of_materials,
                $volumetric_heat_transfer_coefficient,$device_diameter)";

$up = mysqli_query($connect, $sql);
$add_calc=mysqli_insert_id($connect);
echo $add_calc;
$text="Location: ../create_calculations.php?id_calc=.$add_calc.";
//$up=mysqli_query($connect, $sql);
var_dump($up);
 if ($up == true) {
    
    header("Location: ../create/create_calculations.php?id_calc=$add_calc");  
 }

?>