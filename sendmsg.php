<?php
$ch=curl_init();
if ($_POST["isuser"]=="true"){
	$url=$_POST["msgsHost"]."/ME/conversations/8:";
}
else{
	$url=$_POST["msgsHost"]."/ME/conversations/";
}
$url.=$_POST["userid"]."/messages";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$fields=array("content"=>$_POST["msg"], "contenttype"=>"text", "messagetype"=>"Text", "Has-Mentions"=>FALSE, "skypeemoteoffset"=>NULL, "clientmessageid"=>time());
$fields_string=json_encode($fields);
curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
$headers=array("RegistrationToken: registrationToken=".$_POST["regtoken"]);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result=curl_exec($ch);
echo $result;
?>