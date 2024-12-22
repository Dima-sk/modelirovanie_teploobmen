<?php
ob_start();

session_start();
include ("../connect.php");

$id_user=$_SESSION['user']['id'];

if(isset($_POST['submit']))
{
    $id=$_POST['id'];
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
    $sql="UPDATE `source_data` SET `name_calculations`='$name_calculations',
                 `layer_height`=$layer_height,`initial_material_temperature`=$initial_material_temperature,
                 `initial_gas_temperature`=$initial_gas_temperature,`gas_speed`=$gas_speed,
                 `average_heat_capacity_of_gas`=$average_heat_capacity_of_gas,`material_consumption`=$material_consumption,
                 `heat_capacity_of_materials`=$heat_capacity_of_materials,`volumetric_heat_transfer_coefficient`=$volumetric_heat_transfer_coefficient,
                 `device_diameter`=$device_diameter WHERE `id`=$id";
    
            if($result = mysqli_query($connect, $sql)){

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
    $sql="UPDATE `calculations` SET 
    `Y`= '$jsonY',`EXP1`= '$jsonEXP1',`EXP2`= '$jsonEXP2',`O`= '$jsonO',
    `0`= '$json0',`temp`= '$jsont',`T`= '$jsonT',`raz`= '$jsonRaz' 
    WHERE id_source_data=$id";
    echo $sql;
    $up = mysqli_query($connect, $sql);
    var_dump($up);
    if ($up == true) {
        header('Location: ../my_calculations.php');  
    }
            

            } else{
                echo "Ошибка: " . mysqli_error($connect);
                ?>
                <a href="../my_calculations.php">На главную </a>
                <?php
            }
}
mysqli_close($connect);
?>