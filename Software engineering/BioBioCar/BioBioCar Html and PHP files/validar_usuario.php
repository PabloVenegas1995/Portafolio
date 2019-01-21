<?php
session_start();
?>
<html>
<body>

</body>
</html>
<?php

$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b") or die ('ERROR'. pg_last_error());

  echo "<br>";
  $user1 = $_POST["username"];
  $pass1 = $_POST["password"];
  $type1 = $_POST["typeuser"];

  //echo "Username de session es: " .$user1;echo "<br>";
//  echo $pass1;echo "<br>";
//  echo $type1;echo "<br>";

$result = pg_query($db, "SELECT *
                        FROM iteracion2.usuario as U, iteracion2.$type1 as T
                        WHERE U.username = '$user1' AND U.password = '$pass1' and T.username = '$user1'");
$nrow = pg_num_rows($result);
echo "<br>";
if (!$nrow)
{
//echo "Login Incorrecto, volviendo atras";
?>
<meta http-equiv="refresh" content="0;url=index.html" />
<?php
} else
{
//echo "Login CORRECTO IT WORKS";echo "<br>";
//echo $type1; echo "<br>";
if ( $type1 == 'conductor'){

$_SESSION['username'] = $user1;
$_SESSION['usertype'] = $type1;
?>
<meta http-equiv="refresh" content="0;url=conductor.php" />
<?php
}
else {
$_SESSION['username'] = $user1;
$_SESSION['usertype'] = $type1;
?>
<meta http-equiv="refresh" content="1;url=test2.php" />
<?php
}
}
?>

<!-- En pagina siguiente agreagar en la parte de php  al principio

session_start();

y cuando se ocupe el usuario se define en esa pagina la variable de esta forma
$variableName = $_SESSION['usuario'];

-->
