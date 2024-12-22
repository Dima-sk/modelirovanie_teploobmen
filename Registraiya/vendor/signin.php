<?php ob_start();

    session_start();
    require_once 'connect.php';



    if (isset($_POST['sublogin']))
    {
        

        $Login = $_POST['Login'];
        $Password = $_POST['Password'];
        //запрос на подключнеие в бд
        $check_user = mysqli_query($connect, "SELECT * FROM `Users` 
            WHERE `login` = '$Login'");


        if (mysqli_num_rows($check_user) >= 0) 
        {
            $user = mysqli_fetch_assoc($check_user);
            var_dump(password_verify($Password, $user['password']));
            if (password_verify($Password, $user['password']))
            {
                echo $Login;
                {
                    $_SESSION['user'] = [
                        "id" => $user['id'],
                    ];

                // bin2hex преобразует бинарнае данные в 16-и ричное представление 
                //openssl_random_pseudo_bytes — Генерирует псевдослучайную последовательность байт
                $bytes=bin2hex(openssl_random_pseudo_bytes(20));
                $query="UPDATE users SET Token='$bytes' 
                        WHERE login='$Login'";

                mysqli_query($connect, $query);
                header('Location: ../profile.php');
                }
            }
        
            else 
            {
                $_SESSION['message'] = 'Не верный логин или пароль';
                header('Location: ../login.php');
            }
        }


    } 

   
    
    
    ob_end_flush();
    ?>