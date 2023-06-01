# hotspot-watchguard
 Simple PHP solution for Watchguard hotspot authentication

## Português
## Executando o projeto

Pela recomendação do watchguard é interessante que o sistema fique na mesma rede que o firebox mas não tem impedimentos se fiquerem em redes diferentes. 

No projeto subi uma imagem docker para executar localmente mas também é possível usar o servidor embutido do PHP.

Docker
```` 
docker-compose build
```` 
```` 
docker-compose up -d
```` 
Servidor PHP 

````
php -S localhost:8080 -t public
```` 

## Configuração

Acessando o watchguard você configura o link da página de autenticação com a rota '/hotspot' (e.g http://10.0.2.80:8080/hotspot)

Quando um dispositivo sem seção ativa tenta acessar a rede, ele é redirecionado para a página de autenticação.

http://10.0.2.80:8080/auth.html?xtm=http://10.0.3.1:4106/wgcgi.cgi &action=hotspot_auth&ts=1344238620&sn=70AB02716F745&mac=9C:4E:36:30:2D:26 &redirect=http://www.google.com/

## Autenticação

A autenticação pode ser feita de várias maneiras de acordo com a regra de negócio. Usuário e senha, cadastro de C.P.F, Autenticação via SOAP, LDAP e etc.

A documentação mostra como é feito o envio de resposta e a liberação da seção para acesso a rede.

Adicionalemnte, o watchguard enviará o código de erro para uma página de falha - também configuravel dentro do firebox - nos casos em que a autenticação falhar.

````
Hash = SHA1(ts + sn + mac + success + sess-timeout + idle_timeout + shared_secret)
````
 
 ## Documentação Watchguard
 https://www.watchguard.com/help/docs/help-center/en-US/Content/en-US/Fireware/authentication/hotspot_external_web_server_config_c.html
 
## English
## Running the project

According to WatchGuard's recommendation, it is preferable for the system to be on the same network as the Firebox, but there are no impediments if they are on different networks. 

In the project, I uploaded a Docker image to run locally, but it is also possible to use the built-in PHP server.

Docker
```` 
docker-compose build
```` 
```` 
docker-compose up -d
```` 
PHP Server 

````
php -S localhost:8080 -t public
```` 

## Configuration

When accessing the WatchGuard, you configure the authentication page link with the route '/hotspot' (e.g., http://10.0.2.80:8080/hotspot).

When a device without an active session tries to access the network, it is redirected to the authentication page.

http://10.0.2.80:8080/auth.html?xtm=http://10.0.3.1:4106/wgcgi.cgi&action=hotspot_auth&ts=1344238620&sn=70AB02716F745&mac=9C:4E:36:30:2D:26 &redirect=http://www.google.com/

## Authentication

Authentication can be done in various ways according to the business rule. User and password, CPF registration, SOAP authentication, LDAP, etc.

The documentation shows how to send a response and grant session access to the network.

Additionally, WatchGuard will send an error code to a failure page, also configurable within the Firebox, in cases where authentication fails.

````
Hash = SHA1(ts + sn + mac + success + sess-timeout + idle_timeout + shared_secret)
````
 
 ## WatchGuard Documentation
 https://www.watchguard.com/help/docs/help-center/en-US/Content/en-US/Fireware/authentication/hotspot_external_web_server_config_c.html
