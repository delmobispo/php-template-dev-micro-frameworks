# Instalando o projeto
- composer install //download de todas as dependências
- composer tests // rodar os testes
- composer phinx //rodar as migrations
- composer update //atualiza as dependências

# Pasta database
Para mais detalhes no funcionamento do Phinx (https://phinx.org).
- phinx.yml - arquivo de configuração das migrations
- dev.db - Base de dados do desenvolvimento SQLite
- test.db - Base de dados de testes SQLite

# Sobre o projeto
O projeto está na pasta src/main e os testes em src/tests.
- Config - todas as configurações do projeto. O arquivo .env deve conter os dados do banco entre outras variáveis de ambiente, essas variáveis são mapeadas na classe EnvConfig. Para pegar uma variável de ambiente deve-se chamar a função "getenv" passando as constantes em EnvConfig.
- Models - Os modelos de dados, no padrão do Eloquent
- Validators - Validações do JSON, configurado nas configurações da rotas(RoutesConfig)
- Helpers - Ajudantes da aplicação, funções simples/complexas
- Controllers - Coração da aplicação, onde é aplicado as regras de negócio.

# Micro/Frameworks utilizados com suas referências
- PHP7 ou superior (https://secure.php.net/manual/pt_BR/migration70.new-features.php)
- Slim Framework 3 (https://www.slimframework.com)
- Eloquent ORM 5 (https://github.com/illuminate/database)
- phpdotenv (https://github.com/vlucas/phpdotenv)
- Slim-Validation (https://github.com/DavidePastore/Slim-Validation)
- PHP-JWT (https://github.com/firebase/php-jwt)
- slim-jwt-auth (https://github.com/tuupola/slim-jwt-auth)
- cors-middleware (https://github.com/tuupola/cors-middleware)
- Phinx (https://phinx.org)

