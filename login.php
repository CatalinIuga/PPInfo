<?php
include 'config.php';

if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "") {
   redirect($_SESSION['redir']);
}
if (isset($_POST['nume']) && isset($_POST['parola'])) {
   $username = trim($_POST['nume']);
   $password = trim($_POST['parola']);

   if ($username != "" && $password != "") {
      $sql = "SELECT * FROM utilizator WHERE nume = '$username' AND parola='$password'";
      $rezultat = mysqli_query($mysqli, $sql);
      if (!$rezultat) {
         die('Invalid querry:' . mysqli_error($mysqli));
      } else {
         $row = mysqli_fetch_array($rezultat);
         $sql1 = "SELECT ut.redirect FROM utilizator u , user_type ut  WHERE u.id = '$row[id]' and u.tip = '$row[tip]' and u.tip = ut.id ;";
         $result = mysqli_query($mysqli, $sql1);
         $l = mysqli_fetch_array($result);
         $_SESSION['u_type'] = $row['tip'];
         $_SESSION['user_id'] = $row['id'];
         $_SESSION['nume_utilizator'] = $row['nume'];
         $_SESSION['redir'] = $l['redirect'];
         redirect($_SESSION['redir']);
      }
   }
} else
   redirect('loginregister.html');
