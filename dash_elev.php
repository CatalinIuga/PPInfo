<?php
require_once("config.php");
include 'header.php';
include 'securizare_pagina.php';
?>
<center>
    <h1>Aici administrezi contul tau. </h1>
    Ce probleme rezolvam azi? <a href="probleme.php">Uite astea ;)</a>
    <br>
    Rezolvariile tale sunt aici daca ai nevoie de ele: <form action="all_sol.php" method="post">
        <button type="submit" class="button" name="user">Show me the wae...</button>
    </form>
    Poti sa schimbi datele contului tau aici:
    <form action="edit_user.php" method="post">
        <button type="submit" class="button" name="u_id" value="<?php echo $_SESSION['user_id'] ?>">Schimba</button>
    </form>
    Sau chiar sa il stergi daca iti doresti asta:
    <form action="edit_user.php" method="post">
        <input type="hidden" name="sterge">
        <button type="submit" class="button" name="u_id" value="<?php echo $_SESSION['user_id'] ?>">Schimba</button>
    </form>
    <img src="/web_dev/imagini/lol.gif" alt="bruh moment">

</center>
<?php
include 'footer.php';
?>