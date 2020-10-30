<?php
    session_start();
    $_SESSION["array"] = [
        [0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0],
    ];
    $_SESSION["player"];
include("template/header.html");
?>
    <header>
        <h1 class="text-capitalize text-center">puissance 4</h1>
    </header>
    <main class="d-flex align-items-center justify-content-center">
        <a href="template/game.html" class="btn btn-primary btn-lg btn-block text-capitalize">play !</a>
    </main>
<?php
include("template/footer.html");