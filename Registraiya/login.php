<?php
session_start();
include ("../connect.php");
if (!empty(($_SESSION['user']))) {
    header('Location: profile.php');
}
//$connect = mysqli_connect('localhost', 'u1945222_default', '4jAc2Jlc3F7TRaE2', 'u1945222_default');
//$connect = mysqli_connect('localhost', 'root', '', 'project');
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Марк Отто, Джейкоб Торнтон и контрибьюторы Bootstrap">
    <meta name="generator" content="Hugo 0.80.0">

    <link rel="canonical" href="https://getbootstrap.su/docs/5.0/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="assets/signin.css" rel="stylesheet">
  <style type="text/css" id="operaUserStyle"></style></head>
  <body class="text-center">
    
    <main class="form-signin">
    <form action="vendor/signin.php" method="post" class="form" >
        <!-- <img class="bd-placeholder-img-lg" style="width: 295px;"src="./logos.jpg"> -->
        <h1 class="h3 mb-3 fw-normal">Пожалуйста, войдите</h1>
        
            <div class="form-floating">
            <input type="login" class="form-control" id="login" name="Login" placeholder="login">
            <label for="floatingInput">Логин</label>
            </div>
            <div class="form-floating">
            <input type="password" class="form-control" id="password" name="Password" placeholder="Password">
            <label for="floatingPassword">Пароль</label>
            </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="sublogin">Войти</button>
        <?php
            if (!empty($_SESSION['message'])) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
      </form>
      <label>Нет профиля</label><br>
      <a href="register.php">Зарегистрироваться</a>
    </main>
    
    
        
      
    
    </body>
</body>
</html>
<style>
    html,
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

</style>