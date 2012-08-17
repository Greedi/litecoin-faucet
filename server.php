<?

/**
 * @author Greedi
 * @copyright 2012
 */
$data = shell_exec('uptime');
$uptime = explode(' up ', $data);
$uptime = explode(',', $uptime[1]);
$uptime = $uptime[0] . ', ' . $uptime[1];

include ("core/wallet.php");
include ('templates/header.php');
?>
        <div class="row">
        <div class="span10">
<?php
if ($_SERVER['REMOTE_ADDR'] != "127.0.0.1") {
    echo '<div class="alert-message error" data-alert="alert" style="margin-right: 20px;"><a class="close" onclick="\$().alert()" href="#">&times</a><p>Access Denied.</p></div>';
} else {
    $finishing_divs = "</div></div>";
    $command = "SELECT * FROM roundltc,dailytotal,round";
    $q = mysql_query($command);
    $dltc = mysql_query("SELECT * FROM `dailyltc`");
    $rows = mysql_num_rows($q);
    $rows2 = mysql_num_rows($dltc);
    $subcommand = "SELECT * FROM subtotal";
    $subq = mysql_query($subcommand);
    $subrows = mysql_num_rows($subq);
    $i = 0;
    while ($i < $rows) {
        $roundltc = mysql_result($q, $i, "roundltc");
        $dailytotal = mysql_result($q, $i, "dailytotal");
        $round = mysql_result($q, $i, "round");
        $i++;
    }

   echo '
            <div style="margin-right: 20px;">
            <h3>Daily statistics</h3>
            <table class=\'zebra-striped\'>
            <tr><td>Submitted This Round: </td><td>' . $rows2 . '</td></tr>
            <tr><td>Current Round: </td><td>' . $round . '</td></tr>
            <tr><td>Payout This Round: </td><td>' . $roundltc . ' LTC</td></tr>
            <tr><td>Total Payout: </td><td>' . $dailytotal . ' LTC</td></tr>
            <tr><td>Total Submitted: </td><td>' . $subrows . '</td></tr> 
            <tr><td>Donate: </td><td>' . $btclient->getbalance($don_faucet, 0) .
        ' LTC</td></tr>
        <tr><td>Donation address: </td><td>' . $btclient->getaccountaddress($don_faucet) .
        '</td></tr>  
            </table>';
    $i++;

?>
            <div style="margin-right: 20px;">
            <h3>Daily settings</h3>
            <table class=\'zebra-striped\'>
    <form action="update/updateroundltc" method="post">
    <input type="hidden" name="ud_id" value="">
    Round Price: <input type="text" name="roundltc" value="">
    <input type="Submit" value="Update">
    </form></table>
    <form action="update/updatetotal" method="post">
    <input type="hidden" name="ud_id" value="">
    Total Paid Out: <input type="text" name="dailytotal" value="">
    <input type="Submit" value="Update">
    </form></table>
    <form action="update/updateround" method="post">
    <input type="hidden" name="ud_id" value="">
    Current Round: <input type="text" name="round" value="">
    <input type="Submit" value="Update">
    </form></table>
    <form action="update/updateaddresses" method="post">
    <input type="hidden" name="ud_id" value="">
    Delete Round: <input type="Submit" value="Update">
    </form></table>
    </div>
<?
    echo '
            <div style="margin-right: 20px;">
            <h3>Litecoind statistics</h3>
            <table class=\'zebra-striped\'>
            <tr><td>Server balance total: </td><td>' . $derp['balance'] .
        ' LTC</td></tr>
            <tr><td>Server connections: </td><td>' . $derp['connections'] .
        '</td></tr>
            <tr><td>Server version: </td><td>' . $derp['version'] . '</td></tr>
            <tr><td>Server protocolversion: </td><td>' . $derp['protocolversion'] .
        '</td></tr>
            <tr><td>Server keypoololdest: </td><td>' . $derp['keypoololdest'] .
        '</td></tr>
            <tr><td>Server keypoolsize: </td><td>' . $derp['keypoolsize'] .
        '</td></tr>
            <tr><td>Server paytxfee: </td><td>' . $derp['paytxfee'] .
        '</td></tr>
            <tr><td>Server minimun input: </td><td>' . $derp['mininput'] .
        '</td></tr>
            <tr><td>Server errors: </td><td>' . $derp['errors'] . '</td></tr>
            
            </table>';

    echo '<h3>Other information</h3>
            <table class=\'zebra-striped\'>
            <tr><td>Server Hostname: </td><td>' . $_SERVER['SERVER_NAME'] .
        '</td></tr>
            <tr><td>Server IP Address: </td><td>' . $_SERVER['SERVER_ADDR'] .
        '</td></tr>
            <tr><td>Server requested file: </td><td>' . $_SERVER['REQUEST_URI'] .
        '</td></tr>
            <tr><td>Server uptime/users online: </td><td>' . $uptime .
        '</td></tr>
            <tr><td>Server time: </td><td>' . date("D M j G:i:s T Y") .
        '</td></tr>
            <tr><td>Your IP/Host: </td><td>' . gethostbyaddr($_SERVER['REMOTE_ADDR']) .
        '</td></tr></table></div>
            <!--<a href="?debug=enable">Enable debugging</a>-->
            <!--<a href="?debug=disable">Disable debugging</a>-->
            <br>
            <center><h3>All Recent transactions</h3></center>

            <table class=\'bordered-table condensed-table zebra-striped\'><tr><td>Confirms</td><td>Address</td><td>Amount</td><td>Fee</td><td>Transaction ID</td></tr>';
    $dump = array_reverse($btclient->listtransactions());


    foreach ($dump as $herp) {
        echo "<tr><td>" . $herp['confirmations'] . "</td><td><input type='text' value='" .
            $herp['address'] . "' /></td><td>" . $herp['amount'] . "</td><td>" . ($herp['fee'] ?
            $herp["fee"] : 0) . "</td><td><input type='text' value='" . $herp['txid'] .
            "' /></td></tr>";
    }
    echo "</table>";
    /**
     * foreach($dump as $ky) {
     * $z = array_keys($dump);
     * if(!$i) $i = 0;
     * echo "<tr><td>" . $z[$i] . "</td><td>" . $ky[0] . "</td></tr>";
     * $i++;
     * }*/
    // print_r($dump);
    //foreach ($dump as $herp) {
    //echo "<tr><td>" . $herp['category'] . "</td><td><input type='text' value='" . $herp['address'] . "' /></td><td>". $herp['amount'] . "</td><td>" . $herp['confirmations'] . "</td><td>" . $herp['fee'] . "</td><td><input type='text' value='" . $herp['txid'] . "' /></td></tr>";
    //}


    // $transactions = $btclient->query('listtransactions', '', '240');
    //$numAccounts = count($transactions);
    // for ($i = 0; $i < $numAccounts; $i++) {
    //echo "lol";
    // }

    echo "<center><h3>Submitted addresses in round</h3></center><br>";
?>
<center><table border="0" cellspacing="2" cellpadding="2">
<tr>
<th><font face="Arial, Helvetica, sans-serif">ID</font></th>
<th><font face="Arial, Helvetica, sans-serif"><center>ltcaddres</center></font></th>
<th><font face="Arial, Helvetica, sans-serif"><center>IP</center></font></th>
</tr>

<?
    $i = 0;
    while ($i < $rows2) {
        $qltc = "SELECT * FROM dailyltc";
        $herp = mysql_query($qltc);
        $rows3 = mysql_num_rows($herp);
        $id = mysql_result($herp, $i, "id");
        $ltcaddres = mysql_result($herp, $i, "ltcaddress");
        $ip = mysql_result($herp, $i, "ip");
?>

<tr>
<td><font face="Arial, Helvetica, sans-serif"><? echo $id; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><center><? echo $ltcaddres; ?></center></font></td>
<td><font face="Arial, Helvetica, sans-serif"><center><? echo $ip; ?></center></font></td>
</tr>

<?
        $i++;
    }

    echo "</table>";


?>
<?
echo $finishing_divs;
    include ('templates/servsidebar.php');
}

?>
