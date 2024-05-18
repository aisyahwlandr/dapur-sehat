<?php
session_start();
session_destroy();
header("Location: /dapursehat/auth/auth.php");
exit();
?>
