<!DOCTYPE html>
<html >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="content-type" content="text/html; charset=windows-1251" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/left-nav-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<?php
header("Content-Type: text/html;charset=utf-8");
//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include ("../connect.php");
    $id=$_SESSION['user']['id'];

                    $fio = mysqli_query($connect, "
                    SELECT Users.* , Roots.name_root FROM Users
	                INNER JOIN Roots ON Users.id_root=Roots.id
                    WHERE Users.id='$id'
                    "); 
                    while ($Name=mysqli_fetch_assoc($fio)) {
                        //$var = iconv('windows-1251','UTF-8', $Name['fio']);
                        echo '<div class="href" style="color: #0d6efd; margin-top: 5px" >'.$Name['fio'].'</div>';
?>

</head>
<form>
            <p style="display: block;  text-align: right; margin-top: -15px">

                
            </p>
            <div class="href">
                <div><a  href="vendor/logout.php" class="btn btn-secondary btn-sm" style="color: #ffffff!important;">Выход</a></div>
            </div>
        </form>

        <body class="bg-light bg-gradient">
        <input type="checkbox" id="nav-toggle" hidden>
        <nav class="nav">

        <label for="nav-toggle" class="nav-toggle" onclick></label>
        <h2 class="logo"> 
            <a href="./profile.php">ras4etka.ru</a>
            <!-- <form>
                <?php
                if(!empty($inputPost)){
                ?>
                <div id="parent">
                    <div id="wide"><input type="text" name="search_post" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="<?php echo $inputPost;?>"></div>
                    <div id="narrow"><input type="submit" name="search" value="Поиск" class="btn btn-secondary btn-sm" style="margin: 4px; color: #dadada!important;"onclick="location.href='./profile.php?search_post=<?=$inputPost?>'"> </div>
                </div>
                <?php
                }else{
                ?>
                <div id="parent">
                    <div id="wide"><input type="text" name="search_post" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" ></div>
                    <div id="narrow"><input type="submit" name="search" value="Поиск" class="btn btn-secondary btn-sm" style="margin: 4px; color: #dadada!important;"onclick="location.href='./profile.php?search_post='"> </div>
                </div>
                <?php
                }
                ?>
            </form> -->
        </h2>
        <ul>
            <li><a href="profile_user.php">Профиль</a>
            <li><a href="my_calculations.php">Мои расчеты</a>
            <?php
                    if($Name['id_root']==1){
            ?>
            <li><a href="users.php">Пользователи</a>
            <?php }
            ?>
            
        </ul>
    </nav>
    <?php }
    ?>
<style>
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
	width: 980px;
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
    .field-item even w{
      padding-left: 0px; 
      margin-bottom: 85px;
    }
    .field field-name-field-blog-thumb field-type-image field-label-hidden{
      width:0px;
    }
 }
</style>