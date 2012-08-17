<?php
$ADSCAPTCHA_API = 'api.adscaptcha.com';
	
function GetCaptcha($captchaId, $publicKey) {
	global $ADSCAPTCHA_API;

	$dummy = rand(1, 9999999999);
	$urlGet = 'http://' . $ADSCAPTCHA_API . "/Get.aspx";
	$urlNoScript = 'http://' . $ADSCAPTCHA_API . "/NoScript.aspx";
	$params = "?CaptchaId="  . $captchaId . 
			  "&PublicKey=" . $publicKey . 
			  "&Dummy=" . $dummy;
	
	$result  = "<script src='" . $urlGet . $params . "' type='text/javascript'></script>\n";
	$result .= "<noscript>\n";
	$result .= "\t<iframe src='" . $urlNoScript . $params . "' width='300' height='100' frameborder='0'></iframe>\n";
	$result .= "\t<table>\n";
	$result .= "\t<tr><td>Type challenge here:</td><td><input type='text' name='adscaptcha_response_field' value='' /></td></tr>\n";
	$result .= "\t<tr><td>Paste code here:</td><td><input type='text' name='adscaptcha_challenge_field' value='' /></td></tr>\n";
	$result .= "\t</table>\n";
	$result .= "</noscript>\n";
	
	return $result;
}

function ValidateCaptcha($captchaId, $privateKey, $challengeValue, $responseValue, $remoteAddress) {
	global $ADSCAPTCHA_API;

	$host = $ADSCAPTCHA_API; 
	$path = "/Validate.aspx";
	
	$params = "CaptchaId=" . $captchaId . "&PrivateKey=" . $privateKey . "&ChallengeCode=" . $challengeValue . "&UserResponse=" . $responseValue . "&RemoteAddress=" . $remoteAddress;
		
	$result = HttpPost($host, $path, $params);

	return $result;
}

function FixEncoding($str) { 	
	$curr_encoding = mb_detect_encoding($str) ; 
	
	if($curr_encoding == "UTF-8" && mb_check_encoding($str,"UTF-8")) {
		return $str; 
	} else {
		return utf8_encode($str); 
	}
}

function HttpPost($host, $path, $data, $port = 80) {
	$data = FixEncoding($data);
	
	$http_request  = "POST $path HTTP/1.0\r\n";
	$http_request .= "Host: $host\r\n";
	$http_request .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$http_request .= "Content-Length: " . strlen($data) . "\r\n";
	$http_request .= "\r\n";
	$http_request .= $data;

	$response = '';
	if (($fs = @fsockopen($host, $port, $errno, $errstr, 10)) == false) {
		die ('Could not open socket! ' . $errstr);
	}
	
	fwrite($fs, $http_request);

	while (!feof($fs))
		$response .= fgets($fs, 1160);
	fclose($fs);
	
	$response = explode("\r\n\r\n", $response, 2);
	return $response[1];
}
?>