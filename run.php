<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, 'https://m.search.naver.com/search.naver?query=경기과학고등학교+선생님감사합니다&where=m&sm=mtp_hty');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_PUT, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_NOBODY, false);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8', 'accept-encoding' => 'gzip, deflate, sdch', 'accept-language' => 'ko,en-US;q=0.8,en;q=0.6,ja;q=0.4,und;q=0.2'));
curl_setopt($ch, CURLOPT_REFERER, 'http://m.naver.com');
while(1){
	$data = curl_exec($ch);
	if (!preg_match('/<em><strong>([0-9,]+)<\/strong>/', $data, $match)) {
		echo "Failed...\n";
		sleep(30);
		$cookie_nnb =  md5(microtime());
		$cookie_usr =  md5(uniqid(true));
		curl_setopt($ch, CURLOPT_COOKIE, 'NNB=' . $cookie_nnb . '; page_uid=SAnqKdpySANssZu/2Sosss--' . floor(rand(100000, 999999)) . '; _naver_usersession_=' . $cookie_usr);
		continue;
	}
	echo $match[1];
	echo "\n";
}
?>