<?php
include 'config.php';

$getbalance = shell_exec("sudo " . $xuez_path . "/xuez-cli getbalance");

if(!empty($getbalance))
{
  $getbalance = number_format((float)$getbalance, 6);
  echo '<div class="w3-container w3-border-bottom w3-border-black w3-blue w3-text-white w3-padding-16">';
  echo '<div class="w3-right">';
  echo "<h3>" . $getbalance . "</h3>";
  echo '</div>';
  echo '<div class="w3-clear"></div>';
  echo '<h4>Balance</h4>';
  echo '</div>';
}



?>
