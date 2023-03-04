#To run this application
First create a .env like the .env.example, but in DB sets.. use the environment
``` 
DB_CONNECTION=mysql
DB_HOST=#YOUR_IP_HOST#
DB_PORT=3303
DB_DATABASE=db
DB_USERNAME=root
DB_PASSWORD=secret
```
Then run the following commands
```
docker-compose up --build
```
