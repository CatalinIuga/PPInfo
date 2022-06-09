<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PepeInfo</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
</head>

<body>
    <div class="top-bar">
        <div class="top-bar-left">
            <ul class="dropdown menu" data-dropdown-menu>
                <li style="margin-right: 1%;"><img src="/web_dev/imagini\cool_kid.png" alt="lol" width="45" height="50"></li>
                <li><a class="hollow button" href="index.php">PepeInfo</a></li>
                <li><a href="probleme.php">Probleme</a></li>
                <li><a href="clasament.php">Clasament</a></li>
            </ul>
        </div>
        <div class="top-bar-right">
            <ul class="menu">
                <li>
                    <form class="inline_form" method="post" action="search.php">
                <li><input name="cauta" type="search" style="margin-right: 10%;" placeholder="Cauta"></li>
                <li><button type="submit" class="button">Cauta</button></li>
                </form>
                </li>
                <li>
                    <?php
                    if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "") {
                        echo "<a href=\"" . $_SESSION['redir'] . "\">" . $_SESSION['nume_utilizator'] . "</a></li>";
                        echo "<li><a href=\"logout.php\">Logout</a></li>";
                    } else echo "
                <button class=\"button\" style=\"margin-left: 5%;\" type=\"small button\" 
                onclick=\"login()\">Autentificare</button></li>";
                    ?>
            </ul>
        </div>
    </div>