<?php
    ob_start();
    session_start();
    include ("../connect.php");
    if (!$_SESSION['user']) {
        header('Location: /');

    }
    if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"]))
    {
        //$id = mysqli_real_escape_string($connect, $_GET["id"]);
        $id= $_GET["id"];
        echo $id;
        $sql = mysqli_query($connect, "SELECT * FROM Users WHERE id='$id'"); 
        if(mysqli_fetch_array($sql) > 0){
            foreach($sql as $row){
                $id = $row["id"];
             };
        if (!$connect) {
            die("Ошибка: " . mysqli_error($connect));
        }
        $sql = "DELETE FROM Users WHERE id = '$id'";
        if(mysqli_query($connect, $sql)){

            header('Location: ../users.php');
        } else{
            echo "Ошибка: " . mysqli_error($connect);
        }
        mysqli_close($connect);
    }
}
    ob_end_flush();
    ?>
?>