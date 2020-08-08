# Project Sample Rest API
****Depedências do projeto:****
- Docker e Docker Compose
## Configurando o projeto:
```shell
make install
```
Esse comando irá deixar o ambiente pronto para o projeto.

Após a intalação e configuração a aplicação poderá ser acessada http://localhost:8000

**Para deixar uma url mais amigável edite o arquivo /etc/hosts e adicione:**
```shell
127.0.0.1   dev.sample-api.com
```
Conexão com o bando de dados:
```
  HOST=127.0.0.1
  PORT=3306
  DATABASE=xpto
  USERNAME=root
  PASSWORD=secret
```
### Comandos:
- **Baixando as dependências do projeto:**
```shell
make update
```
- **Migrando e semeando os dados no banco de dados:**
```shell
make migrate
```
- **Iniciando o servidor:**
```shell
make serve
```
Por padrão a aplicação irá rodar na porta :8000. Caso queria executar em outra porta, pare o serviço e execute o comando:
```shell
make serve PORT=8880
```
- **Executando os testes:**
```shell
make test
```
- **Habilitando o consumidor da fila:**
```shell
make queue-work
```
- **Caso alguma mensagem falhe, execute esse comando para a mensagem ser processada novamente:**
```shell
make queue-retry
```
- **Iniciar o container:**
```shell
make stack-up
```
- **Parar o container:**
```shell
make stack-stop
```
- **Reiniciar o container:**
```shell
make stack-restart
```

# Utilizando da API
O endpoint de conexão : http://dev.sample-api.com:8000/api/v1

Recursos disponíveis:
Você pode manipular através dos métodos GET, POST, PUT:

# Usuários [/user]
### Listar todos os usuários [GET]
Response: Status: 200 OK
```json
[
    {
        "id": 1,
        "name": "Jamar Gutmann"
    },
    {
        "id": 2,
        "name": "Abbey Hodkiewicz"
    },
    {
        "id": 3,
        "name": "Ms. Magnolia Wilderman DVM"
    },
]
```

### Recuperar um usuário [GET /{id}]
Response: Status: 200 OK
```json
{
    "id": 15,
    "name": "Ms. Aylin Hickle IV"
}
```
### Criar um usuário [POST]
Response: Status: 200 OK
```json
{"message":"work in progress"}
```
### Ediat um usuário [PUT /{id}]
Response: Status: 200 OK
```json
{"message":"work in progress"}
```
# Transação [/transaction]
### Solicita uma criação de transação [POST]
body:
```json
{
    "value" : 10.00,
    "payer" : 4,
    "payee" : 15
}
```
Response:  Status: 201 Created
```json
{
    "id": 1,
    "created_at": "2020-08-08T21:28:33+0000"
}
```
