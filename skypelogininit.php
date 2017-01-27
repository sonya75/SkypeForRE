<?php
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, "https://login.skype.com/login/oauth/microsoft?client_id=578134&redirect_uri=https%3A%2F%2Fweb.skype.com");
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$result=curl_exec($ch);
curl_close($ch);
preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
preg_match_all('/<input.*?name="PPFT".*?value="(.*?)"/',$result,$matches1);
$cookies = array();
foreach($matches[1] as $item) {
    parse_str($item, $cookie);
    $cookies = array_merge($cookies, $cookie);
}
$domtree = new DOMDocument('1.0', 'UTF-8');
$domtree->appendChild($domtree->createElement("MSPOK",$cookies["MSPOK"]));
$domtree->appendChild($domtree->createElement("MSPRequ",$cookies["MSPRequ"]));
$domtree->appendChild($domtree->createElement("PPFT",$matches1[1][0]));
header('Content-type: application/xml');
echo $domtree->saveXML();
?>