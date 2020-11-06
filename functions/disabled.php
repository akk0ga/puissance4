<?php
/**
 * permet de rendre l'input disable ou non
 */
function disabled(int $nbr1, int $nbr2, bool $firsTurn){
    $nbrFinal = intval($nbr1."".$nbr2);
    /**
     * initialise les cases suivant si cest le premier tour ou non
     * si cest le premier turn est = a true
     */
    switch ($firsTurn) {
        case true:
            /**
             * si cest egale de 60 a 66 alors on disabled pas
             * sinon si la case est superieur a 60 mais qu'elle est remplie on disabled
             */
            if ($nbrFinal < 60) {
                return "disabled";
            }
            break;

        default:
                if ($nbrFinal >= 60 && $_SESSION["array"][$nbrFinal] > 0) {
                    return "disabled";
                }elseif ($nbrFinal < 60 && $_SESSION["array"][$nbrFinal+10] === 0) {
                    return "disabled";
                }elseif ($nbrFinal < 60 && $_SESSION["array"][$nbrFinal] > 0) {
                    return "disabled";
                }
            break;
    }
}