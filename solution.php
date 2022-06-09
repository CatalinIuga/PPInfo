<?php
include_once("config.php");
include 'header.php';
include 'securizare_pagina.php';
if (isset($_POST['sterge'])) {
    $id = $_POST['so_id'];
    $sql = mysqli_query($mysqli, "DELETE from rezolvare where id='$id'");
    redirect("solutions.php");
}
if (isset($_POST['noteaza']) && isset($_SESSION['user_id']) && $_SESSION['u_type'] == 1) {
    $solutie = $_POST['so_id'];
    $pctj = $_POST['pct'];
    $utilizator = $_POST['ut_id'];
    $sql = mysqli_query($mysqli, "UPDATE rezolvare SET punctaj='$pctj' where id='$solutie';");
    $sql2 = mysqli_query($mysqli, "UPDATE utilizator set scor=scor+'$pctj' where id='$utilizator';");
    redirect('dash_admin.php');
} else if (isset($_POST['p_id']) && isset($_SESSION['user_id']) && $_SESSION['u_type'] == 1) {
    $p = $_POST['p_id'];
    $s = $_POST['sol_id'];
    $a = "SELECT * FROM problema where id='$p';";
    $b = "SELECT * FROM rezolvare  where id = '$s'";
    $sql = mysqli_query($mysqli, $a);
    $sql2 = mysqli_query($mysqli, $b);
    $row = mysqli_fetch_array($sql);
    $row2 = mysqli_fetch_array($sql2);
    echo "<div style=\"margin-left:5%; margin-right;5%;\"><h1>" . $row['nume'] . "</h1>";
    echo "<h3>Cerita</h3>" . $row['cerinta'] . "</br>";
    echo "<h3>Date intrare</h3>" . $row['date_intrare'] . "</br>";
    echo "<h3>Cerita</h3>" . $row['date_iesire'] . "</br>";
    echo "<h3>Cerita</h3>" . $row['exemplu'] . "</br>";
    echo "<form name=\"add_solution\" method=\"post\" action=\"solution.php\">
    <textarea style=\"width:90%;\" name=\"rezolvare\" cols=\"30\" rows=\"10\" readonly=\"readonly\">" . $row2['rezolvare'] . "</textarea>
    <center>
    <input style=\"width:50%;\" type=\"number\" name=\"pct\" max =\"" . $row['punctaj_maxim'] . "\" value=\"" . $row['punctaj_maxim'] . "\">
    <input type=\"hidden\" name=\"so_id\" value=\"" . $s . "\">
    <input type=\"hidden\" name=\"ut_id\" value=\"" . $row2['id_utilizator'] . "\">
    <button class=\"button\" type=\"submit\"name=\"noteaza\">Noteaza solutia</button>
    </center>
    <form method='post' action='solution.php'>
    <center>
    <input type=\"hidden\" name=\"so_id\" value=\"" . $s . "\">
    <button class='button' type='submit' name='sterge'>Anuleaza si sterge solutia</button>
    </center>
    </form>
    </div>
    ";
} else if (isset($_POST['p_id']) && isset($_SESSION['user_id']) && $_SESSION['u_type'] == 2) {
    $p = $_POST['p_id'];
    $s = $_POST['sol_id'];
    $a = "SELECT * FROM problema where id='$p';";
    $b = "SELECT * FROM rezolvare  where id = '$s'";
    $sql = mysqli_query($mysqli, $a);
    $sql2 = mysqli_query($mysqli, $b);
    $row = mysqli_fetch_array($sql);
    $row2 = mysqli_fetch_array($sql2);
    echo "<div style=\"margin-left:5%; margin-right;5%;\"><h1>" . $row['nume'] . "</h1>";
    echo "<h3>Cerita</h3>" . $row['cerinta'] . "</br>";
    echo "<h3>Date intrare</h3>" . $row['date_intrare'] . "</br>";
    echo "<h3>Cerita</h3>" . $row['date_iesire'] . "</br>";
    echo "<h3>Cerita</h3>" . $row['exemplu'] . "</br>";
    echo "<form name=\"add_solution\" method=\"post\" action=\"solution.php\">
    <textarea style=\"width:90%;\" name=\"rezolvare\" cols=\"30\" rows=\"10\" readonly=\"readonly\">" . $row2['rezolvare'] . "</textarea> 
    <center>
    <a class = 'button' href=\"probleme.php\">Inapoi la treaba</a>
    <a href=\"all_sol.php\">
        Vezi celelalte solutii</a>
        </center>
    </form>
    ";
} else redirect("404.php");
include 'footer.php';
