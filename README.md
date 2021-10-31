##Tunga Interview Challenge

####To run
- Clone the repo
- Run composer install
- Make a copy of .env from .env.copy
- Do Run database migration - `php artisan migrate`
- Start the server - `php artisan serve`
- Run the queue - `php artisan queue:listen`
- Run scheduler - `php artisan schedule:run`  
- Test the app by running - `php artisan test`


####Solution Approach

- Upload
    - I created a POST route /api/upload 
    - when the endpoint is hit, I read JSON file from local storage
    - Read the JSON file, breaks it into chunks and batch it to a background
      process
    - I created a Scheduler to query failed job table and retry failed jobs

   ```json
  **REQUEST BODY**
  http://localhost:8000/api/upload
  
  {
    
  }
  ```

   ```json
  **Response BODY**
  http://localhost:8000/api/upload
  
  {
     "message":"done"
  }
  ```
