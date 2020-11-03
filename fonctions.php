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
                    $array .= "<li><img src=\"assets/img/circle_white-01.svg\" alt=\"circle white\"></li>\n";
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

