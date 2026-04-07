from pysnmp.hlapi import *

ip = "192.168.250.223"  

iterator = getCmd(
    SnmpEngine(),
    CommunityData('public', mpModel=0),
    UdpTransportTarget((ip, 161)),
    ContextData(),
    ObjectType(ObjectIdentity('1.3.6.1.2.1.43.10.2.1.4.1.1'))  # contador geral
)

errorIndication, errorStatus, errorIndex, varBinds = next(iterator)

if errorIndication:
    print("Erro:", errorIndication)
elif errorStatus:
    print("Erro SNMP:", errorStatus.prettyPrint())
else:
    for varBind in varBinds:
        print("Resultado:", varBind)