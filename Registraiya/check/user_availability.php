<?php
include ("../../connect.php");
//$connect = mysqli_connect('localhost', 'root', '', 'project');

$user_name=$_REQUEST['user_name'];
//echo $user_name;
if((isset($user_name) && !empty($user_name))){
    $sql="SELECT id FROM Users WHERE login = '$user_name'"; 
    $r = mysqli_query($connect,$sql);
    $row = mysqli_fetch_assoc($r);
    $sql_check = mysqli_query($connect,$sql);
    //var_dump($sql_check);
    // узнаем количество строк, если не 0 - логин уже занят
    ;
    //echo $result;
    if($row  > 0)
      {
      //юзер недоступен
      echo "no";
      } 
      else
      {
      
      //доступен
      echo "yes";
      }
   ;
        
    
}else{
    echo "no";
    
}
?>