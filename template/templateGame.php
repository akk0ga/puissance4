<?php
session_start();
include ("fonctions.php");
echo generateHead(strval($_GET["page"]), "fr", "UTF-8", "puissance4" );
?>
<header>
        <h1 class="text-center">Puissance 4</h1>
</header>
<main>
    <?php 
    echo generateSection(6, 7, "", "", "graphic", "", "graphic");
    echo generateSection(6, 7, "post", "#", "", "commande", "interactive");
    ?>
</main>
<?php
    include("templateFooter.html");
?>