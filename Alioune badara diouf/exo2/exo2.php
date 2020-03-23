<?php
      $msg="";
      $msg2="";
      $msg3="";
     if ( !empty($_POST['lg']) ){

        $tab=[1 =>["Janvier","January"],2 =>["Fevrier","February"],3 =>["Mars","March"],4 =>["Avril","April"],5 =>["Mai","May"],6 =>["Juin","June"],7 =>["Juillet","July"],8 =>["Aout","August"],9 =>["Septembre","September"],10 =>["Octobre","October"],11 =>["Novembre","November"],12 =>["Descembre","Descember"]];
        
         if ( $_POST['lg'] == "fr" ){
         // -----------------------------------------Traitement if choix est francais
                $k=1;
                $msgtmp="<tr>";
                 foreach ($tab as $key => $value) {
                    $msgtmp =$msgtmp."<td style='background-color:green; padding:5px; ;width: 5%;margin-left:25%;border:1px solid black' class='key'>$key</td><td style='background-color:yellow;padding:5px; ;width: 5%;margin-left:25%;border:1px solid black' class='value'>".$value[0]."</td>";
                    if( ($k%3)==0 ){
                        $msg = $msg.$msgtmp."</tr>";
                        $msgtmp="<tr>";
                        $k=1;
                    }else{
                        $k++;
                    }
                 }
         // -----------------------------------------Traitement if choix est anglais
         }else{
                $k=1;
                $msgtmp="<tr>";
                 foreach ($tab as $key => $value) {
                    $msgtmp =$msgtmp."<td style='background-color:green; padding:5px; ;width: 5%;margin-left:25%;border:1px solid black' class='key'>$key</td><td style='background-color:yellow;padding:5px; ;width: 5%;margin-left:25%;border:1px solid black' class='value'>".$value[1]."</td>";
                    if( ($k%3)==0 ){
                        $msg = $msg.$msgtmp."</tr>";
                        $msgtmp="<tr>";
                        $k=1;
                    }else{
                        $k++;
                    }
                 }      
         }
     }

?>

<div style="padding:30px; ;width: 50%;margin-left:25%;border:10px solid green;padding-bottom:50px;margin-top:50px;">
        <div style="width: 100%;">
            <form style="width: 100%; margin-left:25%;" action="index2.php?nume=1" method="POST" id="form">
            <select style="width: 50%; height:50px;" id="cars" name="lg" form="form">
                <option value="fr" >Francais</option>
                <option value="en">English</option>
            </select><br>
                 <input style="margin-top:30px; width: 50%; height:50px;" id="btn" type="submit">
            </form>
        </div>


        <div id="tab" style="margin-top:20px;">
            <table >
                <?php echo"$msg $msg2 $msg3"; ?>
            </table>
        </div>

    </div>