<?php
echo "SearchBot-PHP r53\n";

function curlSet(&$ch) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, 'https://m.search.naver.com/search.naver?sm=mtb_hty.top&where=m&query=%EA%B2%BD%EA%B8%B0%EA%B3%BC%ED%95%99%EA%B3%A0%EB%93%B1%ED%95%99%EA%B5%90+%EC%84%A0%EC%83%9D%EB%8B%98+%EC%82%AC%EB%9E%91%ED%95%B4%EC%9A%94');
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	//curl_setopt($ch, CURLOPT_PUT, true);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_NOBODY, false);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('DNT' => '1', 'cache-control' => 'max-age=0'));
	curl_setopt($ch, CURLOPT_COOKIE, '');
}
$ch;
curlSet($ch);
while(1){
	curl_setopt($ch, CURLOPT_REFERER, 'http://' . substr(uniqid(), 1, 8) . '.com/');// . strtoupper(md5(microtime())));
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
	echo 'Now: ';
	echo str_replace(',', '', $match[1]);
	echo "\n";
}
?>