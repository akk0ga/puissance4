<?php
generateHead(strval($_GET["page"]), "fr", "UTF-8", "puissance4");
generateHeader("puissance 4", $_SESSION["player"], $checkWin);
?>
<main>
    <?php
        generateSection(6, 7, "", "", "visual", "", "graphic", $_SESSION["firstTurn"], $checkWin);
        generateSection(6, 7, "post", "#", "", "commande", "interactive", $_SESSION["firstTurn"], $checkWin);
    ?>
</main>
<?php
    include("templateFooter.html");
?>