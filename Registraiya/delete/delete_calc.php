<?php
    ob_start();
    session_start();
    include ("../connect.php");
    if (!$_SESSION['user']) {
        header('Location: /');

    }
    //echo $_GET["id_tool"];
    if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id_calc"]))
    {
        $id = $_GET["id_calc"];

        $sql = "DELETE FROM source_data WHERE id = '$id'";
        if(mysqli_query($connect, $sql)){

            header('Location: ../my_calculations.php');
        } else{
            echo "Ошибка: " . mysqli_error($connect);
        }
        mysqli_close($connect);
    }

    ob_end_flush();
?>