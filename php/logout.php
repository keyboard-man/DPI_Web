<?php
setcookie("dpi_user","",time()-3600,'/');
setcookie("dpi_password","",time()-36000,'/');
header("Location:../index.php");

echo "true";
?>
