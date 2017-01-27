<?php
$ch=curl_init();
$url=$_POST["msgsHost"]."/ME/endpoints/".urlencode($_POST["endpoint"])."/presenceDocs/messagingService";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
$headers=array("RegistrationToken: registrationToken=".$_POST["regtoken"]);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$fields_string='{"publicInfo": {"nodeInfo": "xx", "version": "908/1.30.0.128", "type": 1, "skypeNameVersion": "skype.com", "capabilities": ""}, "privateInfo": {"epname": "skype"}, "type": "EndpointPresenceDoc", "id": "messagingService", "selfLink": "uri"}';
curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
$result=curl_exec($ch);
?>