<?php

/**
 * genere le head de la page
 */
function generateHead(string $page, string $language, string $charset, string $title){
    $head = "";
    $head .= "<!DOCTYPE html>\n";
    $head .= "<html lang=".$language.">\n";
    $head .= "<head>\n";
    $head .= "<meta charset=".$charset.">\n";
    $head .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    $head .= "<link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css\" integrity=\"sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2\" crossorigin=\"anonymous\">\n";
    if ($page === "game") {
        $head .= "<link rel=\"stylesheet\" href=\"assets/css/game.css\">";
    }
    $head .= "<title>".$title."</title>";
    $head .= "</head>";
    $head .= "<body class\"d-flex flex-column\">";
    echo $head;
}

/**
 * genere le header de la page
 */
function generateHeader(string $title, int $player, bool $checkWin){
    $header ="";
    $header.="<header>\n";
    $header.="<h1 class=\"text-capitalize text-center\">$title</h1>\n";
    if (!empty($player) && $checkWin === false){
        $header.="<h2 class=\"text-center text-secondary\"> A vous de jouer : ";
        if ($player === 1) {
            $header.="Joueur 1";
        }else {
            $header.="Joueur 2";
        }
        $header.="</h2>\n";
    }elseif($checkWin === true && calcWin() === 2 || calcWin() === 1) {
        $header.="<h2 class=\"text-center text-success\">";
        if (calcWin() === 1) {
            $header.="Joueur 1 win";
        }else{
            $header.="Joueur 2 win";
        }
        $header.="</h2>\n";
    }
    $header.="</header>\n";
    echo $header;
}

/**
 * permet de generer la section de jeu
 */
function generateSection(int $row, int $column, string $method, string $action, bool $turn, bool $win){
    $array = "";
    $array .= "<section class=\"d-flex flex-column align-items-center justify-content-center\">\n";
    $array .= "<div class=\"array\">\n";
    $array .= "<form action=\"$action\" method=\"$method\" class=\"d-flex flex-column align-items-center\">\n";
    //creer les listes
    for ($i=1; $i <= $row ; $i++) {
        $array .= "<ul class=\"d-flex flex-row\">\n";
        // créer les li
        for ($j=0; $j <$column; $j++) {
            //verifier si il y a une victoire ou non pour savoir si il faut tout disabled
            (!empty($win))?$disable = "disabled":$disable = disabled($i, $j, $turn);
            //creer l'image et la checkbox
            $circle = "<li><img src=\"".displayImage($i, $j)."\" alt=\"cireturn\"></li>\n";
            $checkbox = "<li><input type=\"checkbox\" value=$i".$j." id=\"row".$i."-".$j."\" name=\"case\" ".$disable."></li>\n";
            //afficher la checkbox ou l'image si la valeur dans le tableau est egale a 0 ou non
            ($_SESSION["array"][intval($i."".$j)] === 0)?$array.=$checkbox:$array.=$circle;
        }
        $array .= "</ul>\n";
    }
    $array .= "<input type=\"submit\" value=\"submit\" name=\"submit\" class=\"btn btn-primary\">\n";
    $array .= "</form>\n";
    $array .= "</div>\n";
    $array .= "</section>\n";
    echo $array;
}

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

/**
 * set la valeur en fonction du joueur et du choix de la case
 * dans l'array
 */
function setArrayValue(int $case, int $player){
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

/**
 * permet de choisir l'image 
 * en fonction de la valeur dans le tableau
 */
function displayImage(int $nbr1, int $nbr2){
    $nbrFinal = intval($nbr1."".$nbr2);
    foreach ($_SESSION["array"] as $key => $value) {
        if($key === $nbrFinal){
            if ($value === 1) {
                return "assets/img/circle_red-01.svg";
            }elseif ($value === 2){
                return "assets/img/circle_yellow-01.svg";
            }else{
                return "assets/img/circle_white-01.svg";
            }
        }
    }
}

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
                //la diagonal
                for ($i=$key; $i <= $key+3; $i++) {
                    if ($_SESSION["array"][$i] === 1 && $_SESSION["array"][($i-10)+1] === 1 && $_SESSION["array"][($i-20)+2] === 1 && $_SESSION["array"][($i-30)+3] === 1) {
                        return 1;
                         break;
                     }elseif ($_SESSION["array"][$i] === 2 && $_SESSION["array"][($i-10)+1] === 2 && $_SESSION["array"][($i-20)+2] === 2 && $_SESSION["array"][($i-30)+3] === 2) {
                         return 2;
                         break;
                     }
                }
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