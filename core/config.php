<?
// Donation account
$don_faucet = "FaucetDonations";

// RPC Settings
$btclogin = array("username" => "username", "password" => "pass",
    "host" => "localhost", "port" => "9332");

// DB Settings
$sqlogin = array("host" => "localhost", "dbname" => "faucet", "username" =>
    "root", "password" => "pass");

// sending settings ..
$minleft = 0.01; // minimum left on account
$minsend = 0.5; // minimum allowed to send at a time

// NOT IMPLEMENTED YET ...
$minfee = 0.1; // min. hard fee on all transactions
$feeperc = 0.5; // fee for outgoing transactions in percentage
$fee_account = "KgHL1urqk1roN0eX67sC"; // set to your own KEY to recieve fee´s there


$adscaptchaID = 3170;
$adspubkey = "d655966c-541e-44c8-9a7d-a4f48a3d51a3";
$adsprivkey = "484fa3ac-8fcb-470f-8ee4-a3a91568071c";
?>