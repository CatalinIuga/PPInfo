<?php
include_once("config.php");
include 'header.php';
include 'securizare_pagina.php';
$start = 0;
$limit = 5;
$id = 1;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $start = ($id - 1) * $limit;
}
?>
<table style="width: 80%; margin-left:auto; margin-right:auto; margin-top:5px; text-align:center;">
    <tr>
        <th colspan="4">Rezolvari care au fost incarcate de utilizatori si trebuie notate:</th>
    </tr>
    <tr>
        <th>ID solutie</th>
        <th>Nume problema</th>
        <th>Categorie</th>
        <th>Punctaj maxim</th>
    </tr>
    <?php
    $sql = mysqli_query($mysqli, "SELECT * FROM rezolvare WHERE punctaj is null LIMIT $start, $limit;");
    while ($row = $sql->fetch_assoc()) {
        // echo $row['id'] . $row['id_problema'] . $row['id_utilizator'] . $row['rezolvare'] . "</br>";
        $id_problema = $row['id_problema'];
        $sql2 = mysqli_query($mysqli, "SELECT p.nume as pbnume, p.punctaj_maxim, c.nume FROM problema p, categorie c WHERE p.id = '$id_problema' AND p.id_categorie = c.id;");
        $rezultat = $sql2->fetch_assoc();
        $clasa = $rezultat['nume'];
        $nume_problema = $rezultat['pbnume'];
        echo "<tr><td>
                <form method=\"post\" action=\"solution.php\">
                <input type=\"hidden\" name=\"sol_id\" value=\"" . $row['id'] . "\">
                <input type=\"hidden\" name=\"p_id\" value=\"" . $id_problema . "\"> 
                <button class=\"button\" type=\"submit\">Solutie " . $row['id'] . "</button> 
            </form>
            <td>" . $nume_problema . "</td>
            <td>" . $clasa . "</td>
            <td>" . $rezultat["punctaj_maxim"] . "</td></tr>";
    } ?>
</table>


<?php
$rows = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM rezolvare where punctaj is null"));
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
include 'footer.php';
?>