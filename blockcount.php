<?php
include 'config.php';

$getblockcount = shell_exec("sudo " . $xuez_path . "/xuez-cli getblockcount");
$getreportedblock = shell_exec('curl ' . $xuez_explorer . '/api/getblockcount'); # asking block height to explorer

if(empty($getblockcount)){
}
elseif((int)$getblockcount < (int)$getreportedblock){
  echo '<div class="w3-container w3-border-bottom w3-border-black w3-orange w3-padding-16">';
}
elseif((int)$getblockcount >= (int)$getreportedblock){
  echo '<div class="w3-container w3-border-bottom w3-border-black w3-green w3-padding-16">';
}

echo '<div class="w3-right">';
echo "<h3>" . $getblockcount . "</h3>";
echo '</div><div class="w3-clear"></div>';
echo "<h4>Blocks</h4>";
echo "</div>";
?>
