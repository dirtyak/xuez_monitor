<?php
include 'config.php';

$getconnectioncount = shell_exec("sudo " . $xuez_path . "/xuez-cli getconnectioncount");

if(empty($getconnectioncount)){}
elseif($getconnectioncount == 0){
  echo '<div class="w3-container ww3-border-bottom w3-border-black w3-red w3-padding-16">';
}
elseif($getconnectioncount < 6){
  echo '<div class="w3-container w3-border-bottom w3-border-black w3-orange w3-padding-16">';
}
elseif($getconnectioncount >= 6){
  echo '<div class="w3-container w3-border-bottom w3-border-black w3-green w3-padding-16">';
}

echo '<div class="w3-right">';
echo "<h3>" . $getconnectioncount . "</h3>";
echo '</div><div class="w3-clear"></div>';
echo "<h4>Connections</h4>";
echo "</div>";
?>
