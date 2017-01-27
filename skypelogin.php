<?php
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, "https://login.live.com/ppsecure/post.srf?wa=wsignin1.0&wp=MBI_SSL&wreply=https%3A%2F%2Flw.skype.com%2Flogin%2Foauth%2Fproxy%3Fclient_id%3D578134%26redirect_uri%3Dhttps%253A%252F%252Fweb.skype.com%252F%26site_name%3Dlw.skype.com");
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$cookie="MSPRequ=".urlencode($_POST["MSPRequ"])." ;MSPOK=".urlencode($_POST["MSPOK"])." ;CkTst=".(time());
curl_setopt($ch, CURLOPT_COOKIE, $cookie);
$fields = array('login'=>urlencode($_POST["user"]),'passwd'=>urlencode($_POST["pass"]),'PPFT'=>urlencode($_POST["PPFT"]));
$fields_string="";
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
$fields_string = rtrim($fields_string,'&');
curl_setopt($ch, CURLOPT_POST,count($fields));
curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
$result=curl_exec($ch);
preg_match_all('/<input.*?id="t".*?value="(.*?)"/',$result,$matches);
echo $matches[1][0];
?>