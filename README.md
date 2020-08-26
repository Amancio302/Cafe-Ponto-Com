# CafePontoCom
Trabalho final da disciplina de Engenharia de Software 2020/1 - UFLA Universidade Federal de Lavras
### Desenvolvido por
JVM Dev
Jean Roberto Lopes Cruz
Victor Gustavo Cabral Rodrigues
Matheus Amâncio Ferreira
## Descrição
Sistema web para gerenciamento interno da cafeteria CafePontoCom.
O sistema será responsável por cadastrar e gerenciar produtos e atendente, alm de gerar e gerenciar vendas.
Os tipos de usuário serão: Atendentes e Gerentes. 
## Tecnologias Empregadas
### Linguagens
#### Programação
	PHP - Versão: 7.4.7
#### Marcação
	HTML - Versão: 5.0
#### Script
	Javascript - Versão: ECMAScript 2018
#### Estilização
    CSS - Versão: 3.0
### Banco de Dados
	MySQL - Versão: 8.0.20
### Servidor WEB
	Apache2 - Versão: 2.4.43
## Padrões de Uso
### Branches e Issues
    Haverão 3 branches padrão no projeto: master, development e review
#### Master
    Última release e versão mais estável do sistema, possuindo apenas funcionalidades testas exaustivamente
#### Development
    Branch responsável por alocar as novas funcionalidade do sistema, sendo geralmente a versão mais recente do sistema, ainda sem muitos testes em larga escala
#### Review
    Branch responsável por testes no sistema, que após aprovação, deverá ser mesclada na master, gerando uma nova relase do projeto
#### Criação de Issues
    Para cada nova funcionalidade do sistema, uma issue deverá ser criada, sendo esta responsável pela descrição do problema e possuindo uma branch relacionada
#### Criação de Branches
    Para cada nova issue, uma branch deverá ser criada, sendo o nome da branch igual ao número e nome da issue. Essas branches deverão ser criadas a partir da branch "development"
### Hierarquia de diretórios
#### Documentação
    Toda a documentação do projeto estará nas pastas "Padrões Adotados" e "Requisitos"
#### Código
    Todo o código estará contido na pasta "src"
##### Assets
    Assets do projeto
#####  Models
    Modelos de classes do banco de dados
##### Persistance
    Classes que se relacionam com o Banco de Dados
##### Controller
    Controladores do sistema, agindo como intermediadores entre as views e o resto do sistema
##### Views
    Todos os arquivos de visualização
### Padrões de codificação
    * Toda View deve ser um Arquivo PHP que extende um a classe View.php
    * Todo Controller deve ser um Arquivo PHP que extende a classe Controller.php
    * Todas as classes devem implementar uma e somente uma finalidade
    * Todo Acesso aos bancos de dados devem ser feitos por Persistence
    * Todo Arquivo Persistence deve ser nomeado com qual a tabela do Banco de Dados que ela acessa e ao final do nome, colocar "DAO"
    * Todo Persistence deve ser um arquivo PHP e extender a classe Database_Connect.php
    * Cada Função deve executar, assim como a classe, apenas uma funcionalidade, se necessária deve ser quebrada em mais funções, para ser o mais genérico possível
