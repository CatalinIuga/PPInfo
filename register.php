<?php
include_once("config.php");
$usernume = $mail = $school = $password = "";

if (empty($_POST["username"]) || empty($_POST['password']) || empty($_POST['school']) || empty($_POST['mail'])) {
   redirect("loginregister.html");
} else {
   $usernume =  $_POST["username"];
   $mail =  $_POST["mail"];
   if (!filter_var($mail, FILTER_VALIDATE_EMAIL)){
      redirect("loginregister.html");
      $usernume = $mail = $school = $password = "";
   }
   $school =  $_POST["school"];
   $password = $_POST["password"];
}
$aux = "SELECT * FROM utilizator u WHERE u.email ='$mail'";
$aux2 = mysqli_query($mysqli, $aux);

$aux3 = "SELECT * FROM utilizator u WHERE u.nume ='$usernume'";
$aux4 = mysqli_query($mysqli, $aux3);
if (mysqli_num_rows($aux2) > 0 || mysqli_num_rows($aux4) > 0) {
   echo "Email-ul este deja folosit!";
   redirect("loginregister.html");
} else {
   $sql = "INSERT INTO utilizator(tip,nume,email,parola,scoala) VALUES('2','$usernume','$mail','$password','$school')";
   $results = mysqli_query($mysqli, $sql);
   if (!$results)
      die('Invalid querry:' . mysqli_error($mysqli));
   else {
      echo "Cont creeat cu succes!</br>";
      $id = mysqli_fetch_array(mysqli_query($mysqli, "SELECT u.id, ut.redirect FROM utilizator u, user_type ut WHERE u.nume = '$usernume' AND u.parola ='$password' AND u.tip = 2 and ut.type ='utilizator'"));
      $_SESSION['u_type'] = 2;
      $_SESSION['user_id'] = $id['id'];
      $_SESSION['nume_utilizator'] = $usernume;
      $_SESSION['redir'] = $id['redirect'];
      redirect($_SESSION['redir']);
   }
}
