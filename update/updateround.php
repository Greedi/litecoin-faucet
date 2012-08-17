<?
/**
 * @author Greedi
 * @copyright 2012
 */
include('/var/www/faucet/core/wallet.php');

$round = $_POST['round'];

    $result = mysql_query("UPDATE round SET round = $round") 
    or die(mysql_error());
    
    header( 'Location: http://beprivate.info/faucet/server.php' ) ;  
?>


