<?php

// ini_set("display_errors", "1");

require_once ('Net/DNSBL.php');

$dnsbl = new Net_DNSBL();

$dnsbl->setBlacklists(array(
    'sbl-xbl.spamhaus.org',
    'bl.spamcop.net',
    'dnsbl-1.uceprotect.net',
    'dnsbl-2.uceprotect.net',
    'dnsbl-3.uceprotect.net',
    'zen.spamhaus.org',
    'rbl.efnetrbl.org'));

function checkIP($ip)
{
    global $dnsbl;
    if ($dnsbl->isListed($ip)) {
        return true;
    } else {
        return false;
    }
}
?>