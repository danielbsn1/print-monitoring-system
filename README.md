Sobre o projeto

O Contador de Impressão foi desenvolvido para auxiliar no controle da quantidade de páginas impressas, ajudando na gestão de custos e monitoramento de uso.

O projeto utiliza Docker, permitindo que qualquer pessoa execute o sistema sem precisar configurar manualmente o ambiente.

 Funcionalidades
Registro de impressões
Contador acumulado
Organização de dados
Ambiente isolado com Docker
Fácil execução e setup rápido
Tecnologias utilizadas
PHP / Laravel (ajuste se precisar)
MySQL (ou outro banco, se usar)

Docker
Docker Compose
 Rodando com Docker
Pré-requisitos
Docker instalado
Docker Compose instalado
 Passo a passo
Clone o repositório:
git clone https://github.com/danielbsn1/Contador-impressao.git
Acesse a pasta:
cd Contador-impressao
Suba os containers:
docker-compose up -d
Acesse no navegador:
http://localhost


Comandos úteis

Parar containers:

docker-compose down

Ver logs:

docker-compose logs -f

Acessar container:

docker exec -it nome_do_container bash
 Estrutura do projeto
Contador-impressao/
│
├── docker/             # Configurações do Docker
├── docker-compose.yml
├── src/                # Código da aplicação
├── database/           # Banco de dados
└── README.md
 Diferencial do projeto

 Ambiente totalmente containerizado
 Fácil de rodar em qualquer máquina
 Ideal para aprendizado de Docker + Backend

 Objetivo

Projeto desenvolvido com foco em prática de:

Containerização com Docker
Desenvolvimento backend
Organização de aplicações reais


Daniel Batista
 https://github.com/danielbsn1

 Licença

MIT
