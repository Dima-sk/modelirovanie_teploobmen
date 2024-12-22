<?php
    ob_start();
    session_start();
    include ("../connect.php");
    if (!$_SESSION['user']) {
        header('Location: /');

    }
    $id_root=$_SESSION['user']['id_root'];
        if(($id_root=='3' || $id_root=='2')){
          header('Location: profile.php');
        }
    //echo($id_user);
    if((isset($_REQUEST['search_post']) && !empty($_REQUEST['search_post']))){
      $inputPost = $_REQUEST['search_post'];
        $sql = "SELECT Users.*, Roots.name_root 
                    FROM Users
                    INNER JOIN Roots ON Users.id_root=Roots.id
                    WHERE Users.fio LIKE'$inputPost%'";
    }else{
        $sql = "SELECT Users.*, Roots.name_root 
                    FROM Users
                    INNER JOIN Roots ON Users.id_root=Roots.id";
    }
    // $sql = "SELECT Users.id, Users.fio, Users.id_root, Roots.id, Roots.name_root
    //             FROM Users 
    //             INNER JOIN Roots ON Users.id_root = Roots.id";
    
    $result=mysqli_query($connect, $sql);
?>
<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8">
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
    
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Пользователь</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="edit/up_user.php" method="post" class="registr"  style="border:2px solid #555; border-radius:5px;margin:10px; padding:10px;" autocomplete="off">
                                <input type="hidden" class="userId" name="id" id="uid" >
                                <p>ФИО:
                                <input class="form-control" type="text" onkeyup='checkParams()' pattern=".{8,40}" id="fio" name="fio" required="" value='<?php echo $row['fio']?>' /></p>
                                <p>Права:
                                <?php
                                        $query="SELECT * FROM Roots";
                                        $result_select=mysqli_query($connect, $query);
                                        /*Выпадающий список*/
                                        echo "<select id='id_root' name='id_root'>";
                                        while($row = mysqli_fetch_assoc($result_select)){?>
                                            <option  value="<?=$row['id']?>"><?=$row['name_root']?></option>
                                            <?php
                                        }
                                        echo "</select>";
                                    ?>
                                <p>Логин:
                                <input class="form-control" type="text" onkeyup='checkParams()' id="login" name="login"  value="<?php echo $row["login"]?>">
                                <p>Пароль:
                                <input class="form-control" type="password" onkeyup='checkParams()' id="password" name="password" value="<?php echo $row["login"]?>">
                                    <br>
                                    <div class="href">
                                        <input class="btn btn-outline-primary btn-sm" style="background-color: #0052eede" name="submit" type='submit' value='Сохранить'>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary btn-sm" style="background: #6c757d;" data-bs-dismiss="modal">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>

<main role="main">
        <article>
            <header>
                <h1 class="header__title">Таблица пользователей</h1>
                <br>
            </header>
            <section>
            <table class="table table-hover">
            <thead class="table-dark">
                <tr style="--bs-table-bg: #16a085;">
                    <th>ФИО</th>
                    <th>Права</th>
                    <th>Логин</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
               <?php
               $result=mysqli_query($connect, $sql);
            while($row = mysqli_fetch_assoc($result)) {
            ?>
               <form>
                <tr data-user-id="<?=$row['id']?>">
                    <td class="id_root" hidden><?php echo $row["id_root"]?></td>
                    <td class="fio"><?php echo $row["fio"]?></td>
                    <td class="name_root"><?php echo $row["name_root"]?></td>
                    <td class="login" ><?php echo $row["login"]?></td>
                    <?php  echo "<td><a class='btn btn-outline-primary btn-sm up' style='background-color: #0052eede' data-bs-toggle='modal' href='#myModal'>Обновить данные</a></td>";?>
                    <?php  echo "<td><a class='btn btn-danger btn-sm' onclick='return confirmation()' href='./delete/del_user.php?id=" . $row["id"] . "'>Удалить данные</a></td>";?>
                </tr>
                </form>
            </tbody>
                <?php
            }
            ?> 
        </section>
            
            <footer>
                <p>сделано с любовью - <a href="#">@skelet</a>
            </footer>
            <hr>
        </article>
    </main>

</body>
</html>
<script>
    var $editRow = null;

$(".up").click(function(e){
    $editRow = $(this).closest("tr");
    
    $("#uid").val($editRow.data('user-id'));
    $("#fio").val($editRow.find(".fio").text());
    $("#id_root").val($editRow.find(".id_root").text());
    $("#login").val($editRow.find(".login").text());
    $("#password").val($editRow.find(".login").text());
    
    $("#myModal").modal('show');
});

function confirmation() {
    return confirm('Точно удалить?');
}

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
section{
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    flex-direction: column-reverse;
}
.btn-primary {
    border: 2px solid #2BBBAD;
    color: white;
}
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