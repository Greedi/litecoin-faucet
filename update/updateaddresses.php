<?
/**
 * @author Greedi
 * @copyright 2012
 */
include('/var/www/faucet/core/wallet.php');

$dailytotal = $_POST['delete'];

    mysql_query("DELETE FROM dailyltc") 
    or die(mysql_error());
    
    header( 'Location: http://beprivate.info/faucet/server.php' ) ;  
?>


