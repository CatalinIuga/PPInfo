<?php
require_once("config.php");
include 'header.php';
include 'securizare_pagina.php';
$start = 0;
$limit = 5;
$id = 1;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $start = ($id - 1) * $limit;
}
if (!isset($_POST['search'])) {
    $useri = mysqli_query($mysqli, "SELECT u.id,u.nume,ut.type,u.email,u.scor FROM utilizator u, user_type ut WHERE u.tip=ut.id ORDER BY u.nume ASC LIMIT $start, $limit ");
} else {
    $nume_id = $_POST['uidname'];
    $useri = mysqli_query($mysqli, "SELECT u.id,u.nume,ut.type,u.email,u.scor FROM utilizator u, user_type ut WHERE u.tip=ut.id AND (u.nume like '%$nume_id%' or u.id='$nume_id') ORDER BY u.nume ASC");
}
?>
<form action="users.php" method="POST" style="width:60%; margin-left:auto; margin-right:auto;  margin-top:5px; display:flex;">
    <input type="search" placeholder="Cauta utilizator sau id" name="uidname">
    <input type="hidden" name="search" value="search">
    <button class="button" type="submit">Cauta</button>
</form>


<table style="text-align:center;">
    <tr>
        <th>Nume utilizator</th>
        <th>Tip</th>
        <th>Email</th>
        <th>Scor</th>
        <th>Editare</th>
        <th>Sterge</th>
    </tr>
    <?php
    while ($row = $useri->fetch_assoc()) {
        echo "<tr><td>" . $row["nume"] . "</td>
                <td>" . $row["type"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["scor"] . "</td>
                <td>
                <form method=\"post\" action=\"edit_user.php\">
                    <input type=\"hidden\" name=\"u_id\" value=\"" . $row['id'] . "\">
                    <button class=\"button\" type=\"submit\">Modifica</button></form></td>
                <td>
                <form method=\"post\" action=\"edit_user.php\">
                    <input type=\"hidden\" name=\"u_id\" value=\"" . $row['id'] . "\">
                    <input type=\"hidden\" name=\"sterge\" value=\"true\">
                <button class=\"button\" type=\"submit\">Sterge</button></form></td></tr>";
    }
    echo "</table>";
    if (!isset($_POST['search'])) {
        $rows = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM utilizator"));
        $total = ceil($rows / $limit);
        echo "<ul  class=\"pagination text-center\">";
if ($id > 1) {
    echo "<li class=\"pagination-previous\"><a href='?id=" . ($id - 1) . "'>previous</a></li>";
}




for ($i = 1; $i <= $total; $i++) {
    if ($i == $id) {
        echo "<li class='current'>" . $i . "</li>";
    } else {
        echo "<li><a href='?id=" . $i . "'>" . $i . "</a></li>";
    }
}
if ($id != $total) {
    echo " <li class=\"pagination-next\"><a href='?id=" . ($id + 1) . "'>next</a></li>";
}

echo "</ul>";
    }
    else{
       echo "<a href=\"users.php\">Reset cautare</a>";
    }
    ?>
    </form>

    <?php
    include 'footer.php';
    ?>