# API de Parcelas de Carnê

Este projeto é uma API para gerenciamento de parcelas de carnê, desenvolvida em PHP utilizando o framework Slim e documentada com Swagger.

## Pré-requisitos

Antes de começar, certifique-se de ter os seguintes softwares instalados em sua máquina:

- Docker
- Docker Compose

## Instalação

Siga os passos abaixo para configurar e iniciar o ambiente de desenvolvimento:

1. **Clone o repositório**:

    ```bash
    git clone https://github.com/seu-usuario/seu-repositorio.git
    cd seu-repositorio
    ```

2. **Crie e inicie os contêineres Docker**:

    ```bash
    docker-compose up --build
    ```

    Este comando irá construir as imagens Docker e iniciar os contêineres definidos no arquivo `docker-compose.yml`.

3. **Acesse a aplicação**:

    A aplicação está disponível na url `http://localhost:8080`.

## Uso

### Endpoints da API

A API possui os seguintes endpoints:

1. **Criar um novo carnê**:

    - **URL**: `/carne`
    - **Método**: `POST`
    - **Descrição**: Cria um novo carnê com as informações fornecidas.
    - **Exemplo de corpo da requisição**:
        ```json
        {
            "valor_total": 1000.00,
            "qtd_parcelas": 12,
            "data_primeiro_vencimento": "2024-08-01",
            "periodicidade": "mensal",
            "valor_entrada": 100.00
        }
        ```
    - **Resposta de sucesso**:
        ```json
        {
            "valor_total": {
                "amount": 1000.00,
                "currency": "BRL"
            },
            "qtd_parcelas": 12,
            "data_primeiro_vencimento": "2024-08-01",
            "periodicidade": "mensal",
            "valor_entrada": {
                "amount": 100.00,
                "currency": "BRL"
            },
            "parcelas": [
                {
                    "data_vencimento": "2024-09-01",
                    "valor": 75.00,
                    "numero": 1,
                    "entrada": false
                },
                ...
            ]
        }
        ```

2. **Obter detalhes de um carnê pelo ID**:

    - **URL**: `/carne/{id}`
    - **Método**: `GET`
    - **Descrição**: Obtém os detalhes de um carnê específico pelo ID.
    - **Resposta de sucesso**:
        ```json
        {
            "id": 1,
            "valor_total": 100.00,
            "qtd_parcelas": 12,
            "data_primeiro_vencimento": "2024-08-01",
            "periodicidade": "mensal",
            "valor_entrada": 0,
            "parcelas": [
                {
                    "data_vencimento": "2024-09-01",
                    "valor": 8.33,
                    "numero": 1,
                    "entrada": false
                },
                ...
            ]
        }
        ```

### Documentação da API

A documentação da API está disponível no Swagger. Para acessá-la, abra o navegador e vá para `http://localhost:8080/swagger-ui/index.html`. Você conseguirá testar a API por lá de forma direta

## Testes

Para executar os testes unitários, siga os passos abaixo:

1. **Acesse o contêiner do aplicativo**:

    ```bash
    docker-compose exec web bash
    ```

2. **Execute os testes**:

    ```bash
    ./vendor/bin/phpunit
    ```
