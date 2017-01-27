<?php
error_reporting(0);
$ch=curl_init();
$url=$_POST["msgsHost"]."/ME/presenceDocs/messagingService?view=expanded";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$headers=array("RegistrationToken: registrationToken=".$_POST["regtoken"]);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result=curl_exec($ch);
$result=json_decode($result,TRUE)["endpointPresenceDocs"];
foreach ($result as $res){
	echo (explode("/",$res["link"])[7]."\n");
}
?>