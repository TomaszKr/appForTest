# appForTest

## Instalacja 

### Wstęp

Instalacja aplikacji.

W pierwszej kolejności należy wykonać komende w consoli linii komend (CLI):

```bash
composer install
```

Natomiast gdy nie posiadamy to, instaluje [composer](https://getcomposer.org/download/) i wykonaj powyższą instrukcje.
W momencie gdy pojawią się problemy skorzystaj z [dokumentacji](https://getcomposer.org/doc/articles/troubleshooting.md)

Jeśli proces przebiega prawidłowo zobaczyć informację o sciąganych pakietach np.

```bash
Package operations: 39 installs, 0 updates, 0 removals
  - Installing doctrine/lexer (v1.0.1): Downloading (100%)         
  - Installing doctrine/annotations (v1.4.0): Loading from cache
  - Installing symfony/polyfill-ctype (v1.10.0): Loading from cache
  - Installing twig/twig (v1.35.4): Loading from cache

```

Po chwili w CLI zostaniesz poproszony o podanie kilku danych:

```bash 
Generating autoload files
> Incenteev\ParameterHandler\ScriptHandler::buildParameters
Creating the "app/config/parameters.yml" file
Some parameters are missing. Please provide them.
database_host (127.0.0.1): 
database_port (null): 
database_name (symfony): 
database_user (root): 
database_password (null): 
mailer_transport (smtp): 
mailer_host (127.0.0.1): 
mailer_user (null): 
mailer_password (null): 
secret (ThisTokenIsNotSoSecretChangeIt): 
```

Jeśli chcesz zostawić wartości domyśle należy przycisnąć przycisk **ENTER**

-----

## Baza danych

Należy wykonać komende w CLI, jesli nie posiadasz stworzonej bazy danych:

```bash
php bin/console doctrine:database:create
```

Następna komenta, wgranie stworzonych zapytań SQL do bazy:

```bash
php bin/console doctrine:migrations:migrate
```
