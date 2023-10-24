Steps for running:

* In the api-platform directory run: **docker-compose up --build**.
* Then run: **docker exec -it api-platform-php-1 sh** to enter to container
* Run: **bin/phpunit tests** to run tests
* Type **localhost/docs** in browser to check api docs
* Type **localhost/admin** in browser to check admin panel
* You can call apis with writing **localhost/cars** and **localhost/reviews** in postman with different methods(**GET, POST, DELETE, PATCH**)
