#  Print Monitoring System

Sistema completo para monitoramento e análise de impressões em rede, com coleta automática de dados via script Python, integração com API própria e gerenciamento centralizado.

---

##  Sobre o projeto

Este sistema foi desenvolvido para resolver um problema comum em ambientes corporativos:
o controle e monitoramento de impressões realizadas em múltiplas impressoras.

A aplicação coleta dados diretamente das impressoras utilizando um script em Python, envia essas informações para uma API e disponibiliza um painel administrativo para análise e gestão.

---

##  Funcionalidades

*  Monitoramento de impressões em tempo real
*  Relatórios de uso (diário, semanal, mensal)
*  Integração com múltiplas impressoras
*  API própria para comunicação entre serviços
*  Sistema preparado para autenticação
*  Estrutura pronta para deploy com Docker

---

##  Arquitetura do sistema

O sistema é dividido em três partes principais:

1. **Coletor (Python)**

   * Script responsável por acessar as impressoras
   * Coleta dados como número de páginas impressas
   * Envia informações para a API

2. **API (Laravel)**

   * Recebe e processa os dados
   * Armazena no banco de dados
   * Disponibiliza endpoints para consumo

3. **Painel Administrativo**

   * Interface para visualização dos dados
   * Controle e análise das impressões

---

##  Tecnologias utilizadas

* Python
* Laravel (PHP)
* MySQL / PostgreSQL
* Docker
* REST API

---

##  Como executar o projeto

```bash
# Clonar repositório
git clone https://github.com/seu-usuario/seu-repo.git

# Subir containers
docker-compose up -d

# Acessar aplicação
http://localhost:8000
```

---


##  Diferenciais

* Integração direta com hardware (impressoras)
* Arquitetura distribuída (script + API + backend)
* Projeto voltado para ambiente real corporativo
* Uso de Docker para padronização de ambiente

---

##  Melhorias futuras

* Dashboard com gráficos (React)
* Sistema de autenticação completo (JWT)
* Multi-tenant (várias empresas)
* Alertas automáticos de uso

---

##  Autor

Daniel Batista
Desenvolvedor Backend 

---
