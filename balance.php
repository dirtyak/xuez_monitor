<?php
include 'config.php';

$getmasternodestatus = shell_exec("sudo " . $xuez_path . "/xuez-cli getmasternodestatus");
$masternodestatus = json_decode($getmasternodestatus);
$mnaddress = $masternodestatus->{'addr'};

if(!empty($mnaddress)){
  $trygetbalance = shell_exec("sudo " . $xuez_path . "/xuez-cli listaddressgroupings");
  $obj = json_decode($trygetbalance);
  for ($i = 0; $i < count($obj); $i++) {
    if($obj[$i][0][0] == ($mnaddress))
    {
      $getbalance = $obj[$i][0][1];
    }
  }

  if(!empty($getbalance)){
    ###$getbalance = number_format((float)$getbalance, 6);
    echo '<div class="w3-container w3-border-bottom w3-border-black w3-blue w3-text-white w3-padding-16">';
    echo '<div class="w3-right">';
    echo "<h3>" . $getbalance . "</h3>";
    echo '</div>';
    echo '<div class="w3-clear"></div>';
    echo '<h4>Balance</h4>';
    echo '</div>';
  }
  elseif(empty($getbalance)){
    shell_exec("sudo " . $xuez_path . "/xuez-cli getaccount " . $mnaddress);
  }
}
?>
