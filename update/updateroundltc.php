<?
/**
 * @author Greedi
 * @copyright 2012
 */
 ini_set("display_errors", 1);
include('/var/www/faucet/core/wallet.php');

$roundltc = $_POST['roundltc'];

    $result = mysql_query("UPDATE roundltc SET roundltc = $roundltc") 
    or die(mysql_error());
    
    header( 'Location: http://beprivate.info/faucet/server.php' ) ;  
?>


