- Show all services 
```bash 
./bin/console debug:container --show-private
``` 

***
- show all parameters 
```bash 
./bin/console debug:container --parameters
```
 
***
 - show container configuration
```bash 
./bin/console debug:container monolog.logger
```

***
 - show logger services
```bash 
./bin/console debug:container --show-private log 
```

***
 - Current autowiring
```bash 
./bin/console debug:autowiring --all
```

***
 - Existing example configuration of `ramework`
```bash 
./bin/console config:dump framework
```

***
 - Current configuration of `ramework`
```bash 
./bin/console debug:config framework
```

***
 - Get information about current instance
```bash 
./bin/console about
```

***
 - Bundle maker
```bash 
composer require maker --dev
```

***
 - Create new database
```bash 
./bin/console  doctrine:database:create
```

***
 - Create new entity - DTO model
```bash 
./bin/console make:entity
```

***
 - Create new migration using model
```bash 
./bin/console make:migration
```

***
 - Apply migration
```bash 
./bin/console doctrine:migrations:migrate
```


Fixtures:

`composer require orm-fixtures --dev`
`

 ***
  - Create fixture class
 ```bash 
  ./bin/console make:fixtures
 ```
 ***
  - Create controller class
 ```bash 
  ./bin/console make:controller
 ```

 ***
  - Load fixtures to DB
 ```bash 
  ./bin/console doctrine:fixtures:load
 ```

 ***
  Fast create new db
 ```bash 
bin/console doctrine:database:drop --force
bin/console doctrine:database:create
bin/console doctrine:schema:create
bin/console doctrine:fixtures:load
 ```

 ***
  - Show all config data and all filters
 ```bash 
./bin/console debug:twig
 ```

 ***
  - Make Auth entry point
 ```bash 
./bin/console make:auth
 ```

 
  ***
   - Show all router
  ```bash 
  ./bin/console debug:router 
  ```
 

  ***
   - For serializing install package 
  ```bash 
  composer require serializer 
  ```
