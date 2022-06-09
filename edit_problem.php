<?php
include_once("config.php");
include 'header.php';
include 'securizare_pagina.php';
if (isset($_POST['p_id']) && !isset($_POST['update']) && !isset($_POST['sterge'])) {
    $p = $_POST['p_id'];
    $a = "SELECT * FROM problema where id='$p';";
    $sql = mysqli_query($mysqli, $a);
    $row = mysqli_fetch_array($sql);
} else if (isset($_POST['p_id']) && isset($_POST['update']) && !isset($_POST['sterge'])) {
    $p = $_POST['p_id'];
    $newnum = $_POST['n_nume'];
    $newcat = $_POST['n_cat'];
    $newpct = $_POST['n_pct'];
    $newcer = $_POST['n_cer'];
    $newdi = $_POST['n_di'];
    $newdo = $_POST['n_do'];
    $newex = $_POST['n_ex'];
    $result = mysqli_query($mysqli, "UPDATE problema SET id_categorie='$newcat',nume='$newnum',punctaj_maxim='$newpct',cerinta='$newcer',date_intrare='$newdi',date_iesire='$newdo',exemplu='$newex' WHERE id='$p'");
    redirect("probleme.php");
} else if (isset($_POST['p_id']) && !isset($_POST['update']) &&  isset($_POST['sterge'])) {
    $p = $_POST['p_id'];
    $a = "
     FROM problema WHERE id='$p';";
    $sql = mysqli_query($mysqli, $a);
    redirect('probleme.php');
} else redirect("404.php");
include 'footer.php';
?>
<form name="form1" method="post" action="edit_problem.php">
    <table border="0" style="width: 80%; margin:auto;">
        <tr>
            <td>Nume</td>
            <td><input type="text" name="n_nume" value="<?php echo $row['nume']; ?>"></td>
        </tr>
        <tr>
            <td>Categorie</td>
            <td><select name="n_cat">
                    <?php
                    $a2 = "SELECT categorie.nume, categorie.id FROM categorie;";
                    $sql2 = mysqli_query($mysqli, $a2);
                    while ($rez = mysqli_fetch_array($sql2))
                        if ($rez['id'] == $row['id_categorie'])
                            echo "
                    <option value=\"" . $rez['id'] . "\" selected>" . $rez['nume'] . "</option>";
                        else
                            echo "
                    <option value=\"" . $rez['id'] . "\">" . $rez['nume'] . "</option>";
                    ?>
            </td>
            </select>
        </tr>
        <tr>
            <td>Punctaj</td>
            <td><input type="number" max="100" name="n_pct" value="<?php echo $row['punctaj_maxim']; ?>"></td>
        </tr>
        <tr>
            <td>Cerinta</td>
            <td><textarea name="n_cer" cols="30" rows="10"> <?php echo $row['cerinta']; ?> </textarea></td>
        </tr>
        <tr>
            <td>Date intrare</td>
            <td><textarea name="n_di" cols="30" rows="10"> <?php echo $row['date_intrare']; ?> </textarea></td>
        </tr>
        <tr>
            <td>Date iesire</td>
            <td><textarea name="n_do" cols="30" rows="10"> <?php echo $row['date_iesire']; ?> </textarea></td>
        </tr>
        <tr>
            <td>Exemplu</td>
            <td><textarea name="n_ex" cols="30" rows="10"> <?php echo $row['exemplu']; ?> </textarea></td>
        </tr>

        <tr>
            <td><input type="hidden" name="p_id" value="<?php echo $row['id']; ?>"></td>
            <td><center><input class="button" type="submit" name="update" value="Salvare schimbari"></center></td>
        </tr>
    </table>
</form>