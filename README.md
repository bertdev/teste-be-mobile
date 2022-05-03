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

#### TODO

-   [x] cadastro de usuário do sistema (signup)
-   [x] login com JWT de usuário cadastrado (login)
-   clientes:
    -   [ ] listar todos os clientes cadastrados (index)
        -   [ ] apenas dados principais devem vir aqui;
        -   [ ] ordenar pelo id.
    -   [ ] detalhar um(a) cliente e vendas a ele(a) (show)
        -   [ ] trazer as vendas mais recentes primeiro;
        -   [ ] possibilidade de filtrar as vendas por mês + ano.
    -   [ ] adicionar um(a) cliente (store)
    -   [ ] editar um(a) cliente (update)
    -   [ ] excluir um(a) cliente e vendas a ele(a) (delete)
-   produtos:
    -   [ ] listar todos os produtos cadastrados (index)
        -   [ ] apenas dados principais devem vir aqui;
        -   [ ] ordenar alfabeticamente.
    -   [ ] detalhar um produto (show)
    -   [ ] criar um produto (store)
    -   [ ] editar um produto (update)
    -   [ ] exclusão lógica ("soft delete") de um produto (delete)
-   vendas:
    -   [ ] registrar venda de 1 produto a 1 cliente (store)

#### Dificuldades encontradas
