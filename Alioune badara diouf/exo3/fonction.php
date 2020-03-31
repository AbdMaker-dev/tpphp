<?php


    // $nombre = $_POST['nombre'];
    // $resulta = "Le nombre est premier"; // la tu supose g bien supose tous les nombres son premier
    // for ($i=2; $i < $nombre ; $i++) { 
         
    //      if ($nombre % $i == 0) { // la condition qui fait que ma suposition est fauss
    //      	$resulta = "Le nombre n'est pas premier"; 
    //      }
    //  }
    //  echo "$resulta";


    function affissageFormulair($val){
      $form='';
       if ( is_numeric2($val)== 1 && $val >0 ) {
        for ($i=0; $i <$val ; $i++) { 
           $form=$form.'<input placeholder="Donner un mots" style="width: 50%; height:50px;position:relative; left:8.9%;margin-top:20px;" type="text" name="mots'.$i.'" class="inputAuto"><br>';
        }
       }else {
        $form = "Donner un entier";
       }
      return $form;
     }

    function reaffissageFormulair($val){
      $form='';
      for ($i=0; $i <$val ; $i++) { 
          if ( is_Valide($_POST['mots'.$i])==1) {
            $form=$form.'<input type="text" style="width: 50%; height:50px;position:relative; left:8.9%;margin-top:20px;" name="mots'.$i.'" value="'.$_POST['mots'.$i].'" class="inputAuto"><br>';
          }else{
           $form=$form.'<label style="color:red;" >Error !!!!!!!!</lavel><input placeholder="Donner valide et inferieur a 20 carracter" style="width: 50%; height:50px;position:relative; left:2.9%;margin-top:20px;" type="text" name="mots'.$i.'" class="inputAuto">';
          }
      }
      return $form;
     }


    function nombreMotscontaintM($tabmots,$carracter1,$carracter2){  // fonction pour les mots qui contient les carracter cherche dans un tableau de mots 
        
        $nbrMm = 0;
        foreach ($tabmots as $key => $value) {
        $index =0;
        $result =0;
        while ( $index< taille_chaine($value) && $result==0) {
          if ($carracter1 == $value[$index] || $carracter2 == $value[$index]) { // pour chaque mots pacour et on verifi les carrecter 
            $result=1;  // quand on trouve on donne result 1 et on sort du boucle
          }
          $index++;
        }
        if ($result==1) {
        $nbrMm = $nbrMm +1;   // donk si result est 1 alors on increment le nombre
        }
          
        }
        return $nbrMm;
     }


    function is_entier($n){
      return ($n>0 || $n =='0');
      }

      function taille_chaine($chaine){
        $taill=0;
        for ($i=0;isset($chaine[$i]); $i++) { 
          $taill ++;
        }
        return $taill;
      }

      function is_numeric2($chaine){
        $result = 1 ;
        if (isset($chaine)) {
        for ($i=0; $i < taille_chaine($chaine); $i++) { 
          if (is_entier($chaine[$i])!=1  ) {
            $result = 0;
          }
        }
         }else{
           $result = 0;
         }
        return $result;
      }

      function is_Valide($chaine){
        for ($i=0; $i < taille_chaine($chaine); $i++) { 
          if ( (!is_lower($chaine[$i])) && (!is_upper($chaine[$i])) ) {
            return false;
          }
        }
        return true;
      }
      
      function is_lower($carac){
        return ($carac >='a' && $carac<='z');
      }
      function is_upper($carac){
        return ($carac >='A' && $carac<='Z');
      }

      function low_to_Up($carac){
        for ($fin=0,$i='a' ,$j='A';$fin<26 ; $i++,$j++,$fin++) { 
          if ($carac == $i) {
            return $j;
          }
        }
      }

      function up_to_Low($carac){
      
        for ($fin=0,$i='a' ,$j='A';$fin<26 ; $i++,$j++,$fin++) { 
          if ($carac == $j) {
            return $i;
          }
        }
      }

      function Invers_carc($carac){   
        for ($fin=0, $i='a' ,$j='A';$fin<26 ; $i++,$j++,$fin++) { 
          if ($carac == $i) {
            return $j;
          }       
          if ($carac == $j) {
            return $i;
          }       
        }
        return $carac;
      }

      function inverse_chaine($chaine){
        $chaineInver ="";
        for ($i=0; $i < taille_chaine($chaine) ; $i++) { 
          $chaineInver=$chaineInver.Invers_carc($chaine[$i]);
        }
        return $chaineInver;
      }

      function my_trim($chaine){
        $chaineTrimer ="";
        for ($i=0; $i < taille_chaine($chaine); $i++) { 
          if (is_lower($chaine[$i]) || is_upper($chaine[$i])) {
            $chaineTrimer = $chaineTrimer.$chaine[$i];
          }
        }
        return $chaineTrimer;
      }



  ?>