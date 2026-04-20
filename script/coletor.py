from pathlib import Path
import logging
import os
import sys
import requests
from pysnmp.hlapi import *

BASE_DIR = Path(__file__).resolve().parent
LOG_FILE = BASE_DIR / 'coletor.log'
URL = os.environ.get('API_URL', 'http://127.0.0.1:8000') + '/api'
OID_CONTADOR = '1.3.6.1.2.1.43.10.2.1.4.1.1'

logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s [%(levelname)s] %(message)s',
    handlers=[
        logging.FileHandler(LOG_FILE, encoding='utf-8'),
        logging.StreamHandler(sys.stdout)
    ]
)


def pegar_contador(ip):
    iterator = getCmd(
        SnmpEngine(),
        CommunityData('public', mpModel=0),
        UdpTransportTarget((ip, 161), timeout=5, retries=1),
        ContextData(),
        ObjectType(ObjectIdentity(OID_CONTADOR))
    )

    errorIndication, errorStatus, errorIndex, varBinds = next(iterator)

    if errorIndication:
        logging.warning('Erro SNMP em %s: %s', ip, errorIndication)
        return None

    if errorStatus:
        logging.warning('Erro SNMP em %s: %s at %s', ip, errorStatus.prettyPrint(), errorIndex)
        return None

    for varBind in varBinds:
        try:
            return int(varBind[1])
        except (ValueError, TypeError) as exc:
            logging.warning('Valor SNMP inválido em %s: %s', ip, exc)
            return None


def main():
    try:
        with requests.Session() as session:
            try:
                resposta = session.get(f"{URL}/impressoras", timeout=10)
            except requests.RequestException as exc:
                logging.error('Erro ao conectar na API: %s', exc)
                sys.exit(1)

            if resposta.status_code != 200:
                logging.error('Erro ao buscar impressoras: %s %s', resposta.status_code, resposta.text)
                sys.exit(1)

            impressoras = resposta.json()
            logging.info('Foram encontradas %d impressora(s) na API', len(impressoras))

            for imp in impressoras:
                nome = imp.get('nome', 'sem-nome')
                ip = imp.get('ip')

                if not ip:
                    logging.warning('Impressora %s não possui IP', nome)
                    continue

                logging.info('Iniciando coleta para %s (%s)', nome, ip)
                contador = pegar_contador(ip)

                if contador is None:
                    logging.warning('Falha ao coletar contador para %s', nome)
                    continue

                logging.info('Contador %s: %s', nome, contador)

                try:
                    resp = session.post(f"{URL}/leitura", json={
                        'impressora_id': imp['id'],
                        'contador': contador,
                    }, timeout=10)
                except requests.RequestException as exc:
                    logging.error('Erro ao enviar leitura: %s', exc)
                    continue

                if resp.status_code != 200:
                    logging.error('POST /leitura retornou %s: %s', resp.status_code, resp.text)
                    continue

                logging.info('Leitura enviada com sucesso para %s', nome)

    except Exception as exc:
        logging.error('Erro inesperado: %s', exc)
        sys.exit(1)


if __name__ == '__main__':
    main()
