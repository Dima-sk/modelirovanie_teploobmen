<?php
    ob_start();
    session_start();
    include ('../connect.php');
    //$connect = mysqli_connect('localhost', 'root', '', 'project');
    if (!$_SESSION['user']) {
        header('Location: /');

    }
    $id_user=$_SESSION['user']['id'];
    //echo($id_user);

?>

<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Профиль</title>
    <meta name="author" content="Dobrovoimaster" />
    <meta name="description" content="Боковая панель с элементами меню, выдвигающаяся по клику, на чистом css, без использлвания javascript" />
    <meta name="keywords" content="боковое меню, выдвижное меню, выдвигающееся по клику, боковая панеь, css3, html, css" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" href="css/style.css">
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400">


    <link rel="stylesheet" href="css/left-nav-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Профиль</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>  
    <!-- CSS only -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
 
    </head>
    

    <?php include ("./header.php") ?>       

<main role="main">
        <article>
            <header>
                <h2 class="header__title">Профиль</h2>
            </header>
            <section>
               <p style="text-align: center;">
               <?php
                   $sql = "SELECT Users.*, Roots.name_root 
                   FROM Users
               INNER JOIN Roots ON Users.id_root=Roots.id
               WHERE Users.id='$id_user'";
                $result=mysqli_query($connect, $sql);
            while($row = mysqli_fetch_assoc($result )) {
                $id_post=$row["id"];
            ?>
               <div class="profile-card">

                    <img src="http://lorempixum.com/160/160/people" alt="">

                    <h1><?php
                    //$var = iconv('windows-1251','UTF-8', $row['fio']);
                     echo $row['fio']?></h1>
                    <h2><?php echo $row['name_root']?></h2>
                </div> <!-- end profile-card -->
                <?php
            }
            ?>
                
        </section>
            <hr>
            <footer>
                <p>сделано с любовью - <a href="#">@skelet</a>
            </footer>
        </article>
    </main>

</body>
</html>
<script>
$("li.post ul").hide();
$("li.post:has('.submenu1')").hover(
  function(){
  $("li.post ul").stop().fadeToggle(300);}
);
$("li.test ul").hide();
$("li.test:has('.submenu2')").hover(
  function(){
  $("li.test ul").stop().fadeToggle(300);}
);


function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}


window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
    var myDropdown = document.getElementById("myDropdown");
      if (myDropdown.classList.contains('show')) {
        myDropdown.classList.remove('show');
      }
  }
}
</script>
<style>

.clas {
	display: inline-block; /*Задаем блочно-строчное отображение*/
}
.field-items{
    width: 690px;
    margin-left: 10px;
}
.string {
    text-align: center; /*Равняем текст по-горизонтали*/
    height: 50px;
    margin: 5px;
}
.nav {
    display: block;
    flex-wrap: wrap;
    padding-left: 12px;
} 
ul a {
  color: #A87B31;
}
.submenu {
  background: #16a085;
}
li a {
  border-bottom: 1px solid rgba(255,255,255,.3);
  color: #dadada;
}


a{
    text-decoration: none;
}
#parent {
  display: flex;
  margin-top: 10px;
}
#narrow {
  width: 18px;
}
#wide {
  flex: 1;
}
.href{
    margin-right: 0em;
    display: flex;
    flex-direction: row-reverse;
    margin-top: -15px;
    border:1;
    background-color: rgba(var(--bs-light-rgb),var(--bs-bg-opacity))!important;
}
body {
	width: 100%;
	font-family: Arial, sans-serif;
}
.wrap {
	margin: 0 auto;

}
#content h2.node-title {
  margin-bottom: 10px;
}
h2 + .info {
  margin-top: 5px;
}
.info {
  padding: 5px;
  background: #f0f0f0;
  margin-bottom: 1em;
  font-size: 0.9em;
  overflow: hidden;
}
.date {
  float: left;
}
.date {
  background: url(http://htmlbook.ru/themes/hb/img/date.png) no-repeat 0 50%;
  padding-left: 24px;
}
.date, .author {
  margin: 0;
}
.author {
  float: right;
}
.node {
    word-wrap: break-word;
    display: flex;
    flex-direction: row;
    align-content: center;
    overflow: hidden;
}
.field{
    word-wrap: break-word;
}
.field-name-field-blog-thumb {
  float: left;
  width: 150px;
}
.node .field-name-body {
  margin-left: 10px;
  margin-top: -15px;
}
p {
  margin: 1em 0;
}
a.ext {
  background: url(http://htmlbook.ru/themes/hb/img/blank.png) 100% 4px no-repeat;
  padding-right: 14px;
}
a {
  color: #1D67A4;
}
@media screen and (max-width: 1280px) { 
    div.contentblock {width: 1200px;
    } 
} @media screen and (max-width: 1140px) { 
    div.contentblock {
        width: 1024px;
    } 
} 
@media screen and (max-width: 480px) {
    html .info {
       -webkit-text-size-adjust: none;
    }
    #main-nav a {
       font-size: 90%;
       padding: 10px 8px;
    }
    .wrap{
        width: 301px;
    }
 }
</style>