# Documentação da API

## Endpoints

### POST /login

Autentica um usuário com base no email e senha fornecidos.

#### Parâmetros

- `email` (obrigatório): O email do usuário.
- `password` (obrigatório): A senha do usuário.

#### Respostas

- `200 OK`: Retorna um token JWT no caso de sucesso.
  - Exemplo de corpo da resposta:
    ```json
    {
      "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
    }
    ```
- `400 Bad Request`: Retorna um erro se algum dos campos obrigatórios não for fornecido.
  - Exemplo de corpo da resposta:
    ```json
    {
      "error": "Informe email e senha"
    }
    ```
- `401 Unauthorized`: Retorna um erro se as credenciais forem inválidas.
  - Exemplo de corpo da resposta:
    ```json
    {
      "error": "Credenciais inválidas"
    }
    ```
- `500 Internal Server Error`: Retorna um erro se não for possível criar o token.
  - Exemplo de corpo da resposta:
    ```json
    {
      "error": "Não foi possível criar o token"
    }
    ```

### POST /logout

Invalida o token JWT do usuário, efetuando o logout.

#### Headers

- `Authorization`: O token JWT do usuário, precedido por `Bearer`.

#### Respostas

- `200 OK`: Retorna uma mensagem de sucesso no caso de logout bem-sucedido.
  - Exemplo de corpo da resposta:
    ```json
    {
      "message": "Logout realizado com sucesso"
    }
    ```
- `500 Internal Server Error`: Retorna um erro se houver falha ao fazer logout.
  - Exemplo de corpo da resposta:
    ```json
    {
      "error": "Falha ao fazer logout"
    }
    ```

#### Notas

- O endpoint `/logout` requer autenticação via token JWT.
- Para usar o endpoint `/logout`, é necessário incluir o token JWT no cabeçalho `Authorization` da solicitação.