<?php

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

function generateHeader(string $title, int $player = NULL){
    $header ="";
    $header.="<header>\n";
    $header.="<h1 class=\"text-capitalize text-center\">$title</h1>\n";
    if (!empty($player)) {
        $header.="<h2 class=\"text-center text-secondary\"> A vous de jouer : ";
        if ($player === 1) {
            $header.="Joueur 1";
        }else {
            $header.="Joueur 2";
        }
        $header.="</h2>\n";
    }
    $header.="</header>\n";
    echo $header;
}

function generateSection(int $row, int $column, string $method, string $action, string $titleGraphic, string $titleInteractive, string $case){
    $array = "";
    $array .= "<section class=\"d-flex flex-column align-items-center justify-content-center\">\n";
    if (empty($titleGraphic)) {
        $array .= "<h2 class=\"text-center text-secondary\">$titleInteractive</h2>";
    } else {
        $array .= "<h2 class=\"text-center text-secondary\">$titleGraphic</h2>";
    }
    $array .= "<div class=\"array\">\n";
    switch ($case) {
        case 'graphic':
            for ($i=1; $i <= $row ; $i++) { 
                $array .= "<div class=\"row\">\n";
                $array .= "<ul class=\"d-flex flex-row justify-content-center align-items-center\">\n";
                for ($j=0; $j < $column; $j++) {
                    $array .= "<li><img src=\"".displayImage($i, $j)."\" alt=\"cireturn\"></li>\n";
                }
                $array .= "</ul>\n";
                $array .= "</div>\n";
            }
            break;

        case 'interactive':
            $array .= "<form action=\"$action\" method=\"$method\">\n";
            for ($i=1; $i <= $row ; $i++) {
                $array.= "<div class=\"row\">";
                $array .= "<ul class=\"d-flex flex-row\">\n";
                for ($j=0; $j <$column; $j++) {
                    $array.="<li><input type=\"checkbox\" value=$i".$j." id=\"row".$i."-".$j."\" name=\"case\"></li>\n";
                }
                $array .= "</ul>\n";
                $array .= "</div>\n";
            }
            $array .= "<input type=\"submit\" value=\"submit\" name=\"submit\" class=\"btn btn-primary\">\n";
            $array .= "</form>\n";
            break;
    }
    $array .= "</div>\n";
    $array .= "</section>\n";
    echo $array;
}

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

function calcWin(){
    foreach ($_SESSION["array"] as $key => $value) {
        /**
         * verifier la ligne horizontal
         */
        if ($key === 60 || $key === 50 || $key === 40 || $key === 30 ||$key === 20 || $key === 10) {
            for ($i=$key; $i < $key+4; $i++) {
                if($_SESSION["array"][$i] === 1 && $_SESSION["array"][$i+1] === 1 && $_SESSION["array"][$i+2] === 1 && $_SESSION["array"][$i+3] === 1) {
                    echo "Joueur 1 win horizontal";
                    break;
                }elseif ($_SESSION["array"][$i] === 2 && $_SESSION["array"][$i+1] === 2 && $_SESSION["array"][$i+2] === 2 && $_SESSION["array"][$i+3] === 2) {
                    echo "Joueur 2 win horizontal";
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
                for ($i=$key; $i < $key+4; $i++) {
                    if ($_SESSION["array"][$i] === 1 && $_SESSION["array"][($i-10)+1] === 1 && $_SESSION["array"][($i-20)+2] === 1 && $_SESSION["array"][($i-30)+3] === 1) {
                         echo "Joueur 1 win diagonal";
                         break;
                     }elseif ($_SESSION["array"][$i] === 2 && $_SESSION["array"][($i-10)+1] === 2 && $_SESSION["array"][($i-20)+2] === 2 && $_SESSION["array"][($i-30)+3] === 2) {
                         echo "Joueur 1 win diagonal";
                         break;
                     }
                }
                //la vertical
                for ($i=$key; $i < $key+6; $i++) {
                    if ($_SESSION["array"][$i] === 1 && $_SESSION["array"][$i-10] === 1 && $_SESSION["array"][$i-20] === 1 && $_SESSION["array"][$i-30] === 1) {
                        echo "Joueur 1 win vertical";
                        break;
                    }elseif ($_SESSION["array"][$i] === 2 && $_SESSION["array"][$i-10] === 2 && $_SESSION["array"][$i-20] === 2 && $_SESSION["array"][$i-30] === 2) {
                        echo "Joueur 2 win vertical";
                        break;
                    }
                }
            }
        }
    }
}