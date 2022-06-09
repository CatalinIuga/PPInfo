<?php
require_once("config.php");
include 'header.php';
include 'securizare_pagina.php';
if (isset($_POST['p_id'])) {
    $id = mysqli_real_escape_string($mysqli, $_POST['p_id']);
    $pct_max = mysqli_real_escape_string($mysqli, $_POST['p_pct']);
    $user = mysqli_real_escape_string($mysqli, $_POST['p_util']);
    $sol = $_POST['rezolvare'];
    $sql = "INSERT INTO rezolvare(id_problema,id_utilizator,rezolvare) VALUES($id,$user,'$sol')";
    $results = mysqli_query($mysqli, $sql);
    if (!$results)
        die('Invalid querry:' . mysqli_error($mysqli));
    else {
        $id_sol = mysqli_insert_id($mysqli);
        echo "<div style=\"margin-top:5%; text-align:center;\">Solutia a fost adaugata cu success! </br><form method=\"post\" action=\"solution.php\">
        <input type=\"hidden\" name=\"p_id\" value=\"" .$id . "\">
        <button class=\"button\" type=\"submit\" name=\"sol_id\" value='$id_sol' >Vizualizare solutie</button></form>
        <a href=\"probleme.php\">Sau rezolva alta problema aici</a>
        </div>";
    }
}
include 'footer.php';
?>