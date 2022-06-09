<?php
require_once("config.php");
include 'header.php';
include 'securizare_pagina.php';
?>
<table style="width: 80%;margin-left:auto; margin-right:auto;">
    <tr>
        <th colspan="2"><h1>MENIU CENTRAL</h1></th>
    </tr>
    <tr>
        <td>Adaugare unei probleme</td>
        <td><a class="button" data-open="adauga_problema">Adauga</a></td>
    </tr>
    <tr>
        <td>Verficare solutii</td>
        <td><a class="button" href="solutions.php">Verificare</a></td>
    </tr>
    <tr>
        <td>Toate solutiile (inclusiv cele corectate)</td>
        <td><a class="button" href="all_sol.php">Toate solutiile</a></td>
    </tr>

    <tr>
        <td>
            Administrare utilizatori
        </td>
        <td>
            <a class="button" href="users.php">Utilizatori</a>
        </td>
    </tr>

</table>

<div class="reveal" id="adauga_problema" data-reveal>
    <form method="post" action="adaugare_administrator.php">
        <div>
            <input type="hidden" name="question" value="true">
            <h3 style="text-align: center;">Adauga intrebare</h3>
            <br>
            <label>Nume intrebare:</label>
            <input type="text" name="q_name" required>
            <label for="cat">Categorie</label>
            <select name="q_cat">
                <?php
                $a = "SELECT categorie.nume, categorie.id FROM categorie;";
                $sql = mysqli_query($mysqli, $a);
                while ($row = mysqli_fetch_array($sql))
                    echo "
                    <option value=\"" . $row['id'] . "\">" . $row['nume'] . "</option>";
                ?>
            </select>
            <label>Punctaj:</label>
            <input type="number" name="q_pct" value="100" max=100>
            <textarea name="q_cerinta" cols="30" rows="10" required>Certinta</textarea>
            <textarea name="q_DI" cols="30" rows="10" required>Date intrare</textarea>
            <textarea name="q_DO" cols="30" rows="10" required>Date iesire</textarea>
            <textarea name="q_exem" cols="30" rows="10" required>Exemplu</textarea>
            <button class="button" type="submit">Finalizat</button>
        </div>
    </form>
</div>

<?php
include 'footer.php';
?>