from bs4 import BeautifulSoup
import requests
url = "https://www.bienaljamonroy.mx/convocatoria.php"
response = requests.get(url)
soup = BeautifulSoup(response.content,"html.parser")
string = soup.prettify()
path = './index.html'

with open(path,'w') as file:
    file.write(string)

























