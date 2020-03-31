<?php 
      include('fonction.php');
     
      $formulaire ='';
      $msg="";
      $msg2="";
      $val;
      $tabMotsValide =array();
      $tabMostInValide =array();

      if( isset($_POST['sub']) ){

        if ( !empty($_POST['val']) && !isset($_POST['mots0']) ){
            $nombreInput = $_POST['val'];
            $formulaire = affissageFormulair($nombreInput);
        }else{
              $nombreInput = $_POST['val'];
              if (is_numeric($nombreInput)==1 && $nombreInput>0) { // recuperation des mots 
                for ($i=0; $i <$nombreInput; $i++){ 
                   if (isset($_POST['mots'.$i])) {
                      if (is_Valide($_POST['mots'.$i])==1 && taille_chaine($_POST['mots'.$i]) <=20) {
                          $tabMotsValide[] = $_POST['mots'.$i]; // si mots valide
                      }else{
                          $tabMostInValide[] = $_POST['mots'.$i]; //si mots invalide
                      }
                   }
                }
                if (taille_chaine($tabMostInValide)>0){ // si il exixte des mots invalide
                   $formulaire = reaffissageFormulair($nombreInput); //fonction qui reaffiche le formulaire en gardant les mots valide
                }else{
                   $formulaire = reaffissageFormulair($nombreInput);
                  // si touts les mots sont valide on affiche le resultat
                  $msg='Les Mots saisie sont : ';
                  foreach ($tabMotsValide as $key => $value) { // recuperrations des mots valide dans le tableau
                     $msg=$msg."$value ; "; // concatenation des mots dans la variable $msg
                  }
                  $nbrM = nombreMotscontaintM($tabMotsValide,'m','M');
                  $msg=$msg."<br>Et il en'a  <span style='background-color:  #00FF00 ;'>$nbrM</span> d'entre eux qui contient la lettre M(m)";
                }
              }else{
                $formulaire = "Donner un entier";
              }          
        }
      }else{
        $nombreInput=0;
      }
 ?>


        <div  style="width: 100%;border:10px solid green;position:relative;top:100px;">
            <form style="width: 100%; margin:30px;" action="index2.php?nume=2" method="POST" id="form">
                 <label>Nombre de mots : </label>
                 <input type="text"  value="<?php  echo $nombreInput ;?>" name="val" id="nbrMots" style="width: 50%; height:50px;"> <br>

                 <div style="width: 100%;margin-top:20px;" id="divInputAuto">
                       <?php 
                           echo $formulaire;
                        ?>
                 </div>
                 <input  style="width: 50%; height:50px; margin-top:30px; background-color:aqua;position: relative;left: 110px;"  id="btn" type="submit" name="sub">
                 <div style="width: 50%; margin:30px;">
                        <h3>
                        <?php // Affissage du contenue des variable $msg et $msg2
                            echo"$msg<br>$msg2"; ?>
                        </h3>
                 </div>            
            </form>
        </div>