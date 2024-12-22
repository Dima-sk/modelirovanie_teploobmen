<?php ob_start();

    session_start();
    require_once 'connect.php';

        //echo "регистрация через форму";
        if (isset($_REQUEST['doGo'])) {
            // Все последующие проверки, проверяют форму и выводят ошибку
            // Проверка на совпадение паролей
            if ($_REQUEST['pass'] !== $_REQUEST['pass_rep']) {
                $error = 'Пароль не совпадает';
            }
            
            // Проверка есть ли вообще повторный пароль
            if (!$_REQUEST['pass_rep']) {
                $error = 'Подтвердите пароль';
            }
            if (!$_REQUEST['fio']) {
                $error = 'Введите пароль';
            }
            // Проверка есть ли пароль
            if (!$_REQUEST['pass']) {
                $error = 'Введите пароль';
            }
         
            // Проверка есть ли логин
            if (!$_REQUEST['username']) {
                $error = 'Введите login';
            }
            $user_name=$_REQUEST['username'];
            $sql="SELECT id FROM Users WHERE login = '$user_name'"; 
            //echo $sql;
            $r = mysqli_query($connect,$sql);
            var_dump($r);
            if (!empty($r) && $r->num_rows > 0) {
                $error = 'Этот login недоступен';
            }
            // Если ошибок нет, то происходит регистрация 
            if ((!isset($error) && empty($error))) {
                $login = $_REQUEST['username'];
                $fio= $connect->real_escape_string($_REQUEST["fio"]);
                //$fio=iconv('windows-1251','UTF-8',$_REQUEST['fio']);
                //echo $fio;
                $pass = $_REQUEST['pass'];
                // Пароль хешируется
                $pass = password_hash($_REQUEST['pass'], PASSWORD_DEFAULT);
                //echo $pass;
                $sql="INSERT INTO users( fio, login, password, id_root) 
                VALUES ('$fio','$login','$pass','2')";
                //echo $sql;
                $up=mysqli_query($connect, $sql);
                //var_dump($up);
                if ($up==true) {
                        
                    mysqli_query($connect, $query);
                        header('Location: ../login.php');
                }
            } else {
                // Если ошибка есть, то выводить её 
                echo $error; 
                 ?>
                 <script type="text/javascript">
                         //location="../register.php";
                 </script>
                 <?php
             }
        }
        
ob_end_flush();
?>