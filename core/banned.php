<?php

/**
 * @author Greedi
 * @copyright 2012
 */

$banlist = array("158.145.240.100");
$myip = $_SERVER['REMOTE_ADDR'];
if (in_array($myip, $banlist)) {
    exit("<center>You are banned sucka!<br>
    #litecoin @ FreeNode</center>");
}
?>