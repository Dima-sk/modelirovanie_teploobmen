<?php
$bytes=bin2hex(openssl_random_pseudo_bytes(20));
    $query="UPDATE users SET Token='$bytes' 
    	WHERE login='$login'";

?>

