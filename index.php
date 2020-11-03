<?php
    session_start();
    $_SESSION["array"] = [
        "row1"=>[0, 0, 0, 0, 0, 0, 0],
        "row2"=>[0, 0, 0, 0, 0, 0, 0],
        "row3"=>[0, 0, 0, 0, 0, 0, 0],
        "row4"=>[0, 0, 0, 0, 0, 0, 0],
        "row5"=>[0, 0, 0, 0, 0, 0, 0],
        "row6"=>[0, 0, 0, 0, 0, 0, 0]
    ];
    $_SESSION["player"] = NULL;
    include("template/header.html");
?>
    <header>
        <h1 class="text-capitalize text-center">puissance 4</h1>
    </header>
    <main class="d-flex align-items-center justify-content-center">
        <a href="game.php?page=game" class="btn btn-primary btn-lg btn-block text-capitalize">play !</a>
    </main>
<?php
include("template/footer.html");