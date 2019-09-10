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

