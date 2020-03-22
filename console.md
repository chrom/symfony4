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
  - Load fixtures to DB
 ```bash 
  ./bin/console doctrine:fixtures:load
 ```
