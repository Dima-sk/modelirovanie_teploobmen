<?php
    ob_start();
    session_start();
    include ("../connect.php");
    if (!$_SESSION['user']) {
        header('Location: /');

    }
    $id_user=$_SESSION['user']['id'];
    //echo($id_user);
    
    if((isset($_REQUEST['search_post']) && !empty($_REQUEST['search_post']))){
      $inputPost = $_REQUEST['search_post'];
      $sql = "SELECT users_tools.*,tools.name_tool  FROM users_tools 
                  INNER JOIN tools ON users_tools.id_tool=tools.id
                  WHERE name_tool LIKE'$inputPost%' AND  id_user ='$id_user'";
    }else{
        $sql = "SELECT source_data.*,Users.fio  FROM source_data 
                    INNER JOIN Users ON source_data.id_user=Users.id
                    WHERE id_user ='$id_user'";
    }
    // $sql = "SELECT Users.id, Users.fio, Users.id_root, Roots.id, Roots.name_root
    //             FROM Users 
    //             INNER JOIN Roots ON Users.id_root = Roots.id";
    
    $result=mysqli_query($connect, $sql);
    
?>
<!DOCTYPE html>
<html >
<head>
    <meta http-equiv="content-type" content="text/html; charset=windows-1251" />
<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Главная</title>
    <meta name="author" content="Dobrovoimaster" />
    <meta name="description" content="Боковая панель с элементами меню, выдвигающаяся по клику, на чистом css, без использлвания javascript" />
    <meta name="keywords" content="боковое меню, выдвижное меню, выдвигающееся по клику, боковая панеь, css3, html, css" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/left-nav-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Главная</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>  
    <!-- CSS only -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
 
    </head>
    

    <?php include ("./header.php") ?>          
   
<main role="main">
        <article>
            <header>
                <h1 class="header__title">Мои расчеты</h1>
            </header>
            <section>
               <?php
               $result=mysqli_query($connect, $sql);
               //var_dump($result);
            while($row = mysqli_fetch_assoc( $result)) {
                $id_tool=$row["id"];
            ?>
               <div class="wrap">
                <div class="block_content">
                    <h2 class="node-title"><?php  echo $row['name_calculations'];?></h2>
                    <div class="info">
                    <?php echo "<a class='btn btn-primary'style='color: #ffffff!important;' 
                    href='./edit_calculations.php?id_calc=".$id_tool."'>"?>Изменить исходные данные</a>
                    <!-- <?php echo "<a class='btn btn-primary'style='color: #ffffff!important;' 
                    href='./create/create_calculations.php?id_calc=".$id_tool."'>"?>Рассчитать</a> -->
                    <?php echo "<a class='btn btn-info btn-sm'style='color: #ffffff!important;' 
                    href='./view_graphs.php?id_calc=".$id_tool."'>"?>Посмотреть графики</a>
                    <br>
                    <?php echo "<a class='btn btn-danger btn-sm'style='color: #ffffff!important;' 
                    href='./delete/delete_calc.php?id_calc=".$id_tool."'>"?>Удалить расчет</a>
                    <!-- <a  href="vendor/logout.php" class="btn btn-danger btn-sm" style="color: #ffffff!important;">Вернуть</a> -->
                    </div>
                    
                </div>
                </div>
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
var $editRow = null;

$(".signature").click(function(e){
    $editRow = $(this).closest("tr");
    
    $("#uiidd").val($editRow.data('user-id'));

    $("#myModal4").modal('show');
});




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
main{
  max-width: 900px;
}
section{
  text-align: center;
  display: grid;
  grid-template-columns: 400px 400px ;
}
.info{
  display:grid;
  text-align: center;
}

.field-item even w{
  padding-left: 157px; 
  margin-bottom: 85px;
}
.clas {
	display: inline-block; /*Задаем блочно-строчное отображение*/
}
.field-items{
    /* width: 690px; */
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
	width: 300px;
	margin: 0 auto;

}
#content h2.node-title {
  margin-bottom: 10px;
}
h2 + .info {
  margin-top: 5px;
}
.info {
  text-align: center;
  padding: 5px;
  background: #f0f0f0;
  margin-bottom: 1em;
  font-size: 0.9em;
  overflow: hidden;
}

.date {
  background: url(http://htmlbook.ru/themes/hb/img/date.png) no-repeat 0 50%;
  padding-left: 24px;
}
.date, .author {
  margin: 0;
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
  float: none;
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
    .field-item even w{
      padding-left: 0px; 
      margin-bottom: 85px;
    }
    .field field-name-field-blog-thumb field-type-image field-label-hidden{
      width:0px;
    }
 }
</style>