<?php
     set_time_limit(0);
     session_start();

     $msg=""; // 
     $paginf='';
     $pagsup='';
     $nbrPage;
     $nbrPagesup;
     $pos;

     if ( isset($_POST['sub']) && !empty($_POST['val'])){
         if (isValide($_POST['val']) ==1 &&  $_POST['val']>10000){
            // ------------------------
             $nbrPage=$_POST['nbrPage'];
             $nbrPagesup=$_POST['nbrPagesup'];
             $T1 = array();   // tableau contenant tous les nombre premier
             $T = array();    // tableau contenant les nombre premier repartie en deux groupe
             $n = intval($_POST['val']); // convertion de la valeur donner par l'utilisateu
             $j=0;
             $jTinf=0;
             $jTsup=0;
             $moy;
            for ($i=1; $i < $n ; $i++) { 
                $test=0;
                $k=2;
                while( $test==0 && $k <$i ){
                    if(  ($i%$k ) == 0 ){
                        $test++;
                    }
                    $k++;
                }
                if ( $test==0 ) {
                    $T1[$j] =$i;
                    $j++;
                }
            }
            $moy = moyenne($T1); // recupeation de la moyene avec la fonction moyen
            for ($i=0; $i < counte($T1); $i++) { 
                if ($T1[$i]>$moy) {
                    $T['superieur'][$jTsup] =$T1[$i]; // insertion des nombre premier superieur a la moyem
                    $jTsup++;
                }else{
                    $T['inferieure'][$jTinf] =$T1[$i];  // insertion des nombre prmier inferieur a la moyen
                    $jTinf++;
                }
            }
            $pos=$_POST['pos'];
            $_SESSION['T']=$T;
            $_SESSION['page'] = $_GET['page']; // rucupretaion du numero de page pour la pagination des nombre inferier dans url avec $_GET
            $_SESSION['pagePagiSup'] = $_GET['pagePagiSup'];// rucupretaion du numero de page pour la pagination des nombre inferier dans url avec $_GET
            $paginf =  paggination2($_SESSION['T']['inferieure'],$_SESSION['page']); // apell de la fonction pagination avec parametre ne numero de page et tableau des nombre inferieur
            $pagsup =  paggination2($_SESSION['T']['superieur'],$_SESSION['pagePagiSup']);// apell de la fonction pagination avec parametre ne numero de page et tableau des nombre superieur
            // -----------------------------------------------------------------------------------
         }else{
             $msg="Seule les nombre superrieur a 10 000 sont autoriser";
         }
     }else{
          $nbrPage=3;
          $nbrPagesup=3;
     }

     if (isset($_GET['page']) && !empty($_SESSION['T'])) {       
        $_SESSION['page'] = $_GET['page']; // recuperation du numero de page
         $paginf =  paggination2($_SESSION['T']['inferieure'],$_SESSION['page']); // apel encore du fonction pagination pour reafiche la pagination pour la page recuperer
         $pagsup =  paggination2($_SESSION['T']['superieur'],$_SESSION['pagePagiSup']);
     }
     if (isset($_GET['pagePagiSup']) && !empty($_SESSION['T'])) {
         $_SESSION['pagePagiSup'] = $_GET['pagePagiSup'];// recuperation du numero de page
         $pagsup =  paggination2($_SESSION['T']['superieur'],$_SESSION['pagePagiSup']);
         $paginf =  paggination2($_SESSION['T']['inferieure'],$_SESSION['page']);
     }
     if (isset($_POST['pagSuiv1'])) {
       $nbrPage=$_POST['nbrPage'] +3;

       if ($nbrPage>ceil( counte($_SESSION['T']['inferieure'])/100 )) {
         $nbrPage=ceil( counte($_SESSION['T']['inferieure'])/100 );
       }
        $pagsup =  paggination2($_SESSION['T']['superieur'],$_SESSION['pagePagiSup']);
         $paginf =  paggination2($_SESSION['T']['inferieure'],$_SESSION['page']);

     }
     if (isset($_POST['pagPrec1'])) {
        $nbrPage=$_POST['nbrPage'] -3;

       if ($nbrPage<3) {
         $nbrPage=3;
       }
        $pagsup =  paggination2($_SESSION['T']['superieur'],$_SESSION['pagePagiSup']);
         $paginf =  paggination2($_SESSION['T']['inferieure'],$_SESSION['page']);
     }


      if (isset($_POST['pagSuiv2'])) {
       $nbrPagesup=$_POST['nbrPagesup'] +3;

       if ($nbrPagesup>ceil( counte($_SESSION['T']['superieur'])/100 )) {
         $nbrPagesup=ceil( counte($_SESSION['T']['superieur'])/100 );
       }
        $pagsup =  paggination2($_SESSION['T']['superieur'],$_SESSION['pagePagiSup']);
         $paginf =  paggination2($_SESSION['T']['inferieure'],$_SESSION['page']);

     }
     if (isset($_POST['pagPrec2'])) {
        $nbrPagesup=$_POST['nbrPagesup'] -3;

       if ($nbrPagesup<3) {
         $nbrPagesup=3;
       }
        $pagsup =  paggination2($_SESSION['T']['superieur'],$_SESSION['pagePagiSup']);
         $paginf =  paggination2($_SESSION['T']['inferieure'],$_SESSION['page']);
     }



     // l'ensemble des fonctions de l'exo

     function isValide($donne){ // fonction pour valider un nombre
         $tabChifre=['0','1','2','3','4','5','6','7','8','9',' '];
         $bool=1;
         $index=0;
         while ( $index < counte($donne) and $bool == 1 ){

            $i=0;
            $bool2=0;
            while ($i < counte($tabChifre) and $bool2 == 0){
                if ($tabChifre[$i]== $donne[$index]) {
                    $bool2 =1;
                }
                $i++;
            }
             if ($bool2==0) {
                 $bool=0;
             }
            $index++;        
         }
         return $bool;
     }
     function counte($objet){ // fonction pour calculer la taille d'un objet donne
        $taille=0; // taille
        $index=0;
        while ( isset($objet[$index]) ) { // verification de l'element a un position donne
            $taille++;
            $index++;
        }
        return $taille;
     }
     function moyenne($tab){ // fonction pour calculer la moyen
        $somme =0;
       for ($i=1; $i < counte($tab) ; $i++) { 
          $somme =$somme + $tab[$i];
       }
       return $somme / count($tab);
   }
   function paggination2($table,$page){ // fonction qui dessine le tableau paginer
      $positionDepart = ($page-1)*100;  
      $positionArret = $page*100;
      $l=$positionDepart;
      $k=1;
      $j=0;

      $pag="<tr>";
       while ($l < $positionArret && $k==1) {
            if (isset($table[$l])) {
              $pag = $pag."<td style='background-color:green; padding:2px; ;width: 1%;margin-left:25%;border:1px solid black>".$table[$l]."</td>"; // concatenation des balise td dans le variable $pag
              $j++;
              if ($j==10) { // apres chaque 10 balise td je ferme la balise tr et ouvre une autre
                  $j=0;
                  $pag=$pag."</tr><tr>";
              }
              }else{
                $k=0;
              } 
             $l++;
       }
      return $pag;
   }
