<?php 
   $tabPage=['exo1/exo1.php','exo2/exo2.php','exo3/exo3.php','exo4/exo4.php','exo5/exo5.php','apli1/apli1.php','apli2/apli2.php'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>

    <style>
        *{
            margin:0%;
            padding: 0%;
        }
        body{
            width: 100%;
        }
        table{
            margin-left: auto;
            margin-right: auto;
            margin-top: 30px;

        }
        .boite{
            width: 50px;
             height: 30px;
            border: 0.5px solid black;
        }
        nav{
            width: 100%;
            height: 70px;
            background-color:  #00FF00 ;
        }
       li{
           list-style: none;
           float: left;
           margin-top: 20px;
           margin-left: 10%;
       }
       a{
           text-decoration: none;
       }
       .inputAuto{
        width: 30%; 
        height:30px;
        margin-top: 20px;
       }
       .pagPag{
        width: 30px;
        height: 10px;
        border: 1px solid black;
        margin-left: 10px;
        padding: 2px;
        position: relative;
        top: 20px;
       }
    </style>
</head>
<body>

    <div>
        <nav>
            <ul>
                <li>
                    <a href="index2.php?nume=0&page=1&pagePagiSup=1">Exo1</a>
                </li>
                <li>
                    <a href="index2.php?nume=1">Exo2</a>
                </li>
                <li>
                    <a href="index2.php?nume=2">Exo3</a>
                </li>

            </ul>
        </nav>
    </div>

    <div style="width:90%;margin-left:5%;" id="">
          <?php 
                if(!empty($_GET['nume'])){
                     if($_GET['nume']< count($tabPage)){
                        include($tabPage[ intVal($_GET['nume']) ]);
                     }else{
                        include($tabPage[0]);
                     }
                }else{
                    include($tabPage[0]);
                }
          ?>
    </div>
</body>
</html>