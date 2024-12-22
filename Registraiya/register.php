<?php
session_start();

if (!empty($_SESSION['user'])) {
    header('Location: profile.php');
}
include ("../connect.php");

    if (!$connect) {
        die('Error connect to DataBase');
    }
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
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
  <style type="text/css" id="operaUserStyle"></style>
</head>
  <body class="text-center">
    
    <main class="form-signin">
      <form action="vendor/signup.php" method="post" class="form" >
        <h1 class="h3 mb-3 fw-normal">Регистрация</h1>
        <span id="msgbox" style="display:none; margin-top: 12px; margin-left: 156px;"></span>
            <div class="form-floating">
            <input type="login" class="form-control" id="username" name="username" pattern=".{4,16}"pattern="^[a-zA-Z1-9]+$"  required placeholder="login">
            <label for="floatingInput">Логин(латинские буквы, не менее 4)</label>
            </div>
            <div class="form-floating">
            <input type="text" class="form-control" id="fio"  name="fio"required  placeholder="fio" >
            <label for="floatingInput">ФИО(только русские буквы)</label>
            </div>
            <div class="form-floating">
            <input type="password" class="form-control" id="password" pattern=".{8,12}" name="pass"required style="margin-bottom: 0px;"placeholder="password">
            <label for="floatingPassword">Пароль(от 8 до 12)</label>
            </div>
            <div class="form-floating">
            <input type="password" class="form-control" id="password" pattern=".{8,12}" name="pass_rep" required placeholder="password">
            <label for="floatingPassword">Подтвердить</label>
            </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="doGo">Войти</button>
      </form>

      <label>Есть профиль</label><br>
      <a href="login.php">Авторизоваться</a>
    </main>
</body>
</html>
<script src="jquery.js" type="text/javascript" language="javascript"></script>
    <script language="javascript">
      $(document).ready(function()
{
	$("#username").blur(function()
	{
		//$("#msgbox").removeClass().addClass('messagebox').text('Проверка...').fadeIn("slow");
		//var user_name = document.querySelector("input[name='username']").value;
            //console.log(user_name);
            //console.log($.post("user_availability.php",{ login:$(this).val() })); 
      $("#msgbox").removeClass().addClass('messagebox').text('Проверка...').fadeIn("slow");
      var value = document.querySelector("input[name='username']").value;
      console.log($.post("check/user_availability.php",{ user_name:value }));
      $.post("check/user_availability.php",{ user_name:value } ,function(data)
          {
        if(data =='no') 
        {
          $("#msgbox").fadeTo(200,0.1,function() 
        { 
          $(this).html('Этот логин не доступен').addClass('messageboxerror').fadeTo(900,1);
        });		
            }
        else
        {
          $("#msgbox").fadeTo(200,0.1,function()  
        { 
          $(this).html('Логин доступен для регистрации').addClass('messageboxok').fadeTo(900,1);	
        });
        }
          
          });
 
	});
});


</script>
<style>
.messagebox{
 position:absolute;
 width:100px;
 margin-left:30px;
 border:1px solid #c93;
 background:#ffc;
 padding:3px;
}
.messageboxok{
 position:absolute;
 width:auto;
 margin-left:30px;
 border:1px solid #349534;
 background:#C9FFCA;
 padding:3px;
 font-weight:bold;
 color:#008000;
}
.messageboxerror{
 position:absolute;
 width:auto;
 margin-left:30px;
 border:1px solid #CC0000;
 background:#F7CBCA;
 padding:3px;
 font-weight:bold;
 color:#CC0000;
}

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