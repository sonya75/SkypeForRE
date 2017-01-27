<?php
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, "https://client-s.gateway.messenger.live.com/v1/users/ME/endpoints");
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$headers=array("LockAndKey: ".($_POST["LockAndKey"]),"Authentication: ".($_POST["Authentication"]),"Content-Type: application/json");
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$fields_string='{"endpointFeatures": "Agent"}';
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
$domtree = new DOMDocument('1.0', 'UTF-8');
$result=curl_exec($ch);
list($headers, $body) = explode("\n\n", $result, 2);
$headers = explode("\n", $headers);
foreach ($headers as $header) {
    list($key, $value) = explode(':', $header, 2);
    $headers[trim($key)] = trim($value);
}
preg_match_all("/registrationToken=(.*?);/", $headers["Set-RegistrationToken"], $matches);
$domtree->appendChild($domtree->createElement("regtoken",$matches[1][0]));
preg_match_all("/expires=(.*?);/", $headers["Set-RegistrationToken"], $matches);
$domtree->appendChild($domtree->createElement("expires",$matches[1][0]));
preg_match_all("/endpointId=({[a-z0-9\-]+})/", $headers["Set-RegistrationToken"], $matches);
$endpoint=$matches[1][0];
if (isset($headers["Location"])){
	preg_match_all("/(https:\/\/[^\/]+\/v1)\/users\/ME\/endpoints(\/(%7B[a-z0-9\-]+%7D))?/", $headers["Location"], $locparts);
	var_dump($locparts);
	if (!($locparts[1][0]=="https://client-s.gateway.messenger.live.com/v1")){
		if (isset($locparts[3][0])){
			$num=4;
			$endpoint=str_replace("%7B","{",$locparts[3][0]);
			$endpoint=str_replace("%7D","}",$endpoint);
		}
		else{
			$num=3;
			$endpoint=json_decode($body,TRUE)[0]["id"];
		}
		$msgsHost=strrev(explode("/",strrev($headers["Location"]),$num)[$num-1]);
		$domtree->appendChild($domtree->createElement("msgsHost",$msgsHost));
	}
}
$domtree->appendChild($domtree->createElement("endpoint",$endpoint));
echo $domtree->saveXML();
?>