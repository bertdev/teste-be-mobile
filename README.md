## Teste be mobile

-   [Como rodar](#como-rodar)
-   [Rotas](#rotas)
    -   [User](#user)
    -   [Product](#product)
    -   [Customer](#customer)
-   [TODO](#todo)
-   [Dificuldades encontradas](#dificuldades-encontradas)
-   [Pontos de melhoria](#pontos-de-melhorias-para-o-projeto)

#### Como rodar?

---

1. Clone o repositório para a sua máquina
2. Dentro da pasta raiz do projeto instale as dependências com `composer install`
3. Crie um arquivo `.env` com base no `.env.example` e preencha as váriaveis de ambiente conforme for necessário
   3.1 Se for utilizar o banco de dados com base no arquivo `docker-compose.yml` preencha as váriaveis de ambiente relacionadas a db connection com base nas informações do arquivo `docker-compose.yml`
   3.2 Rode o comando `docker-compose up -d` para criar um container com base no `docker-compose.yml`
4. Rode o comando `php artisan migrate` para rodar as migrations necessárias para o banco de dados
5. Rode o comando `php artisan serve` para subir o servidor local

Recomendo testar as rotas usando como base o arquivo de rotas do insomnia que se encontra na pasta `docs` do projeto, basta importa-las no seu insomnia e terá as rotas para testar.

#### Rotas

---

##### User

| Endpoint        | Metodo | Função                          |
| --------------- | ------ | ------------------------------- |
| `/api/register` | `POST` | Faz registro de um novo usuario |
| `/api/login`    | `POST` | Faz login de um usuario         |
| `/api/logout`   | `POST` | Faz logout de um novo usuario   |

Obs: As rotas de registro e de login recebem um body e a rota de logout deve ser passado o token de autenticação que é retornado na rota de login ou de registro

```
//Para rota de registro:
{
	"name": "teste 2",
	"email": "teste2@teste.com",
	"password": "teste1234"
}

//Para rota de login:
{
	"email": "teste@teste.com",
	"password": "teste1234"
}
```

##### Product

| Endpoint             | Metodo   | Função                          |
| -------------------- | -------- | ------------------------------- |
| `/api/products`      | `GET`    | lista todos os produtos         |
| `/api/products/{id}` | `GET`    | lista detalhadamente um produto |
| `/api/products`      | `POST`   | cria um produto                 |
| `/api/products/{id}` | `PATCH`  | atualiza um produto             |
| `/api/products/{id}` | `DELETE` | deleta um produto               |

-   Todas as rotas de produto são protegidas,então deve-se passar pelo header o token de acesso recebido quando realiza-se login.
-   Os produtos serão livros então os dados necessários são relacionados a isso.
-   A rota de criação de um produto deve enviar o seguinte body:

```
{
	"name": "teste 4",
	"author": "author name",
	"year": "2011",
	"quantity": 10,
	"ref_code": "124.325.skd-46",
	"price": "55.95"
}
```

-   A rota de atualização de um produto deve enviar o seguinte body:

```
{
	"name": "crepusculo",
	"author": "author name",
	"year": "2011",
	"quantity": 10,
	"price": "55.95"
}
```

##### Customer

| Endpoint                | Metodo   | Função                         |
| ----------------------- | -------- | ------------------------------ |
| `/api/customers`        | `GET`    | lista todos os clientes        |
| `/api/customers/{id}`   | `GET`    | detalha um cliente             |
| `/api/customers`        | `POST`   | cria um cliente                |
| `/api/customers/{id}`   | `PATCH`  | atualiza um cliente            |
| `/api/customers/{id}`   | `DELETE` | deleta um cliente              |
| `/api/customers/orders` | `POST`   | cria uma venda para um cliente |

-   Todas as rotas de cliente são protegidas,então deve-se passar pelo header o token de acesso recebido quando realiza-se login.
-   A rota de criação de um cliente deve enviar o seguinte body:

```
{
	"name": "customer teste",
	"cpf": "111.111.111-11",
	"address": {
		"street": "rua teste",
		"number": "32",
		"district": "bairro teste",
		"complement": "",
		"city": "cidade teste",
		"state": "estado teste"
	},
	"phoneNumber": "(88) 99999-9999"
}
```

-   A rota de atualização de um cliente deve enviar o seguinte body:

```
{
	"name": "customer teste 2",
	"cpf": "111.111.111-11"
}
```

#### TODO

---

-   [x] cadastro de usuário do sistema (signup)
-   [x] login com JWT de usuário cadastrado (login)
-   clientes:
    -   [x] listar todos os clientes cadastrados (index)
        -   [x] apenas dados principais devem vir aqui;
        -   [x] ordenar pelo id.
    -   [x] detalhar um(a) cliente e vendas a ele(a) (show)
        -   [x] trazer as vendas mais recentes primeiro;
        -   [ ] possibilidade de filtrar as vendas por mês + ano.
    -   [x] adicionar um(a) cliente (store)
    -   [x] editar um(a) cliente (update)
    -   [x] excluir um(a) cliente e vendas a ele(a) (delete)
-   produtos:
    -   [x] listar todos os produtos cadastrados (index)
        -   [x] apenas dados principais devem vir aqui;
        -   [x] ordenar alfabeticamente.
    -   [x] detalhar um produto (show)
    -   [x] criar um produto (store)
    -   [x] editar um produto (update)
    -   [x] exclusão lógica ("soft delete") de um produto (delete)
-   vendas:

    -   [x] registrar venda de 1 produto a 1 cliente (store)

#### Dificuldades encontradas

---

-   Validação de dados, principalmente de dados que são numericos ou datas.
-   Manipulação de muitas tabelas usando o eloquent.
-   Como foi falado na nossa conversa laravel não é minha stack principal então acredito que isso trouxe uma leve dificuldade também.
-   Definir como seria a modelagem de cada tabela.

#### Pontos de melhorias para o projeto

---

-   Implementar a filtragem de vendas por mês + ano.
-   Refatorar o soft delete de produtos para utilizar a funcionalidade fornecida pelo eloquent para isso no lugar de utilizar uma feita à mão.
-   Refatorar as validações de rotas que recebem body, criando uma custom request e fazendo melhores validações dentro dessas custom requests.
-   Melhorar a lógica de criação de vendas, realizando validação da quantidade do produto que está sendo comprado verificando se a quantidade solicitada pode ser atendida.
-   Permitir a atualização de mais dados do cliente, como endereço e telefone.
