import sys
f = open("/var/www/html/euronews.php", 'w')
sys.stdout = f

import urllib, ssl

print '<?php'

#Informacoes do stream
url = "https://pt.euronews.com/api/watchlive.json"
request = urllib.urlopen(url)
lines = request.readlines()
for line in lines:
	if 'url' in line: #Carater , ou palavra, identificador da linha.
		str1 = line.split('"')[3] #Carater divisor "()" e saltos entre o divisor "[]" ate chegar ao url.

stream_info = ("https:" + str1.replace("\/", "/")) #Muda \/ para /.

#Link do stream c/ origem em "Informacoes do stream"
request = urllib.urlopen(stream_info)
lines = request.readlines()
for line in lines:
	if '{' in line: #Carater , ou palavra, identificador da linha.
		str2 = line.split('"')[11] #Carater divisor "()" e saltos entre o divisor "[]" ate chegar ao url.

stream_link = (str2.replace("\/", "/")) #Muda \/ para /.

#Imprime o url com token
print 'header("Location:', stream_link,'");'
print '?>'
f.close()
