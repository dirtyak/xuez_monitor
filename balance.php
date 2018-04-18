<?php
include 'config.php';

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_PORT => $rpc_port,
  CURLOPT_URL => $rpc_url . ":" . $rpc_port,
  CURLOPT_USERPWD => $rpc_user . ":" . $rpc_password,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POSTFIELDS => "{\n\"jsonrpc\": \"1.0\",\n\"id\":\"curltest\",\n\"method\": \"getmasternodestatus\"\n}",
));
$getmasternodestatus = curl_exec($curl);
$masternodestatus = json_decode($getmasternodestatus);
$mnaddress = $masternodestatus->{'result'}->{'addr'};
curl_close($curl);


$curl2 = curl_init();
curl_setopt_array($curl2, array(
  CURLOPT_PORT => $rpc_port,
  CURLOPT_URL => $rpc_url . ":" . $rpc_port,
  CURLOPT_USERPWD => $rpc_user . ":" . $rpc_password,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POSTFIELDS => "{\n\"jsonrpc\": \"1.0\",\n\"id\":\"curltest\",\n\"method\": \"listaddressgroupings\"\n}",
));
$trygetbalance = curl_exec($curl2);
curl_close($curl2);

$obj = json_decode($trygetbalance);
$obj = $obj->{'result'};


if(!empty($mnaddress)){
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
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_PORT => $rpc_port,
      CURLOPT_URL => $rpc_url . ":" . $rpc_port,
      CURLOPT_USERPWD => $rpc_user . ":" . $rpc_password,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POSTFIELDS => "{\n\"jsonrpc\": \"1.0\",\n\"id\":\"curltest\",\n\"method\": \"getaccount $mnaddress\"\n}",
    ));
    $getaccount = curl_exec($curl);
    curl_close($curl);
  }
}
?>
