<?
// LTC WALLET
session_start();
include("functions.php");
$start = timer();

include("config.php");
include("bitcoin.inc");
include("address.inc");
include("recaptchalib.inc");
include ("adscaptchalib.inc");

//captha
$publickey = "6LfYSssSAAAAAF2w_TeMklmv-6VWUDhcECr9rWfI";
$privatekey = "6LfYSssSAAAAAPntQz9H0twbsdyk8kQHO_F4mupD";

// init

$btclient = new bitcoinClient("http",$btclogin["username"],$btclogin["password"],$btclogin["host"],$btclogin["port"]);
$addr = new Address($btclient,$sqlogin);
$derp = $btclient->getinfo();

//$this->PDO_Conn = new PDO("mysql:host={$sqllogin['host']};dbname={$sqllogin['dbname']}", $sqllogin['username'], $sqllogin['password']);
$dbconn = mysql_connect($sqlogin['host'],$sqlogin['username'],$sqlogin['password']);
mysql_select_db($sqlogin['dbname']);

// time for pages ..




?>