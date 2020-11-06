<?php
/**
 * permet de verifier les conditions de victoire
 */
function calcWin(){
    foreach ($_SESSION["array"] as $key => $value) {
        /**
         * verifier la ligne horizontal
         */
        if ($key === 60 || $key === 50 || $key === 40 || $key === 30 ||$key === 20 || $key === 10) {
            for ($i=$key; $i < $key+4; $i++) {
                if($_SESSION["array"][$i] === 1 && $_SESSION["array"][$i+1] === 1 && $_SESSION["array"][$i+2] === 1 && $_SESSION["array"][$i+3] === 1) {
                    return 1;
                    break;
                }elseif ($_SESSION["array"][$i] === 2 && $_SESSION["array"][$i+1] === 2 && $_SESSION["array"][$i+2] === 2 && $_SESSION["array"][$i+3] === 2) {
                    return 2;
                    break;
                 }
            }
            /*
             *permet de verifier la diagonal et la vertical
             *uniquement a partir de 40 max
             *car impossible d'en avoir 4 au dela
             */
            if ($key === 60 || $key === 50 || $key === 40) {
                //la diagonal de gauche a droite
                for ($i=$key; $i <= $key+3; $i++) {
                    if ($_SESSION["array"][$i] === 1 && $_SESSION["array"][($i-10)+1] === 1 && $_SESSION["array"][($i-20)+2] === 1 && $_SESSION["array"][($i-30)+3] === 1) {
                        return 1;
                         break;
                     }elseif ($_SESSION["array"][$i] === 2 && $_SESSION["array"][($i-10)+1] === 2 && $_SESSION["array"][($i-20)+2] === 2 && $_SESSION["array"][($i-30)+3] === 2) {
                         return 2;
                         break;
                     }
                }
                //la diagonal de droite a gauche
                for ($i=$key+3; $i <= $key+6; $i++) {
                    if ($_SESSION["array"][$i] === 1 && $_SESSION["array"][($i-11)] === 1 && $_SESSION["array"][($i-22)] === 1 && $_SESSION["array"][($i-33)] === 1) {
                        return 1;
                         break;
                     }elseif ($_SESSION["array"][$i] === 2 && $_SESSION["array"][($i-11)] === 2 && $_SESSION["array"][($i-22)] === 2 && $_SESSION["array"][($i-33)] === 2) {
                         return 2;
                         break;
                     }
                }
                //la vertical
                for ($i=$key; $i < $key+6; $i++) {
                    if ($_SESSION["array"][$i] === 1 && $_SESSION["array"][$i-10] === 1 && $_SESSION["array"][$i-20] === 1 && $_SESSION["array"][$i-30] === 1) {
                        return 1;
                        break;
                    }elseif ($_SESSION["array"][$i] === 2 && $_SESSION["array"][$i-10] === 2 && $_SESSION["array"][$i-20] === 2 && $_SESSION["array"][$i-30] === 2) {
                        return 2;
                        break;
                    }
                }
            }
        }
    }
}