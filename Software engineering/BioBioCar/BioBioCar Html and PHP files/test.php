<?php
session_start();


$deadmanwalking = $_SESSION['username'];

echo "Testeando si la sesion de " .$deadmanwalking. " se mantiene";




?>
<br>
<a href="terminar_sesion.php">The end is NEAR</a>