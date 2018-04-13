<?php
include 'config.php';

$getconnectioncount = shell_exec("sudo " . $xuez_path . "/xuez-cli getconnectioncount");

if(!isset($getconnectioncount)){
  echo '<div class="w3-container w3-red w3-padding-16"><div class="w3-right">';
  echo '<h3>Offline</h3>';}
else{
  echo '<div class="w3-container w3-green w3-padding-16"><div class="w3-right">';
  echo '<h3>Online</h3>';}

echo "</div>";
echo '<div class="w3-clear"></div>';
echo "<h4>Status</h4>";
echo "</div>";
?>
