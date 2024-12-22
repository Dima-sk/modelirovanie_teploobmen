<?php
ob_start();

session_start();
include ("../connect.php");

$id_user=$_SESSION['user']['id'];

if(isset($_POST['submit']))
{
        $id = $_POST["id"];
        $fio = $_POST["fio"];
        $id_root = $_POST['id_root'];
        $login = $_POST['login'];
        $password = $_POST['password'];
        
        if($login === $password){
            $sql = "UPDATE Users SET fio='$fio',
                        login='$login',id_root='$id_root'
                    WHERE id='$id'";
        }else{
            $hash=password_hash($password, PASSWORD_BCRYPT);
            $sql = "UPDATE Users SET fio='$fio',
                        login='$login',password='$hash', id_root='$id_root' 
                    WHERE id='$id'";
            }
            if($result = mysqli_query($connect, $sql)){
                ?>
                <script type="text/javascript">
                    location="../users.php";
                </script>
            <?php
            } else{
                echo "Ошибка: " . mysqli_error($connect);
                ?>
                <a href="../users.php">На главную </a>
                <?php
            }
}
mysqli_close($connect);
?>