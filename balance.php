<?php
include 'config.php';

$getbalance = shell_exec("sudo " . $xuez_path . "/xuez-cli getbalance");

if(isset($getbalance))
{
  $getbalance = number_format($getbalance, 6);
  echo '<div class="w3-container w3-blue w3-text-white w3-padding-16">';
}
else
{
echo '<div class="w3-container w3-dark-grey w3-text-white w3-padding-16">';
}

echo '<div class="w3-right">';
echo "<h3>" . $getbalance . "</h3>";
echo '</div>';
echo '<div class="w3-clear"></div>';
echo '<h4>Balance</h4>';
echo '</div>';

?>
