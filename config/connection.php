<?php
	require 'constant.php';
	$connection = mysqli_connect (DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if (!$connection)
		{die("could not connect" .  mysqli_connect_error());
	}
 ?>   