<?php
$page = basename($_SERVER['PHP_SELF']);
$IdUser = $_SESSION["user_id"];

if (isset($_SESSION['u_type'])) {
    $tip = $_SESSION['u_type'];
    $querry = mysqli_query($mysqli, "SELECT pagina FROM pagini where type = '$tip' and pagina ='$page'");
    $row = mysqli_num_rows($querry);
    if ($row == 0)
        redirect("404.php");
} else
    redirect("loginregister.html");
