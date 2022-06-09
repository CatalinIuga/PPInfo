<?php
include_once("config.php");
include 'header.php';
include 'securizare_pagina.php';
$ipn = $icat = $pctj = $cer = $di = $do = $ex = $img = "";
if (isset($_POST['question'])) {
    $inp_type = $_POST['question'];
    $ipn = $_POST['q_name'];
    $icat = $_POST['q_cat'];
    $pctj = $_POST['q_pct'];
    $cer = $_POST['q_cerinta'];
    $di = $_POST['q_DI'];
    $do = $_POST['q_DO'];
    $ex = $_POST['q_exem'];

    $sql = "INSERT INTO problema(id_categorie,nume,punctaj_maxim,cerinta,date_intrare,date_iesire,exemplu) VALUES('$icat','$ipn','$pctj','$cer','$di','$do','$ex')";
    $results = mysqli_query($mysqli, $sql);
    if (!$results)
        die('Invalid querry:' . mysqli_error($mysqli));
    else {
        echo "<div style=\"margin:25px;\">
        Problema adaugata cu succes!
        <form method=\"post\" action=\"problema.php\"><input type=\"hidden\" name=\"p_id\" value=\"" . mysqli_insert_id($mysqli) . "\">
        <button class=\"button\" type=\"submit\">Vizualizare problema   " . $ipn . "</button></form>
        <a href=\"dash_admin.php\">Inapoi la dashboard</a>
        </div>";
        // redirect("problema.php");
    }
} else if (isset($_POST[''])) {
    $inp_type = $_POST[''];
}
include 'footer.php';
?>
