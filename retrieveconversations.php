<?php
$count=0;
while (TRUE){
	$count+=1;
	$url=$_POST["msgsHost"]."/ME/conversations?startTime=0&view=msnp24Equivalent&targetType=Passport|Skype|Lync|Thread|PSTN|Agent";
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	$headers=array("RegistrationToken: registrationToken=".$_POST["regtoken"]);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result=curl_exec($ch);
	$result=json_decode($result,TRUE);
	foreach ($result["conversations"] as $res){
		if (array_key_exists("threadProperties", $res)){
			if (strpos($res["threadProperties"]["topic"],$_POST["topic"])!==FALSE){
				echo $res["threadProperties"]["topic"]."\n\n\n".$res["id"];
				exit();
			}
		}
	}
	if (($count>=10)||($result["_metadata"]["totalCount"]==0)){
		exit();
	}
}
?>