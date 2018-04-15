<?php
include 'config.php';

$getinfo = shell_exec("sudo " . $xuez_path . "/xuez-cli getinfo");
$obj = json_decode($getinfo);
$stakingstatus = $obj->{'staking status'};
$difficulty = $obj->{'difficulty'};

$getstakingstatus = shell_exec("sudo " . $xuez_path . "/xuez-cli getstakingstatus");
$stake = json_decode($getstakingstatus);
$walletunlocked = $stake->{'walletunlocked'};
$enoughcoins = $stake->{'enoughcoins'};

$getmasternodestatus = shell_exec("sudo " . $xuez_path . "/xuez-cli getmasternodestatus");

$getnetworkinfo = shell_exec("sudo " . $xuez_path . "/xuez-cli getnetworkinfo");
$networkinfo = json_decode($getnetworkinfo);
$version = $networkinfo->{'subversion'};
$ipv4 = $networkinfo->{'localaddresses'}[0]->{'address'};

$getmasternodestatus = shell_exec("sudo " . $xuez_path . "/xuez-cli getmasternodestatus");
$masternodestatus = json_decode($getmasternodestatus);
$netaddr = $masternodestatus->{'netaddr'};
$mnaddress = $masternodestatus->{'addr'};

$listtransactions = shell_exec("sudo " . $xuez_path . "/xuez-cli listtransactions");
$txlist = json_decode($listtransactions);

$listmasternodes = shell_exec("sudo " . $xuez_path . "/xuez-cli listmasternodes");
$mnlist = json_decode($listmasternodes);

  for ($i = 0; $i < count($mnlist); $i++) {
      if($mnlist[$i]->{'addr'} == $mnaddress)
      {
        $mnstatus = $mnlist[$i]->{'status'};
        $mnnetwork = $mnlist[$i]->{'network'};

        if($mnlist[$i]->{'lastseen'} == 0){
          $mnlastseen = "Not yet";
        }
        else{
          $mnlastseen = date('d/m/Y H:i:s', $mnlist[$i]->{'lastseen'});
        }

        if($mnlist[$i]->{'lastpaid'} == 0){
          $mnlastpaid = "Not yet";
        }
        else{
          $lastpaid = $mnlist[$i]->{'lastpaid'};
          $interval =  time() - $lastpaid ;
          $sincelastpaid = number_format(($interval / 3600), 0);
          $mnlastpaid = date('d/m/Y H:i:s', $mnlist[$i]->{'lastpaid'});
        }

        if($mnlist[$i]->{'activetime'} == 0){
          $mnactivetime = "Not yet";
        }
        else{
          $mnactivetime = number_format(($mnlist[$i]->{'activetime'} / 86400), 1);
        }
      }
    }

$load1 = shell_exec("uptime | grep -ohe 'load average[s:][: ].*' | awk '{ print $3 }' | sed s/,//g");
$load2 = shell_exec("uptime | grep -ohe 'load average[s:][: ].*' | awk '{ print $4 }' | sed s/,//g");
$load3 = shell_exec("uptime | grep -ohe 'load average[s:][: ].*' | awk '{ print $5 }'");
$loadp1 = ((float)$load1 * 100);
$loadp1 = ($loadp1.'%');
$loadp2 = ((float)$load2 * 100);
$loadp2 = ($loadp2.'%');
$loadp3 = ((float)$load3 * 100);
$loadp3 = ($loadp3.'%');

$timenow = date('d/m/Y H:i:s', microtime(true));
$uptime = shell_exec('uptime -p'); # system uptime
?>

<!DOCTYPE html>
<html>
<title>XUEZ NODE MONITOR</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">

  <span class="w3-bar-item w3-right"><b>xuez_monitor</b> | <?php print $version;?></span>
</div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-top:23px;">

  <!-- Header -->