?>
        <div style="padding:30px; ;width: 50%;margin-left:25%;border:10px solid green;padding-bottom:50px;margin-top:50px;">
        <div style="width: 100%;">
            <form action="index2.php?nume=0&page=1&pagePagiSup=1" method="POST" style="width: 100%; margin-left:25%;">
                 <input class="int" style="width: 50%; height:50px;" type="text" name="val" placeholder="Donnez un nombre superieure a 10 000" value="<?php if( isset($_POST['val'])){
                        if( isValide($_POST['val'])==1 ){
                            echo $_POST['val'];
                        }else{
                            echo"";
                        } 
                        }   
                        ?>"><br>
                   <input type='hidden'  value='<?php echo $pos  ?>' name='pos'>
                   <input type="hidden" name="nbrPage" value="<?php  echo $nbrPage ?>"> 
                   <input type="hidden" name="nbrPagesup" value="<?php  echo $nbrPagesup ?>">       
                 <input id="btn" name="sub" style="margin-top:30px; width: 50%; height:50px;" type="submit">
            </form>
        </div>
        <div>
            <form action="index2.php?nume=0" method="POST">
                    <table>
                        <?php if($paginf!=""){
                            echo "<caption style='background-color:yellow; padding:20px;'>Les premieres inferieure a la moyen</caption>";
                        } ?>                    
                    <tbody>
                          <?php echo $paginf?>
                      </tbody>
                    </table>
                      <input type="hidden" name="nbrPage" value="<?php  echo $nbrPage ?>">
                      <input type="hidden" name="nbrPagesup" value="<?php  echo $nbrPagesup ?>">
                      <?php if($nbrPage>3){echo '<button style="position: relative; top: 20px;padding:10px;background-color:green;" type="submit" name="pagPrec1">Precedent</button>';} ?>
                       <?php if($paginf!=""){
                          for ($i=($nbrPage-3)+1; $i <= $nbrPage; $i++) { 
                             echo '<a class="pagPag" href="index.php?nume=0&page='.$i.'">'.($i).'</a>';
                          }
                      }?> 

                      <?php if($nbrPage!=ceil( counte($_SESSION['T']['inferieure'])/100 ) && $paginf!=""){echo '<button style="position: relative; top: 20px;left: 10px;padding:10px;background-color:green;" type="submit" name="pagSuiv1">Suivant</button>';} ?>


                    <table>
                        <?php if($pagsup!=""){
                            echo "<caption style='background-color:yellow; padding:20px;'>Les premieres superieur a la moyen</caption>";
                        }?>                    
                    <tbody>
                          <?php echo $pagsup?>
                      </tbody>
                    </table>   
                      <?php if($nbrPagesup>3){echo '<button style="position: relative; top: 20px;padding:10px;background-color:green; " type="submit" name="pagPrec2">Precedent</button>';} ?>                                   
                       <?php if($pagsup!=""){
                          for ($i=($nbrPagesup-3)+1; $i <= $nbrPagesup; $i++) { 
                             echo '<a class="pagPag" href="index.php?nume=0&pagePagiSup='.$i.'">'.($i).'</a>';
                          }
                      }?>  
                     <?php if($nbrPagesup!=ceil( counte($_SESSION['T']['superieur'])/100 ) && $paginf!=""){echo '<button style="position: relative;background-color:green; top: 20px;left: 10px;padding:10px;" type="submit" name="pagSuiv2">Suivant</button>';} ?> 
            </form>
        </div>
        </div>

