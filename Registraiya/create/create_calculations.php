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
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id_calc"]))
    {
        $id_calc=$_GET["id_calc"];
        $calc = mysqli_query($connect, "
        SELECT * FROM source_data
        WHERE id='$id_calc'
        "); 
    $calcs=mysqli_fetch_assoc($calc);
    //$id_user=$_SESSION['user']['id'];
    //var_dump($calcs);
    $layer_height = $calcs['layer_height'];
    $initial_material_temperature = $calcs['initial_material_temperature'];
    $initial_gas_temperature = $calcs['initial_gas_temperature'];
    $gas_speed = $calcs['gas_speed'];
    $average_heat_capacity_of_gas = $calcs['average_heat_capacity_of_gas'];
    $material_consumption = $calcs['material_consumption'];
    $heat_capacity_of_materials = $calcs['heat_capacity_of_materials'];
    $volumetric_heat_transfer_coefficient = $calcs['volumetric_heat_transfer_coefficient'];
    $device_diameter = $calcs['device_diameter'];
  
    $d=$device_diameter/2;

    $m=$heat_capacity_of_materials*$material_consumption/($gas_speed*$average_heat_capacity_of_gas*3.14*$d*$d);

    $coord = 0.0;
    $arrayY = array();
    do{
        //echo $coord;
        $Y=$coord*$volumetric_heat_transfer_coefficient/$gas_speed/$average_heat_capacity_of_gas/1000;
        // $array = array(
            
        //      "Y$coord" => $Y,
        //  );
        array_push($arrayY,round($Y, 5) );


        $coord=$coord+0.5; 
        //echo "<br>"; 
    }
    while ($coord <= 3);

    $arrayEXP1 = array();
    $arrayEXP2 = array();
    for ($i = 0; $i < count($arrayY); $i++) {
        
        $exp1=1-EXP(-(1-$m)*$arrayY[$i]/$m);
        $exp2=1-$m*EXP(-(1-$m)*$arrayY[$i]/$m);
        array_push($arrayEXP1,round($exp1,5) );
        array_push($arrayEXP2,round($exp2,5) );
    }
    $arrayO = array();
    $array0 = array();
    for ($i = 0; $i < count($arrayY); $i++) {
        
        $O=$arrayEXP1[$i]/$arrayEXP2[6];
        $a0=$arrayEXP2[$i]/$arrayEXP2[6];
        array_push($arrayO,round($O,5) );
        array_push($array0,round($a0,5) );
    }
    $arrayt = array();
    $arrayT = array();
    $arrayRaz = array();
    for ($i = 0; $i < count($arrayY); $i++) {
        
        $t=$initial_material_temperature+($initial_gas_temperature-$initial_material_temperature)*$arrayO[$i];
        $T=$initial_material_temperature+($initial_gas_temperature-$initial_material_temperature)*$array0[$i];
        $Raz=$t-$T;
        array_push($arrayt,round($t,5) );
        array_push($arrayT,round($T,5) );
        array_push($arrayRaz,round($Raz,5) );
    }
    
    
    // var_dump( $arrayY);
    // echo "<br>"; 
    // echo "<br>"; 
    // var_dump( $arrayEXP1);
    // echo "<br>"; 
    // echo "<br>"; 
    // var_dump( $arrayEXP2);
    // echo "<br>"; 
    // echo "<br>"; 
    // var_dump( $arrayO);
    // echo "<br>"; 
    // echo "<br>"; 
    // var_dump( $array0);
    // echo "<br>"; 
    // echo "<br>"; 
    // var_dump( $arrayt);
    // echo "<br>"; 
    // echo "<br>"; 
    // var_dump( $arrayT);
    // echo "<br>"; 
    // echo "<br>"; 
    // var_dump( $arrayRaz);
    
    $jsonY =json_encode((object)$arrayY,JSON_UNESCAPED_UNICODE);
    $jsonY = nl2br("$jsonY");
    $jsonEXP1 =json_encode((object)$arrayEXP1,JSON_UNESCAPED_UNICODE);
    $jsonEXP1 = nl2br("$jsonEXP1");
    $jsonEXP2 =json_encode((object)$arrayEXP2,JSON_UNESCAPED_UNICODE);
    $jsonEXP2 = nl2br("$jsonEXP2");
    $jsonO =json_encode((object)$arrayO,JSON_UNESCAPED_UNICODE);
    $jsonO = nl2br("$jsonO");
    $json0 =json_encode((object)$array0,JSON_UNESCAPED_UNICODE);
    $json0 = nl2br("$json0");
    $jsont =json_encode((object)$arrayt,JSON_UNESCAPED_UNICODE);
    $jsont = nl2br("$jsont");
    $jsonT =json_encode((object)$arrayT,JSON_UNESCAPED_UNICODE);
    $jsonT = nl2br("$jsonT");
    $jsonRaz =json_encode((object)$arrayRaz,JSON_UNESCAPED_UNICODE);
    $jsonRaz = nl2br("$jsonRaz");

    $sql="INSERT INTO `calculations`( `id_source_data`, `Y`, `EXP1`, `EXP2`, `O`, `0`, `temp`, `T`, `raz`) 
            VALUES ('$id_calc','$jsonY','$jsonEXP1','$jsonEXP2','$jsonO','$json0','$jsont','$jsonT','$jsonRaz')";
    //echo $sql;
    $up = mysqli_query($connect, $sql);
    var_dump($up);
    if ($up == true) {
        header('Location: ../my_calculations.php');  
    }

    // var_dump( $jsonY);
    // echo "<br>"; 
    // echo "<br>"; 
    // var_dump( $jsonEXP1);
    // echo "<br>"; 
    // echo "<br>"; 
    // var_dump( $jsonEXP2);
    // echo "<br>"; 
    // echo "<br>"; 
    // var_dump( $jsonO);
    // echo "<br>"; 
    // echo "<br>"; 
    // var_dump( $json0);
    // echo "<br>"; 
    // echo "<br>"; 
    // var_dump( $jsont);
    // echo "<br>"; 
    // echo "<br>"; 
    // var_dump( $jsonT);
    // echo "<br>"; 
    // echo "<br>"; 
    // var_dump( $jsonRaz);
}

?>