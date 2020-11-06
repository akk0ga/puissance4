<?php
/**
 * set la valeur en fonction du joueur et du choix de la case
 * dans l'array
 */
function setValue(int $case, int $player){
    foreach ($_SESSION["array"] as $key => $value) {
        if ($key === $case) {
            if ($player === 1) {
                $_SESSION["array"][$key] = 1;
            } else {
                $_SESSION["array"][$key] = 2;
            }
        }
    }
}