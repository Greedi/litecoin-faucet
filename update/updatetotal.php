<?
/**
 * @author Greedi
 * @copyright 2012
 */
include('/var/www/faucet/core/wallet.php');

$dailytotal = $_POST['dailytotal'];

    mysql_query("UPDATE dailytotal SET dailytotal = $dailytotal") 
    or die(mysql_error());
    
  header( 'Location: http://beprivate.info/faucet/server.php' ) ; 
?>


