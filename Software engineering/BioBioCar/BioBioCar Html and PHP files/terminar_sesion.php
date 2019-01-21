<?php
	session_start();
	echo "Sesión cerrada correctamente";
	session_destroy();
?>
<meta http-equiv="refresh" content="3;url=index.html"/>