<?php include 'header.php'; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <div class="w3-row-padding w3-margin-bottom">
    <div id="status" class="w3-quarter">
    </div>
    <div id="mnstatus" class="w3-quarter">
    <?php
    if($mnstatus == "MISSING"){
      echo '<div class="w3-container w3-border-bottom w3-border-black w3-red w3-padding-16"><div class="w3-right">';
      echo '<h3>' . $mnstatus . '</h3>';
      echo "</div>";
      echo '<div class="w3-clear"></div>';
      echo "<h4>Masternode</h4>";
      echo "</div>";
    }
    elseif($mnstatus == "ENABLED"){
      echo '<div class="w3-container w3-border-bottom w3-border-black w3-green w3-padding-16"><div class="w3-right">';
      echo '<h3>Enabled</h3>';
      echo "</div>";
      echo '<div class="w3-clear"></div>';
      echo "<h4>Masternode</h4>";
      echo "</div>";
    }
    ?>
    </div>
    <div id="connectioncount" class="w3-quarter">
    </div>
    <div id="blockcount" class="w3-quarter">
    </div>
      <div id="mnnetwork" class="w3-quarter">

    <?php
    if(empty($mnnetwork)){
    }
    elseif(!empty($mnnetwork)){
      echo '<div class="w3-container w3-border-bottom w3-border-black w3-teal w3-padding-16"><div class="w3-right">';
      echo '<h3>' . $mnnetwork . '</h3>';
      echo "</div>";
      echo '<div class="w3-clear"></div>';
      echo "<h4>Network</h4>";
      echo "</div>";
    }
    ?>

    </div>
    <div id="activetime" class="w3-quarter">
    <?php
    if(empty($mnactivetime)){}
    elseif(!empty($mnactivetime)){
      echo '<div class="w3-container w3-border-bottom w3-border-black w3-purple w3-padding-16"><div class="w3-right">';
      echo '<h3>' . $mnactivetime . ' days</h3>';
      echo "</div>";
      echo '<div class="w3-clear"></div>';
      echo "<h4>Active</h4>";
      echo "</div>";}
    ?>
    </div>
    <div id="lastpaid" class="w3-quarter">

    <?php
      if(empty($mnlastpaid)){}
      elseif(!empty($mnlastpaid)){
      if($sincelastpaid < 24){
        echo '<div class="w3-container w3-border-bottom w3-border-black w3-green w3-padding-16"><div class="w3-right">';
      }
      elseif($sincelastpaid >= 24){
        echo '<div class="w3-container w3-border-bottom w3-border-black w3-orange w3-padding-16"><div class="w3-right">';
      }
      echo '<h3>' . $sincelastpaid . ' hours</h3>';
      echo "</div>";
      echo '<div class="w3-clear"></div>';
      echo "<h4>Last Paid</h4>";
      echo "</div>";}
    ?>

    </div>
    <div id="balance" class="w3-quarter">
    </div>
  </div>

  <?php
    echo '</span>';
    echo '<div class="w3-container">';
    echo '<ul class="w3-ul w3-card-4">';

    if(!empty($getinfo)){
      if(!empty($mnaddress)){
        echo '<li class="w3-padding-16 w3-white">';
        echo '<span class="w3-xlarge">';
        echo 'Masternode Address : <tr>' . $mnaddress . '</tr>';
      }
      elseif(empty($mnaddress)){
        echo '<li class="w3-padding-16 w3-orange">';
        echo '<span class="w3-xlarge">';
        echo 'XUEZ Daemon is running but is not a Masternode';
      }
    }
    else{
      echo '<li class="w3-padding-16 w3-orange">';
      echo '<span class="w3-xlarge">';
      echo 'Your XUEZ node is <b>offline</b> or <b>not found</b>';
      echo '</br>';
      echo '- This script needs latest <b><a href="https://github.com/XUEZ/xuez/releases">xuez-linux-cli</a></b> !';
      echo '</br>';
      echo '- Make sure <b>config.php</b> is filled...';
      echo '</br>';
      echo '- Run <b>./xuezd</b></br>';
    }
    echo '</li>';
    echo '</ul>';
    echo '</div>';
  ?>

  <?php
  if(!empty($mnstatus)){
        echo '<div id="masternode" class="w3-container">';
        echo '<br>';
        echo '<h3>Masternode Status</h3>';
        echo '<ul class="w3-ul w3-card-4 w3-white">';
        echo '<li class="w3-padding-16"><span class="w3-xlarge">Status : ' . $mnstatus . '</span></li>';
        echo '<li class="w3-padding-16"><span class="w3-xlarge">Time now : ' . $timenow . ' (UTC)</span></li>';
        echo '<li class="w3-padding-16"><span class="w3-xlarge">Last Seen : ' . $mnlastseen . ' (UTC)</span></li>';
        echo '<li class="w3-padding-16"><span class="w3-xlarge">Last Paid : ' . $mnlastpaid . ' (UTC)</span></li>';
        echo '</span>';
        echo '</span>';
        echo '</span>';
        echo '</ul>';
        echo '</div>';
  }
  ?>

  <br>

  <?php if(isset($txlist)){
    echo '<div id="txlist" class="w3-container">';
    echo   '<h3>Transactions</h3>';
    echo   '<table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">';
    echo     '<tr>';
    echo       '<td><b>Date</b></td>';
    echo       '<td><b>Time (UTC)</b></td>';
    echo       '<td><b>Category</b></td>';
    echo       '<td><b>Address</b></td>';
    echo       '<td><b>Amount</b></td>';
    echo     '</tr>';

    for ($i = 0; $i < count($txlist); $i++) {
        echo "<tr>";
        echo "<td>" . date('d/m/Y', $txlist[0]->{'timereceived'}) . "</td>";
        echo "<td>" . date('H:i:s', $txlist[0]->{'timereceived'}) . "</td>";
        echo "<td>" . $txlist[$i]->{'category'} . "</td>";
        echo "<td><a href=http://xuez.donkeypool.com/tx/" . $txlist[$i]->{'txid'} . ">" . $txlist[$i]->{'address'} . "</td>";
        echo "<td>" . $txlist[$i]->{'amount'} . "</td>";
        echo "</tr>";
    }

echo '</table><br>';
echo '</div>';
}
?>

  <div id="system" class="w3-container">
    <h3>System Info</h3>
    <p>Host</p>
    <div>
      <div class="w3-container w3-dark-grey w3-padding" ><b><?php echo $ipv4 ?></b></div>
    </div>
    <p>Uptime</p>
    <div>
      <div class="w3-container w3-dark-grey w3-padding" ><b><?php $uptime = shell_exec('uptime -p'); echo $uptime?></b></div>
    </div>
    <p>Load Average (1m / 5m / 15m)</p>
    <div class="w3-dark-grey">
      <div class="w3-container w3-center w3-padding w3-<?php if((int)$loadp1 <= 33){echo "green";} elseif((int)$loadp1 < 75){echo "orange";} elseif((int)$loadp1 >= 75){echo "red";}?>" style="width:<?php echo $loadp1?>"><b><?php echo $load1?></b></div>
      <div class="w3-container w3-center w3-padding w3-<?php if((int)$loadp2 <= 33){echo "green";} elseif((int)$loadp2 < 75){echo "orange";} elseif((int)$loadp2 >= 75){echo "red";}?>" style="width:<?php echo $loadp2?>"><b><?php echo $load2?></b></div>
      <div class="w3-container w3-center w3-padding w3-<?php if((int)$loadp3 <= 33){echo "green";} elseif((int)$loadp3 < 75){echo "orange";} elseif((int)$loadp3 >= 75){echo "red";}?>" style="width:<?php echo $loadp3?>"><b><?php echo $load3?></b></div>
    </div>
  </div>
  <hr>

  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-dark-grey">
    <h3 class="w3-bottombar w3-border-blue">Support XUEZ</h3>
    <p>Source code on <a href="https://github.com/dirtyak/xuez_monitor" target="_blank">GitHub</a></p>
    <p>XUEZ Links :
      <a href="http://xuez.donkeypool.com">Explorer</a> |
      <a href="https://discordapp.com/invite/3Yypx4C">Discord</a> |
      <a href="https://xuezcoin.com/">Website</a>
    </p>
  </footer>

  <script>
    function loadlink(){
      $( "#status" ).load( "status.php" );
      $( "#connectioncount" ).load( "connectioncount.php" );
      $( "#blockcount" ).load( "blockcount.php" );
      $( "#balance" ).load( "balance.php" );
    }

    loadlink(); // This will run on page load
    setInterval(function(){
        loadlink() // this will run after every 5 seconds
    }, <?php echo ($refresh_delay * 1000);?>);
  </script>

  <!-- End page content -->
</div>

</body>
</html>
