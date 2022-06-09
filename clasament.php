<?php
require_once("config.php");
include 'header.php';
$start = 0;
$limit = 15;
$id = 1;
$i = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $start = ($id - 1) * $limit;
    $i = $start;
}
?>
<center><h1>Clasament utilizator</h1></center>
<table style="text-align:center; width: 80%;   margin-left: auto;
  margin-right: auto; margin-top:2%;">
    <tr>
        <th>Pozitie</th>
        <th>Nume utilizator</th>
        <th>Scor</th>

    </tr>
    <?php
    $useri = mysqli_query($mysqli, "SELECT u.nume, u.scor FROM utilizator u order by scor desc LIMIT $start, $limit;");
    while ($row = $useri->fetch_assoc()) {
        if (isset($_SESSION['nume_utilizator'])) {
            if ($row['nume'] == $_SESSION['nume_utilizator'])
                echo "<tr style=\"background-color:#1779ba\">";
        } else {
            echo "<tr>";
        }
        echo "<td>" . $i + 1 . "</td>
        <td><b>" . $row["nume"] . "</b></td>
        <td>" . $row["scor"] . "</td>
    </tr>";
        $i++;
    }
    echo "</table>";
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

    include 'footer.php';
    ?>