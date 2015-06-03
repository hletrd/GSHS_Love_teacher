"use strict";
	var cnt = 0;
	var cnt2 = 0;
	var traffic = 0;
	var interval;
	var power_p = 20;
	var func;
	$(document).ready(function() {
		//for Safari (that ignores CSRF in local file)
		if (navigator.vendor.indexOf('Apple') !== -1) {
			$("#display_safari").css('display', 'block');
		}
		if (window.location.protocol === 'file:' && navigator.vendor.indexOf('Apple') !== -1) {
			func = function() {
				var url = 'http://m.search.naver.com/search.naver?query=%EA%B2%BD%EA%B8%B0%EA%B3%BC%ED%95%99%EA%B3%A0%EB%93%B1%ED%95%99%EA%B5%90+%EC%84%A0%EC%83%9D%EB%8B%98+%EC%82%AC%EB%9E%91%ED%95%B4%EC%9A%94&' + cnt;
				$.ajax({
					url: url
				}).done(function(data, status){
					cnt2++;
					$("#counter_succeed").html(cnt2);
					var total = data.split('<em><strong>')[1].split('</strong>')[0];
					$("#counter_total").html(total);
					traffic += data.length;
					$("#traffic").html((0|traffic / 1048576 * 100)/100);
				}).fail(function(xhr, status) {
					if (status === 'error') {
						location.href = url;
					} else {
						cnt2++;
						$("#counter_succeed").html(cnt2);
						var total = data.split('<em><strong>')[1].split('</strong>')[0];
						$("#counter_total").html(total);
						traffic += data.length;
						$("#traffic").html((0|traffic / 1048576 * 100)/100);
					}
				});
				cnt++;
				$("#counter").html(cnt);
			};
			interval = setInterval(func, power_p);
		} else {
			func = function() {
				var url = 'https://m.search.naver.com/search.naver?where=m&sm=mtp_sug.top&qdt=0&acq=%EA%B2%BD%EA%B8%B0%EA%B3%BC%ED%95%99%EA%B3%A0%EB%93%B1%ED%95%99%EA%B5%90&acr=5&ie=utf8&query=%EA%B2%BD%EA%B8%B0%EA%B3%BC%ED%95%99%EA%B3%A0%EB%93%B1%ED%95%99%EA%B5%90+%EC%84%A0%EC%83%9D%EB%8B%98+%EC%82%AC%EB%9E%91%ED%95%B4%EC%9A%94'//&cache=' + cnt;
				$.post(url).done(function(){
					cnt2++;
					$("#counter_succeed").html(cnt2);
					$("#counter_traffic").html((0|cnt2 * 9900 / 1024)/100);
				}).fail(function() {
					cnt2++;
					$("#counter_succeed").html(cnt2);
					$("#counter_traffic").html((0|cnt2 * 9900 / 1024)/100);
				});
				cnt++;
				$("#counter").html(cnt);
			};
			interval = setInterval(func, power_p);
		}
	});

	function changePower() {
		power_p = 1000 / $("#power").val();
		$("#power_val").html($("#power").val());
		clearInterval(interval);
		interval = setInterval(func, power_p);
	}