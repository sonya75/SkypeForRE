<?php
$url=str_replace("/users","",$_POST["msgsHost"])."/threads/".$_POST["id"]."?view=msnp24Equivalent";
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$headers=array("RegistrationToken: registrationToken=".$_POST["regtoken"]);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result=curl_exec($ch);
echo json_decode($result,TRUE)["id"];
?>