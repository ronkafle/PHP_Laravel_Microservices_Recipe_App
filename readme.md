###Recipe Micro-service:
####Setup:
- At first, create the database recipe_app or with some other name which is configurable in .env
- Run php artisan migrate --seed to create tables and seed the basic data
- php artisan serve to run the server and access APIs.

####Authentication:
- Using laravel's token based API Authentication with *hashing*
- The token given at the time of seeding user is stored in encrypted form in database while it can directly be used in API authentication bearer.
- Use header "Authorization: Bearer <token>" for API authentication.
 
####APIs:
- All the CRUD routes for Recipe, RecipeIngredient and RecipeSteps are created.
- URLs are available in routes/api.php

####Sample Curl Requests for APIs:
`curl -X POST \
   http://localhost:8000/api/recipes \
   -H 'authorization: Bearer vcBkpKAH3XbDk' \
   -H 'cache-control: no-cache' \
   -H 'content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW' \
   -H 'postman-token: c85599cf-0345-892c-fc9d-66f427ca9fa2' \
   -F 'title=Choco lava Cake' \
   -F 'description=Test Recipe'`
   
   
####Unit Tests
```
Run command "vendor/bin/phpunit" 
 PHPUnit 8.3.5 by Sebastian Bergmann and contributors.
 
 ......                                                              6 / 6 (100%)
 
 Time: 225 ms, Memory: 20.00 MB
 
 OK (6 tests, 9 assertions)
```
