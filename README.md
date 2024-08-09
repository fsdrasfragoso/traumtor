# Getting Started: Traumtor

## Sobre

O projeto Traumtor foi desenvolvido por Esdras Fragoso, traumtor significa "gol de sonho" ou "gol incrível". É usado para descrever um gol excepcionalmente bonito, habilidoso ou espetacular, algo que é digno de ser lembrado e admirado. Por exemplo, um chute de longa distância que entra no ângulo ou um gol de bicicleta pode ser chamado de "Traumtor". Em Resumo Traumtor é um Golaço. Esse sistema gerencia partidas de futebol, amadoras. [traumtor](https://www.traumtor.com.br).

## Tecnologias e versões

  Ferramenta                  |  Versão
----------------------------- | --------
PHP                           | 8.2.*
Laravel                       | 11.0
MySql                         | 8.0
Redis                         | alpine
8.2-fpm-alpine                | 3.12
mailhog/mailhog               | latest
minio/minio                   | latest

## Padrões de projeto

### MVC
A arquitetura MVC tem como principal característica ajudar a desenvolver aplicações seguras e performáticas de forma rápida, com código limpo e simples, já que ele incentiva o uso de boas práticas de programação e utiliza o padrão PSR-2 como guia para estilo de escrita do código.

### SOLID
O SOLID é um princípio de design de software orientado a objeto (OOD). Basicamente, SOLID é um acrônimo para:

S - Single Responsibility Principle (Princípio da Responsabilidade Única);

O - Open-closed Principle (Princípio Aberto-fechado);

L - Liskov Substitution Principle (Princípio da Substituição de Liskov);

I - Interface Segregation Principle (Princípio da Segregação de Interface);

D - Dependency Inversion Principle (Princípio da Inversão de Dependência).

Para conhecer mais sobre o SOLID acesse [Princípios SOLID: o que são e como aplicá-los no PHP/Laravel](https://dev.to/lucascavalcante/principios-solid-o-que-sao-e-como-aplica-los-no-php-laravel-parte-01-responsabilidade-unica-3mjj).

### Service-Repository
O conceito de repositórios e serviços garante que você escreva código reutilizável e ajuda a manter seu controlador o mais simples possível, tornando-os mais legíveis.

## Serviços e integrações

Os serviços aqui descritos são uma breve introdução de como funcionam.

**Certifique-se de checar se as configurações dos containes estão de acordo com as do ```.env```.**

### MySql

Container de bancos de dados da aplicação local, criada com base no ``` mysql:8.0 ```.

### Redis

Container de cache utilizado pelo horizon e filas, criada com base na ``` redis:alpine ```.

### Mailhog

[MailHog](https://github.com/mailhog/MailHog) é uma ferramenta de teste de e-mail para desenvolvedores, localmente é usada para o envio de emails. A imagem é criada com base na ``` mailhog/mailhog:latest ```.

Para acessar o mailhog, e ter acesso aos e-mails enviados, acesse [http://localhost:8025](http://localhost:8025).

### Minio

[MinIO](https://min.io) é um armazenamento de objetos de alto desempenho lançado sob a GNU Affero General Public License v3.0. É API compatível com o serviço de armazenamento em nuvem Amazon S3, localmente usa-se para o armazenamento de objetos que em produção são armazenadas na ``` AWS S3```. A imagem é criada com base na ``` minio/minio:latest ```.

Para configurar o MinIO, acesse a url [http://localhost:9090](http://localhost:9090), insira as credenciais que estão configuradas no .env (`AWS_ACCESS_KEY_ID` e `AWS_SECRET_ACCESS_KEY`), e crie um novo bucket, que deve ser o mesmo na configuração `AWS_BUCKET` do `.env`.


### Viacep

O [Viacep](https://viacep.com.br) é um webservice para consulta de CEPs do Brasil, no projeto o Viacep é utilizado tanto nos form de endereço qaunto na verificação do endereço do futebolista. Veja mais sobre a implementação da lib em ```app\Libraries\Viacep```

## Como executar

### Antes de executar

1 - Clone o repositório ```git@github.com:fsdrasfragoso/traumtor.git```.

2 - Acesse a pasta do projeto ```cd traumtor``` .

3 - Crie o .env ``` cp .env.example .env ```.

### Próximos passos

1 - Execute ``` docker-compose up -d ``` para subir os containers.

2 - Execute ``` docker exec -it traumtor-php-fpm /bin/bash ``` para acessar o container do php.

3 - Dentro do container execute ``` composer install ``` ou ``` composer install --ignore-platform-reqs ``` para instalar as dependências.

4 - Gerar a APP_KEY ``` php artisan key:generate ```.

5 - Dentro do container execute ``` php artisan migrate --seed ``` para executar as migrations e os seeds.

6 - Dentro do container execute ``` php artisan passport:install ``` para criar as keys de autenticação.

7 - Para acessar o admin abra o link [http://localhost/admin](http://localhost/admin). Para verificar as credenciais padrão, acesse o arquivo de seeds de usuários.

8 - Clone o repositório do frontend para a sua máquina local em uma pasta diferente da pasta onde está o projeto back-end:
   
   ```git clone https://github.com/fsdrasfragoso/traumtor-front.git```

   O frontend da aplicação, que é a parte que o futebolista acessa, foi desenvolvido em React e está localizado em um repositório separado. Este frontend é responsável por fornecer a interface de usuário para os futebolistas, enquanto a administração do sistema é feita através do painel de administração descrito anteriormente.

9 - Acesse a pasta do projeto frontend:

  ```cd /traumtor-front```
10 - Inicialize o container do servidor do front digitando o comando:

```docker-compose up -d```


## Testes
1 - Crie o banco de dados de testes no mysql.

2 - Crie o .env.testing.

  ``` cp .env .env.testing ```

3 - Altere as variáveis de conexão do banco de dados para o que você acabou de criar.

4 - Execute as migrations e seeds.

  ``` php artisan migrate --env=testing --seed ```

5 - Execute os testes.

  - Todos;

    ``` ./vendor/bin/phpunit  ```

  - Somente uma classe;

    ``` ./vendor/bin/phpunit --filter ClassName ```

  - Somente um método;

    ``` ./vendor/bin/phpunit --filter methodName ```
