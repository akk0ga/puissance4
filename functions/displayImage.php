<?php
/**
 * permet de choisir l'image 
 * en fonction de la valeur dans le tableau
 */
function displayImage(int $nbr1, int $nbr2){
    $nbrFinal = intval($nbr1."".$nbr2);
    foreach ($_SESSION["array"] as $key => $value) {
        if($key === $nbrFinal){
            if ($value === 1) {
                echo "assets/img/circle_red-01.svg";
            }elseif ($value === 2){
                echo "assets/img/circle_yellow-01.svg";
            }else{
                echo "assets/img/circle_white-01.svg";
            }
        }
    }
}