<?php
include 'config.php';

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_PORT => $rpc_port,
  CURLOPT_URL => $rpc_url . ":" . $rpc_port,
  CURLOPT_USERPWD => $rpc_user . ":" . $rpc_password,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POSTFIELDS => "{\n\"jsonrpc\": \"1.0\",\n\"id\":\"curltest\",\n\"method\": \"getblockcount\"\n}",
));
$getblockcount = curl_exec($curl);
$getblockcount = json_decode($getblockcount);
$getblockcount = $getblockcount->{'result'};
curl_close($curl);

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
