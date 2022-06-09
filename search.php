<?php
include_once("config.php");
include 'header.php';

if (isset($_POST['cauta'])) {
    $p = $_POST['cauta'];
    $a = "SELECT DISTINCT p.nume as pnume,c.nume, p.id, p.punctaj_maxim  FROM problema p, categorie c WHERE (p.nume like'%$p%' or p.id='$p') AND p.id_categorie = c.id;";
    $sql = mysqli_query($mysqli, $a);
}
?>

<table style="width: 80%; margin-left: auto; margin-right:auto; text-align:center;">
    <tr>
        <th>Nume problema</th>
        <th>Categorie</th>
        <th>Punctaj maxim</th>
        <?php
        if (isset($_SESSION['u_type']) && $_SESSION['u_type'] == 1) {
            echo "<th>Editare</th>";
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
            <button class=\"button\" type=\"submit\">Edit</button></form></td>";
        }
        echo "</tr>";
    }
    echo "</table>";

    include 'footer.php';
    ?>