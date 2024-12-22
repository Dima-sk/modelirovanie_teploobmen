<?php
    ob_start();
    session_start();
    include ("../connect.php");
    if (!$_SESSION['user']) {
        header('Location: /');

    }
    $id_user=$_SESSION['user']['id'];
    $id_calc=$_GET['id_calc'];
    //echo($id_user);
    
    
    $sql = "SELECT calculations.*,Users.fio,source_data.*  FROM calculations 
    INNER JOIN source_data ON calculations.id_source_data=source_data.id
    INNER JOIN Users ON source_data.id_user=Users.id
    WHERE id_user ='$id_user'AND id_source_data='$id_calc'";

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
    <script src="./JS_Lib/jquery.min.js" type="text/javascript"></script>
    <script src="./JS_Lib/highcharts.js" type="text/javascript"></script>
    <script src="https://cdn.anychart.com/js/latest/anychart-bundle.min.js"></script>
 
    </head>
    

    <?php include ("./header.php") ?>          
   
<main role="main">
        <article>
        <?php
               $result=mysqli_query($connect, $sql);
               //var_dump($result);
            $row = mysqli_fetch_assoc( $result);
                //$id_tool=$row["id"];
            ?>
            <header>
                <h1 class="header__title"><? echo $row["name_calculations"]; ?></h1>
            </header>
            <section>
            
            <table style="border: 1px solid rgb(0, 0, 0);">
              <thead>
                <tr>
                  <th colspan="9" style="border: 1px solid rgb(0, 0, 0);">Исходные данные</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="border: 1px solid rgb(0, 0, 0);">Высота слоя, м</td>
                  <td style="border: 1px solid rgb(0, 0, 0);">Начальная температура материала, °С</td>
                  <td style="border: 1px solid rgb(0, 0, 0);">Начальная температура газа, °С</td>
                  <td style="border: 1px solid rgb(0, 0, 0);">Скорость газа на свободное сечение шахты, м/с</td>
                  <td style="border: 1px solid rgb(0, 0, 0);">Средняя теплоемкость газа, кДж/(м3 • К).</td>
                  <td style="border: 1px solid rgb(0, 0, 0);">Расход материалов кг/с</td>
                  <td style="border: 1px solid rgb(0, 0, 0);">Теплоемкость материалов, кДж/(кг • К)</td>
                  <td style="border: 1px solid rgb(0, 0, 0);">Объемный коэффициент теплоотдачи, Вт/(м3 • К).</td>
                  <td style="border: 1px solid rgb(0, 0, 0);">Диаметр аппарата, м</td>
                </tr>
                <tr>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $row["layer_height"]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $row["initial_material_temperature"]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $row["initial_gas_temperature"]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $row["gas_speed"]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $row["average_heat_capacity_of_gas"]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $row["material_consumption"]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $row["heat_capacity_of_materials"]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $row["volumetric_heat_transfer_coefficient"]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $row["device_diameter"]?></td>
                </tr>
              </tbody>
            </table>
            <br>
            <?

            $layer_height = $row['layer_height'];
            $initial_material_temperature = $row['initial_material_temperature'];
            $initial_gas_temperature = $calcs['initial_gas_temperature'];
            $gas_speed = $row['gas_speed'];
            $average_heat_capacity_of_gas = $row['average_heat_capacity_of_gas'];
            $material_consumption = $row['material_consumption'];
            $heat_capacity_of_materials = $row['heat_capacity_of_materials'];
            $volumetric_heat_transfer_coefficient = $row['volumetric_heat_transfer_coefficient'];
            $device_diameter = $row['device_diameter'];
          
            $d=$device_diameter/2;
        
            $m=$heat_capacity_of_materials*$material_consumption/($gas_speed*$average_heat_capacity_of_gas*3.14*$d*$d);
        
            $coord = 0.0;
            $arrayY = array();
            do{
                //echo $coord;
                $Y=$coord*$volumetric_heat_transfer_coefficient/$gas_speed/$average_heat_capacity_of_gas/1000;
                // $array = array(
                    
                //      "Y$coord" => $Y,
                //  );
                array_push($arrayY,round($Y, 5) );
        
        
                $coord=$coord+0.5; 
                //echo "<br>"; 
            }
            while ($coord <= 3);
        
            $arrayEXP1 = array();
            $arrayEXP2 = array();
            for ($i = 0; $i < count($arrayY); $i++) {
                
                $exp1=1-EXP(-(1-$m)*$arrayY[$i]/$m);
                $exp2=1-$m*EXP(-(1-$m)*$arrayY[$i]/$m);
                array_push($arrayEXP1,round($exp1,5) );
                array_push($arrayEXP2,round($exp2,5) );
            }
            $arrayO = array();
            $array0 = array();
            for ($i = 0; $i < count($arrayY); $i++) {
                
                $O=$arrayEXP1[$i]/$arrayEXP2[6];
                $a0=$arrayEXP2[$i]/$arrayEXP2[6];
                array_push($arrayO,round($O,5) );
                array_push($array0,round($a0,5) );
            }
            $arrayt = array();
            $arrayT = array();
            $arrayRaz = array();
            for ($i = 0; $i < count($arrayY); $i++) {
                
                $t=$initial_material_temperature+($initial_gas_temperature-$initial_material_temperature)*$arrayO[$i];
                $T=$initial_material_temperature+($initial_gas_temperature-$initial_material_temperature)*$array0[$i];
                $Raz=$t-$T;
                array_push($arrayt,round($t,5) );
                array_push($arrayT,round($T,5) );
                array_push($arrayRaz,round($Raz,5) );
            }
            
            $jsonY =json_encode((object)$arrayY,JSON_UNESCAPED_UNICODE);
            $jsonY = nl2br("$jsonY");
            $jsonEXP1 =json_encode((object)$arrayEXP1,JSON_UNESCAPED_UNICODE);
            $jsonEXP1 = nl2br("$jsonEXP1");
            $jsonEXP2 =json_encode((object)$arrayEXP2,JSON_UNESCAPED_UNICODE);
            $jsonEXP2 = nl2br("$jsonEXP2");
            $jsonO =json_encode((object)$arrayO,JSON_UNESCAPED_UNICODE);
            $jsonO = nl2br("$jsonO");
            $json0 =json_encode((object)$array0,JSON_UNESCAPED_UNICODE);
            $json0 = nl2br("$json0");
            $jsont =json_encode((object)$arrayt,JSON_UNESCAPED_UNICODE);
            $jsont = nl2br("$jsont");
            $jsonT =json_encode((object)$arrayT,JSON_UNESCAPED_UNICODE);
            $jsonT = nl2br("$jsonT");
            $jsonRaz =json_encode((object)$arrayRaz,JSON_UNESCAPED_UNICODE);
            $jsonRaz = nl2br("$jsonRaz");



            $objY = json_decode($jsonY, JSON_UNESCAPED_UNICODE);
            $objEXP1 = json_decode($jsonEXP1, JSON_UNESCAPED_UNICODE);
            $objEXP2 = json_decode($jsonEXP2, JSON_UNESCAPED_UNICODE);
            $objO = json_decode($jsonO, JSON_UNESCAPED_UNICODE);
            $obj0 = json_decode($json0, JSON_UNESCAPED_UNICODE);
            $objt = json_decode($jsont, JSON_UNESCAPED_UNICODE);
            $objT = json_decode($jsonT, JSON_UNESCAPED_UNICODE);
            $objRaz = json_decode($jsonRaz, JSON_UNESCAPED_UNICODE);

            $jsont=$row["temp"];
            $jsonT=$row["T"];
            $jsonRaz=$row["raz"];
            ?>
            <table style="border: 1px solid rgb(0, 0, 0); margin-top: 25px;">
              <thead>
                <tr>
                  <th rowspan="2"></th>
                  <th colspan="7" style="border: 1px solid rgb(0, 0, 0);">Координаты у, м</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td></td>
                  <td style="border: 1px solid rgb(0, 0, 0);">0</td>
                  <td style="border: 1px solid rgb(0, 0, 0);">0.5</td>
                  <td style="border: 1px solid rgb(0, 0, 0);">1</td>
                  <td style="border: 1px solid rgb(0, 0, 0);">1.5</td>
                  <td style="border: 1px solid rgb(0, 0, 0);">2</td>
                  <td style="border: 1px solid rgb(0, 0, 0);">2.5</td>
                  <td style="border: 1px solid rgb(0, 0, 0);">3</td>
                </tr>
                <tr>
                  <td style="border: 1px solid rgb(0, 0, 0);"><img class="bd-placeholder-img-lg" style="width: 100px;"src="./pictures/Y.jpg"></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objY[0]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objY[1]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objY[2]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objY[3]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objY[4]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objY[5]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objY[6]?></td>
                </tr>
                <tr>
                  <td style="border: 1px solid rgb(0, 0, 0);"><img class="bd-placeholder-img-lg" style="width: 100px;"src="./pictures/exp1.jpg"></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objEXP1[0]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objEXP1[1]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objEXP1[2]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objEXP1[3]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objEXP1[4]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objEXP1[5]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objEXP1[6]?></td>
                </tr>
                <tr>
                  <td style="border: 1px solid rgb(0, 0, 0);"><img class="bd-placeholder-img-lg" style="width: 100px;"src="./pictures/exp2.jpg"></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objEXP2[0]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objEXP2[1]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objEXP2[2]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objEXP2[3]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objEXP2[4]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objEXP2[5]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objEXP2[6]?></td>
                </tr>
                <tr>
                  <td style="border: 1px solid rgb(0, 0, 0);"><img class="bd-placeholder-img-lg" style="width: 100px;"src="./pictures/O.jpg"></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objO[0]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objO[1]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objO[2]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objO[3]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objO[4]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objO[5]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objO[6]?></td>
                </tr>
                <tr>
                  <td style="border: 1px solid rgb(0, 0, 0);"><img class="bd-placeholder-img-lg" style="width: 100px;"src="./pictures/0.jpg"></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $obj0[0]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $obj0[1]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $obj0[2]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $obj0[3]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $obj0[4]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $obj0[5]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $obj0[6]?></td>
                </tr>
                <tr>
                  <td style="border: 1px solid rgb(0, 0, 0);"><img class="bd-placeholder-img-lg" style="width: 100px;"src="./pictures/t.jpg"></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objt[0]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objt[1]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objt[2]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objt[3]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objt[4]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objt[5]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objt[6]?></td>
                </tr>
                <tr>
                  <td style="border: 1px solid rgb(0, 0, 0);"><img class="bd-placeholder-img-lg" style="width: 100px;"src="./pictures/Te.jpg"></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objT[0]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objT[1]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objT[2]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objT[3]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objT[4]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objT[5]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objT[6]?></td>
                </tr>
                <tr>
                  <td style="border: 1px solid rgb(0, 0, 0);">Разность температур, °С</td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objRaz[0]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objRaz[1]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objRaz[2]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objRaz[3]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objRaz[4]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objRaz[5]?></td>
                  <td style="border: 1px solid rgb(0, 0, 0);"><?echo $objRaz[6]?></td>
                </tr>
              </tbody>
            </table>
            <br>
            <div id="container1" style="width: 700px; height: 400px "></div>
            <br>
            <div id="container2" style="width: 700px; height: 400px "></div>
        </section>
            <hr>
            <footer>
                <p>сделано с любовью - <a href="#">@skelet</a>
            </footer>
        </article>
    </main>

