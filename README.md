# Technical task for PHP position
## Description
### Warsaw forecast
 
### Technical tasks
* Creation repository. 
* Making initial commit.
* On the new branch, create a simple home page that shows today's weather forecast for Warsaw. It is about displaying the current temperature in degrees Celsius. Download the current weather forecast via the free API - OpenWeatherMap.
* Attach a bootstrap and style it so that it looks legible on mobile and desktop. 
* Caching data in DB for 1 hour to decrease API requests. Write your own function using DB. 
* Adding additional information/statistics (optional).
* connect the branch to master and deploy it to github.

### Running and usage
* step 1: in the command line run "composer install".
* step 2: in the command line run "npm install".
* step 3: in the command line run "npm run dev" to include css dependencies.
* step 4: set up your .env file. Enter database name, user and password, and set up your own key if you have, by changing variable API_KEY
* step 5: in the command line run "php artisan migrate".
* step 6. in the command line run "php artisan db:seed" to fill some fake date to see statistic.
* step 7. Make sure that your database server is running and in the command line run "php artisan serve" to run the server.
