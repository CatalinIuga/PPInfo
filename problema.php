<?php
include_once("config.php");
include 'header.php';
include 'securizare_pagina.php';
if (isset($_POST['p_id']) && isset($_SESSION['user_id'])) {
    $p = $_POST['p_id'];
    $a = "SELECT * FROM problema where id='$p';";
    $sql = mysqli_query($mysqli, $a);
    $row = mysqli_fetch_array($sql);
    $uid = $_SESSION['user_id'];
    echo "<div style=\"margin-left:5%; margin-right;5%;\"><h1>" . $row['nume'] . "</h1>";
    echo "<h3>Cerita</h3>" . $row['cerinta'] . "</br>";
    echo "<h3>Date intrare</h3>" . $row['date_intrare'] . "</br>";
    echo "<h3>Date iesire</h3>" . $row['date_iesire'] . "</br>";
    echo "<h3>Exemplu</h3>" . $row['exemplu'] . "</br>";
    echo "<form name=\"add_solution\" method=\"post\" action=\"add_solution.php\">
    <input type=\"hidden\" name=\"p_id\" value=\"" . $row['id'] . "\">
    <input type=\"hidden\" name=\"p_pct\" value=\"" . $row['punctaj_maxim'] . "\">
    <input type=\"hidden\" name=\"p_util\" value=\"" . $uid . "\">
    <textarea style=\"width:90%\" name=\"rezolvare\" cols=\"30\" rows=\"10\">Rezolvare</textarea>
    <center><button class=\"button\" type=\"submit\">Adauga rezolvare</button></center>
    </div>
    ";
} else redirect("404.php");
?>
<?php
include 'footer.php';
?>