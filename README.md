## Teste be mobile

#### Como rodar?

#### Rotas

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

#### TODO

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

-   se tiver tempo refatorar o softdelete dos produtos pelo softdelete fornecido pelo laravel

#### Dificuldades encontradas

-   Validação de dados, principalmente de dados que são numericos ou datas
