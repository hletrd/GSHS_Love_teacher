<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, 'https://m.search.naver.com/search.naver?query=경기과학고등학교+선생님감사합니다&where=m&sm=mtp_hty');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_PUT, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_NOBODY, false);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)');
curl_setopt($ch, CURLOPT_REFERER, md5(microtime()));
while(1){
	$data = curl_exec($ch);
	if (!preg_match('/<em><strong>([0-9,]+)<\/strong>/', $data, $match)) {
		echo "Failed...\n";
		sleep(30);
		curl_setopt($ch, CURLOPT_REFERER, md5(microtime()));
		continue;
	}
	echo $match[1];
	echo "\n";
}
?>