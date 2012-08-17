<?
function returntimer ($pagetimer) {
  // better then previous but still bit shitty assumes all pages are +10ms :)
  $timer = timer()-$pagetimer;
  if ($timer[0] == 0) {
    if (substr($timer,2,1) == 0)
    $timer = substr($timer,3,2). " ms"; // +10 ms
    else
    $timer = substr($timer,2,3). " ms"; // +100 ms
  }
  else {
    $timer = $timer."  sec";
  }
  return $timer;
}

function timer () {
  $a = explode (' ',microtime());
  return(double) $a[0] + $a[1];
}

function checkExistingIP($ip)
{
    $q = mysql_query("SELECT `ip` FROM `dailyltc` WHERE `ip`='{$ip}' LIMIT 1");
    $rows = mysql_num_rows($q);
    return $rows;
}
function srsnot($srserror) {
  return '          <div class="alert-message alert" data-alert="alert" style="margin-right: 20px;"><p>' . $srserror . '</p></div>';
}
function srserr($srserror) {
  return '          <div class="alert-message error" data-alert="alert" style="margin-right: 20px;"><p>' . $srserror . '</p></div>';
}
?>