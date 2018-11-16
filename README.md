# Steps for install:
- clone app ` git clone https://github.com/rach7110/codeChallenge`
- cd into app folder
- run ` composer install `
- copy .env.example to .env. Make sure environment variables are correct:
    ``` 
    DB_CONNECTION=sqlite
    
    WEATHER_API_ID={your secret api key} 
    ```
- generate an app key `php artisan key:generate`
- create a sqilite database with command `touch database/database.sqlite`

- run the migration command to setup the database scheme `php artisan migrate`
- start the server `php artisan serve`
- Open your browser and visit `localhost:8000`

# Part 1: Local API
- Routes to view all todos, view one todo, and create, edit or delete a todo can be found in `routes/web.php`
- To create a todo, make sure to enter a URL in the following format `http://localhost:8000/todos/create?item={"task":"go to the store", "completed":false}`
- To edit a todo, make sure to enter a URL in the following format   `http://localhost:8000/todos/{id}/edit?item={"task":"go to the store", "completed":true}`
- Logs - a table exists with a log of: request method, route being accessed, as well as the HTTP status code that the request returns.
  To view these logs, you may use Tinker.
  ```
  php artisan tinker
  $logs = App\RequestLog::all();
  ```
# Part 2: External API
- To request weather using a valid United States zip code, visit /weather and enter the zip as a query parameter.
  Example `http://localhost:8000/weather?zip=78704`
- If a status code of 418 is returned, you enterd an invalid zip code. The 418 code is actually a spoof.
    This error is a reference of Hyper Text Coffee Pot Control Protocol which was an April Fools' joke in 1998.

# Part 3: Testing
- Unit tests for Part 2 exist in `/path to app/tests/Unit/OpenWeatherServiceTest.php`
- Execute test with command ` phpunit tests/`




