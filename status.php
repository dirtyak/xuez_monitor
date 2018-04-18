<?php
include 'config.php';

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_PORT => $rpc_port,
  CURLOPT_URL => $rpc_url . ":" . $rpc_port,
  CURLOPT_USERPWD => $rpc_user . ":" . $rpc_password,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POSTFIELDS => "{\n\"jsonrpc\": \"1.0\",\n\"id\":\"curltest\",\n\"method\": \"getconnectioncount\"\n}",
));
$getconnectioncount = curl_exec($curl);
$getconnectioncount = json_decode($getconnectioncount);
$getconnectioncount = $getconnectioncount->{'result'};
curl_close($curl);

if(!empty($getconnectioncount)){
  echo '<div class="w3-container w3-border-bottom w3-border-black w3-green w3-padding-16"><div class="w3-right">';
  echo '<h3>Online</h3>';
  echo "</div>";
  echo '<div class="w3-clear"></div>';
  echo "<h4>XUEZd</h4>";
  echo "</div>";
}


?>
