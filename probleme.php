<?php
require_once("config.php");
include 'header.php';
$start = 0;
$limit = 5;
$id = 1;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $start = ($id - 1) * $limit;
}
if (isset($_POST['categorie'])) {
    $id_c = $_POST['categorie'];
    $a = "SELECT p.id, p.nume as pnume,c.nume,p.punctaj_maxim FROM problema p,categorie c WHERE p.id_categorie = c.id AND c.id ='$id_c' ORDER BY p.nume ASC LIMIT $start, $limit;";
} else
    $a = "SELECT p.id, p.nume as pnume,c.nume,p.punctaj_maxim FROM problema p,categorie c WHERE p.id_categorie = c.id ORDER BY p.nume ASC LIMIT $start, $limit;";
$sql = mysqli_query($mysqli, $a);
?>
<div style="width: 60%; margin-left:auto; margin-right:auto;">
    <label>Categorie</label>
    <form action="probleme.php" method="POST">
        <div style="display:flex;">
            <select name="categorie">
                <?php
                $ab = "SELECT nume, id FROM categorie;";
                $sqls = mysqli_query($mysqli, $ab);
                while ($row2 = mysqli_fetch_array($sqls))
                    echo "<option value=\"" . $row2['id'] . "\">" . $row2['nume'] . "</option>";
                ?>
            </select>
            <button type="submit" class=" button tiny">Fitreaza probleme</button>
        </div>
    </form>
</div>



<table style="text-align:center; width: 80%; margin-left: auto; margin-right:auto;">
    <tr>
        <th>Nume problema</th>
        <th>Categorie</th>
        <th>Punctaj</th>
        <?php
        if (isset($_SESSION['u_type']) && $_SESSION['u_type'] == 1) {
            echo "<th>Editare</th>";
            echo "<th>Sterge</th>";
        }
        ?>
    </tr>
    <?php
    while ($row = $sql->fetch_assoc()) {
        echo "<tr>
        <td><form method=\"post\" action=\"problema.php\"><input type=\"hidden\" name=\"p_id\" value=\"" . $row['id'] . "\">
        <button class=\"button\" type=\"submit\">" . $row["pnume"] . "</button></form></td>
        <td>" . $row["nume"] . "</td>
        <td>" . $row["punctaj_maxim"] . "</td>";
        if (isset($_SESSION['u_type']) && $_SESSION['u_type'] == 1) {
            echo "<td><form method=\"post\" action=\"edit_problem.php\"><input type=\"hidden\" name=\"p_id\" value=\"" . $row['id'] . "\">
            <button class=\"button\" type=\"submit\">Modifica</button></form></td>
            <td><form method=\"post\" action=\"edit_problem.php\"><input type=\"hidden\" name=\"p_id\" value=\"" . $row['id'] . "\">
            <input type=\"hidden\" name=\"sterge\" value=\"true\">
            <button class=\"button\" type=\"submit\">Sterge</button></form></td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    if (!isset($_POST['categorie'])) {
        $rows = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM problema"));
    } else
        $rows = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM problema where id_categorie = $id_c"));
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
    if (isset($_POST['categorie'])) {
        echo "<center><a href=\"probleme.php\">Reset cautare</a></center>";
    }
    include 'footer.php';
    ?>