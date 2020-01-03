# mafia-api
## Project setup
#### Requirements
- Apache
- Php 7.2.5
- MariaDB 10.3.*
- Composer
- [Mercure](https://github.com/dunglas/mercure/releases)

##### Coding standard
We use php-cs-fixer and the [symfony standard](https://symfony.com/doc/master/contributing/code/standards.html).

config is found in .php_cs.dist

#### Install
```
composer install
```

[Generate JWT private & public keys](https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Resources/doc/index.md#installation) 

```
cd /path/to/your/project
mkdir config/jwt
openssl genrsa -out config/jwt/private.pem -aes256 4096
openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```

execute:
```
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate -n
```

For dev execute:
```
php bin/console doctrine:fixtures:load -n
```

##Mercure
[here](./MERCURE.md)
