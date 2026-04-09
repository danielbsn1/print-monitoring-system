#  Sistema de Monitoramento de Impressoras

Este projeto é um sistema para coleta automática de contadores de impressoras em rede utilizando **SNMP**, com armazenamento e visualização via **Laravel**.

---

##  Funcionalidades

*  Coleta automática de contadores via SNMP
*  Suporte a múltiplas impressoras (Konica, Xerox, etc.)
*  Armazenamento das leituras no banco de dados
*  Cálculo automático de consumo entre leituras
*  Interface web para visualização
*  Execução automatizada (Task Scheduler)

---

##  Tecnologias utilizadas

* **Laravel (PHP)**
* **Python 3.11**
* **pysnmp**
* **MySQL**
* **Requests (Python)**

---


##  Instalação

###  1. Clonar o projeto

```bash
git clone <repo-url>
cd contador-impressao
```

---

###  2. Configurar Laravel

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Configure o banco no `.env` e rode:

```bash
php artisan migrate
```

---

###  3. Configurar Python

```bash
python -m venv venv311
venv311\Scripts\activate
pip install pysnmp==4.4.12 pyasn1==0.4.8 requests
```

---

##  Como usar

###  1. Iniciar o Laravel

```bash
php artisan serve
```

---

###  2. Rodar coleta manual

```bash
python script/coletor.py
```

---

##  Funcionamento

1. O script Python consulta a API Laravel:

   ```
   GET /api/impressoras
   ```

2. Para cada impressora:

   * Conecta via SNMP
   * Coleta o contador de páginas

3. Envia os dados:

   ```
   POST /api/leitura
   ```

4. O Laravel:

   * Salva no banco
   * Calcula o consumo automaticamente

---

## 📊 Cálculo de consumo

O consumo é calculado com base nas duas últimas leituras:

```php
consumo = última_leitura - leitura_anterior
```

---

##  Automação

O script pode ser executado automaticamente usando o **Agendador de Tarefas do Windows**:

* Frequência: semanal (ex: sexta-feira)
* Programa: Python do ambiente virtual
* Script: `coletor.py`

---

##  OID utilizado

Contador padrão SNMP:

```
1.3.6.1.2.1.43.10.2.1.4.1.1
```

---

##  Observações

* SNMP deve estar habilitado nas impressoras
* Community padrão: `public`
* Evitar rodar múltiplas vezes no mesmo período
* Compatível com Python 3.11 (recomendado)

---

##  Melhorias futuras

* Dashboard com gráficos
* Relatórios mensais
* Alertas de falha
* Separação por tipo (mono/color)
* Exportação para Excel

---

##  Autor

Desenvolvido por Daniel 

---

##  Licença

Este projeto é livre para uso e modificação.
