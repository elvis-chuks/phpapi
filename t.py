import requests

resp = requests.delete('http://localhost/weby/?endpoint=/v1/test&name=elvischuks&class=400l&id=1')
print(resp.content)