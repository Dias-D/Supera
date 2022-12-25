# SUPERA

Olá! Você deverá seguir cada passo para instalação:

**Observações**

Backend: algumas considerações

-   Tenha iniciado o Docker em seu ambiente.
-   Laravel possui a versão 9x, usando de PHP 8.1

Frontend: algumas considerações

-   Possua o NodeJS 18x e Yarn 1x

**Iniciando a instalação**

-   Clone o projeto em seu ambiente de desenvolvimento
    > https://github.com/Dias-D/Supera.git > git@github.com:Dias-D/Supera.git
-   Ao finalizar, acesse a pasta Backend e instale as configurações necessárias
    > composer install
-   A seguir, copie o arquivo .env.example e renomeie o original para: .env, alterando também as configurações abaixo

```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=supera
DB_USERNAME=sail
DB_PASSWORD=password
```

-   O comando abaixo irá criar um APP_KEY dentro de seu arquivo .env
    > ./vendor/bin/sail artisan key:generate
-   Baixe as imagens necessárias e crie os containers do Laravel e do Mysql
    > ./vendor/bin/sail up -d
-   Faça as migraçoes necessárias e insira os dados falsos no banco de dados

    > ./vendor/bin/sail artisan migrate --seed

-   Volte para a pasta raiz e agora acesse o Frontend
-   Instale as configurações necessárias
    > yarn
-   Ao finalizar, o comando a seguir é suficiente para que o frontend inicie
    > yarn dev

**Pronto**
Seu sistema está pronto para ser utilizado
Dentro da pasta .docs possui uma Postman Collection para analisar as opções de rotas
