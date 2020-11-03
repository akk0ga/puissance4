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
        $head .= "<link rel=\"stylesheet\" href=\"../assets/css/game.css\">";
    }
    $head .= "<title>".$title."</title>";
    $head .= "</head>";
    $head .= "<body>";

    return $head;
}


function generateSectionCommande(int $row, int $column, string $method, string $action, string $title){
    $array = "";
    $array .= "<section class=\"d-flex flex-column align-items-center justify-content-center\">\n";
    $array .= "<h2 class=\"text-center text-secondary\">$title</h2>\n";
    $array .= "<div class=\"array\">\n";
    $array .= "<form action=\"$action\" method=\"$method\">\n";
    for ($i=0; $i < $row ; $i++) {
        $array.= "<div class=\"row\">";
        $array .= "<ul class=\"d-flex flex-row\">\n";
        for ($j=0; $j <$column; $j++) {
            $array.="<li><input type=\"radio\" name=\"row".$i."-".$j."\" id=\"row".$i."-".$j."\" value=".$j." disabled></li>\n";
        }
        $array .= "</ul>\n";
        $array .= "</div>\n";
    }
        $array .= "</form>\n";
        $array .= "</div>\n";
        $array .= "</section>\n";
    $array .= "\n";
    return $array;
}