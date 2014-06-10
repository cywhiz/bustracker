<?php
// ========================SET POST DATA============================ 
$postData['__VIEWSTATE'] = urlencode('/wEPDwUKMTEyNzgzNTMwNWQYAQUeX19Db250cm9sc1JlcXVpcmVQb3N0QmFja0tleV9fFgEFC2Noa1JlbWVtYmVyx8uSDKpWaj0PCdQMD3QalOR9t7g=');
$postData['__EVENTVALIDATION'] = urlencode('/wEWBAL4irf3BgLBvcrOCwKj962LDwLR55GJDl53ktVJs+iblsnq55FNxpyEwyHm');
$postData['btnEnglishCanada'] = urlencode('');

foreach ($postData as $key => $value) {
	$postItems[] = $key . '=' . $value;
}
$postString = implode ('&', $postItems);

// ========================SET COOKIES============================
$url = 'http://ca.megabus.com/landingcanada.aspx';
$userAgent = 'Mozilla/5.0 (Windows NT 6.1; rv:17.0) Gecko/20100101 Firefox/17.0';
$cookieFile = 'cookie_mega.txt';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$html = curl_exec($ch);
curl_close($ch);
?>
