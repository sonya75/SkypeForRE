<?php
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, "https://login.skype.com/login/microsoft?client_id=578134&redirect_uri=https%3A%2F%2Fweb.skype.com");
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$fields = array('t'=>urlencode($_POST["t"]),'client_id'=>"578134",'oauthPartner'=>'999','site_name'=>'lw.skype.com','redirect_uri'=>'https://web.skype.com');
$fields_string="";
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
$fields_string = rtrim($fields_string,'&');
curl_setopt($ch, CURLOPT_POST,count($fields));
curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
$result=curl_exec($ch);
$fp=fopen("ffg.html",'w');
fwrite($fp,$result);
fclose($fp);
preg_match_all('/<input.*?name="skypetoken".*?value="(.*?)"/',$result,$matches);
$domtree = new DOMDocument('1.0', 'UTF-8');
$domtree->appendChild($domtree->createElement("skypetoken",$matches[1][0]));
preg_match_all('/<input.*?name="expires_in".*?value="(.*?)"/',$result,$matches);
$domtree->appendChild($domtree->createElement("expires",$matches[1][0]));
header('Content-type: application/xml');
echo $domtree->saveXML();
?>