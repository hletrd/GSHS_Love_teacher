import requests, re

while True:
r = requests.get('https://m.search.naver.com/search.naver?query=경기과학고등학교%20선생님%20감사합니다&where=m&sm=mtp_hty')

m = re.search(r'<em><strong>([0-9,]+)<\/strong>', r.text)
print('경기과학고등학교 {}회'.format(m.group(1)))