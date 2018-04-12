<?php
echo '<center><div class="ascii-art">';
echo "<a href=http://$serveraddr></br>";
echo "<b><font color=#557>╔═════════════════════════════════╗</b></font></br>";
echo "<b><font color=#559>║  #   #   #   #   #####   #####  ║</b></font></br>";
echo "<b><font color=#55A>║   # #    #   #   #          #   ║</b></font></br>";
echo "<b><font color=#55C>║    #     #   #   ###       #    ║</b></font></br>";
echo "<b><font color=#55D>║   # #    #   #   #        #     ║</b></font></br>";
echo "<b><font color=#55E>║  #   #    ###    #####   #####  ║</b></font></br>";
echo "<b><font color=#55F>╚═════════════════════════════════╝</b></font></br>";
echo "<b>XUEZ_MONITOR</b>@" . $serveraddr . "</a></br>";
echo "$uptime";
echo "Load average : <a>$load</a>";

if(ctype_alnum($getreportedblock)){
echo '<a target="_blank" href=http://' . $xios_explorer . '>Explorer</a> reported Block Height : <a>' . $getreportedblock . '</a></br>';
}else{ echo "ERROR WITH EXPLORER PLEASE CHECK config.php</br>";}

echo '</div>';
echo '</center>';
?>
