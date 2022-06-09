<?php
require_once("config.php");
include 'header.php';
include 'securizare_pagina.php';
if (isset($_POST['use_id'])) {
    $u_id = $_POST['use_id'];
    $u_nume = $_POST['username'];
    $u_mail = $_POST['mail'];
    $u_password = $_POST['password'];
    $u_scoala = $_POST['school'];
    if ($_SESSION['u_type'] == 1) {
        $u_scpr = $_POST['scpr'];
        $u_rol = $_POST['role'];
        $q = "UPDATE utilizator set nume = '$u_nume',email='$u_mail',parola='$u_password',scor='$u_scpr',scoala='$u_scoala',tip='$u_rol' where id = '$u_id'";
    }
    else{
        $q = "UPDATE utilizator set nume = '$u_nume',email='$u_mail',parola='$u_password',scoala='$u_scoala' where id = '$u_id'";
    }
    $sql2 = mysqli_query($mysqli, $q);
    if ($_SESSION['u_type'] == 1) 
        redirect("users.php");
    else
        redirect("dash_elev.php");
}

if (isset($_POST['u_id']) && !isset($_POST['sterge'])) {
    $id = $_POST['u_id'];
    $sql = mysqli_query($mysqli, "SELECT u.nume,u.id,u.email,u.scoala,ut.type,u.tip,u.scor,u.parola FROM utilizator u, user_type ut  where u.tip = ut.id and u.id = '$id'");
    $row = $sql->fetch_assoc();
    echo "<form method=\"post\" action=\"edit_user.php\" style=\"width:45%; margin-left:auto; margin-right:auto;\">
    <h3>Modifica datele utilizatorului</h3>
    <input type='hidden' name='use_id'value ='" . $id . "'>
    <label>Nume:</label>
    <input type=\"text\" name=\"username\" value=" . $row['nume'] . ">
    <label>Email:</label>
    <input type=\"email\" name=\"mail\" value=" . $row['email'] . ">
    <label>Parola:</label>
    <input type=\"text\" name=\"password\" value=" . $row['parola'] . ">
    <label>Scoala:</label>
    <input type=\"text\" name=\"school\" value=" . $row['scoala'] . ">";
    if ($_SESSION['u_type'] == 1) {
        echo "<label>Scor:</label>
    <input type=\"number\" name=\"scpr\" value=" . $row['scor'] . ">
    <label>Rol:</label>
    <select name='role'>";
        if ($row['tip'] == 2) {
            echo "<option value=\" 2\" selected>user</option>
        <option value=\"1\">admin</option>";
        } else {
            echo "<option value=\"1\" selected>admin</option>
        <option value=\"2\">user</option>";
        }
        echo "</select>";
    }
    echo "<button class=\"button\" type=\"submit\">Modifica</button>
</form>";
} else if (isset($_POST['u_id']) && isset($_POST['sterge'])) {
    $id = $_POST['u_id'];
    $sql = mysqli_query($mysqli, "DELETE FROM utilizator where id = '$id'");
    if($_SESSION['u_type']==1)
        redirect('users.php');
    else{
        redirect("logout.php");
    }
}
include 'footer.php';
