<?php
$xuez_path = "/root/XUEZ/";
$getbalance = shell_exec("sudo " . $xuez_path . "/xuez-cli getbalance");
echo "<h3>" . $getbalance . "</h3>";
?>
