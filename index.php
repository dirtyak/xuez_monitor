<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="/style/style.css">
  </head>

<!--- Import config.php ------------------->
<?php require '/var/www/html/config.php'; ?>

<!--- Define some PHP variables ---------------------------------------------------------------------------------------------->
<?php
$load = shell_exec("uptime | grep -ohe 'load average[s:][: ].*' | awk '{ print $3 $4 $5 }'");
$uptime = shell_exec('uptime -p'); # system uptime
$serveraddr = $_SERVER['SERVER_ADDR'];
$getreportedblock = shell_exec('curl ' . $xuez_explorer . '/api/getblockcount'); # asking block height to explorer
?>

    <header>

<!--- Show the Banner ------------------->
<?php include '/var/www/html/banner.php'; ?>

    </header>

<body>
<div class="container">
<section id="main_content">


<?php
echo '<div class="floating-box">';

    $getblockcount = shell_exec("sudo " . $xuez_path . "/xuez-cli getblockcount | tr '\n' ' '");
    $xuezaddress0 = shell_exec("sudo " . $xuez_path . "/xuez-cli getaccountaddress 0");
    $getinfo = shell_exec("sudo " . $xuez_path . "/xuez-cli getinfo | grep -E '\"balance|blocks|connection'");
    $mngetinfo = shell_exec("sudo " . $xuez_path . "/xuez-cli masternode status");
    $stakinginfo = shell_exec("sudo " . $xuez_path . "/xuez-cli getstakingstatus | grep -E 'unlock|enough|status'");

    if ((int)$getreportedblock == (int)$getblockcount) {
      echo '<pre class="online"><b><font color=greenyellow>' . $xuez_name . '' . $howmany . '</b>@' . $serveraddr . ':' . $xuez_port . ' >> ONLINE</font>';
      echo '</br>ADDR(0) : <a href=http://' . $xuez_explorer . '/address/' . $xuezaddress0 . '>' . $xuezaddress0 . '</a>';
      echo '</br>GETINFO : </br>' . $getinfo . '';
      echo '</br>MASTERNODE STATUS : </br>' . $mngetinfo . '';
      echo '</br>STAKING : </br>' . $stakinginfo . '';
    } elseif ((int)$getreportedblock < (int)$getblockcount) {
      echo '<pre class="syncing"><b><font color=orange>' . $xuez_name . '' . $howmany . '</b>@' . $serveraddr . ':' . $xuez_port . ' >> ONLINE [SYNCING]</font>';
      echo '</br>ADDR(0) : <a href=http://' . $xuez_explorer . '/address/' . $xuezaddress0 . '>' . $xuezaddress0 . '</a>';
      echo '</br>GETINFO : </br>' . $getinfo . '';
      echo '</br>MASTERNODE STATUS : </br>' . $mngetinfo . '';
      echo '</br>STAKING : </br>' . $stakinginfo . '';
    } else {
      echo '<pre class="offline"><b><font color=red>' . $xuez_name . '' . $howmany . '</b>@' . $serveraddr . ':' . $xuez_port . ' >> OFFLINE [ERROR]</font>';
      echo '</br>Please start xuez daemon (' . $xuez_path . 'xuezd)';
    }


    //echo '</br>RECEIVED : ' . $received . '</pre>';
    echo '</div>';
?>

<?php include "/var/www/html/footer.html";?>
