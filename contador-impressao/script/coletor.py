import requests
from pysnmp.hlapi import *

URL = "http://127.0.0.1:8000/api"

OID_CONTADOR = '1.3.6.1.2.1.43.10.2.1.4.1.1'


def pegar_contador(ip):
    iterator = getCmd(
        SnmpEngine(),
        CommunityData('public', mpModel=0),
        UdpTransportTarget((ip, 161), timeout=2, retries=1),
        ContextData(),
        ObjectType(ObjectIdentity(OID_CONTADOR))
    )

    errorIndication, errorStatus, errorIndex, varBinds = next(iterator)

    if errorIndication or errorStatus:
        print(f"Erro SNMP em {ip}")
        return None

    for varBind in varBinds:
        return int(varBind[1])


# pega impressoras da API
resposta = requests.get(f"{URL}/impressoras")

if resposta.status_code != 200:
    print("Erro ao buscar impressoras")
    exit()

impressoras = resposta.json()

for imp in impressoras:
    print(f"\n {imp['nome']} ({imp['ip']})")

    contador = pegar_contador(imp['ip'])

    if contador is None:
        print(" Falha ao coletar")
        continue

    print(f"✔ Contador: {contador}")

    # envia para Laravel
    resp = requests.post(f"{URL}/leitura", json={
        "impressora_id": imp['id'],
        "contador": contador
    })

    print("Status POST:", resp.status_code)
    print("Resposta:", resp.text)