</body>
</html>
<script type="text/javascript">
  var dat1 = <?=  $jsont; ?>;
  var dat2 = <?=  ($jsonT); ?>;
  var dat3 = <?=  ($jsonRaz); ?>;
  //const newData = JSON.parse(<?=  $jsont; ?>).map(Object.values);
  var arr1 = [];
      for (var c in dat1) {
        arr1.push(dat1[c]);
      }
  var arr2 = [];
      for (var c in dat2) {
          arr2.push(dat2[c]);
      }
  var arr3 = [];
      for (var c in dat3) {
          arr3.push(dat3[c]);
      }
      

  var chart1;
  $(document).ready(function(){
    chart1 = new Highcharts.Chart({
      title: {
        text: 'Изменение температуры окатышей и газа по высоте слоя',
    },
      xAxis: {
        accessibility: {
            rangeDescription: 'Range: 0 to 3'
        }
    },

    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 0
            
        }
    },
      chart: {renderTo: 'container1'},
      series: [{name:"Температура материала ",data: arr1},{name:"Температура газа",data:arr2}],
    });
  });

  var chart2;
  $(document).ready(function(){
    chart1 = new Highcharts.Chart({
      title: {
        text: 'Разность температур материала и газа',
    },
      xAxis: {
        accessibility: {
            rangeDescription: 'Range: 0 to 3'
        }
    },


    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 0
            
        }
    },
      chart: {renderTo: 'container2'},
      series: [{name:"Разность температур ",data: arr3}],
    });
  });
</script>
<!-- <script type="text/javascript">
anychart.onDocumentLoad(function() {
  // create a chart and set the data
  // as Array of Arrays
  var chart = anychart.line()
  chart.data({header: ["#", "Euro (€)", "USD ($)", "Pound (£)"],
   rows:[
    [dat1[0], 5, 7, 4],
    [dat1[1], 7, 9, 6],
    [dat1[2], 9, 12, 8],
    ["Fall", 12, 15, 9]
  ]});
  chart.title("AnyChart: Multi-Series Array of Arrays");
  chart.legend(true);
  chart.container("container").draw();
});
</script> -->
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