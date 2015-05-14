<?php
echo "SearchBot-PHP r47\n";

function curlSet(&$ch) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, 'https://m.search.naver.com/search.naver?query=경기과학고등학교+선생님+감사합니다&where=m&sm=mtp_hty');
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_PUT, true);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_NOBODY, false);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('DNT' => '1', 'cache-control' => 'max-age=0'));
	curl_setopt($ch, CURLOPT_COOKIE, 'J3H8DJ3H8DJ3H8DJ3H8DJ3H8DJ3H8DRE');
	curl_setopt($ch, CURLOPT_REFERER, md5(microtime()));
}
$ch;
curlSet($ch);
while(1){
	$data = curl_exec($ch);
	preg_match_all('/Set-Cookie: (.*)\r/u', $data, $cookie);
	curl_setopt($ch, CURLOPT_COOKIE, $cookie[1][0] . ';' . $cookie[1][1] . ';');
	if (!preg_match('/<em><strong>([0-9,]+)<\/strong>/', $data, $match)) {
		echo "Failed...\n";
		sleep(30);
		curl_close($ch);
		curlSet($ch);
		continue;
	}
	echo '경기과학고등학교: ';
	echo str_replace(',', '', $match[1]);
	echo "\n";
}
?>