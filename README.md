## Instructions

Clone the repo and open it in your favourite IDE

    git clone git@github.com:Dach0/crm-zen-app.git

Open terminal and copy env file:

    cp .env.example .env

If you have local instances of php and mysql and if your localhost is in use by other app it is advisable
to set up env variables for changing app access data. For instance, you can use:

```dotenv
APP_PORT=8085
APP_URL=http://crm-zen-app.localhost
FORWARD_DB_PORT=3310
```

Also in your .env set following db connection before running migrations

```dotenv
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=crm_zen_app
DB_USERNAME=sail
DB_PASSWORD=password
```

Then run following comands
    
    composer install

    ./vendor/bin/sail up

    artisan key:generate

    ./vendor/bin/sail artisan migrate --seed

    ./vendor/bin/sail npm install && npm run dev

And voila! You should be able to access your app at http://crm-zen-app.localhost:8085/

#### Possible errors

If you have used sail before, the might be some problems connecting to your database, as for rejecting
user sail to connect. 
Run the following commands and try migrating db again

    ./vendor/bin/sail down -v
    ./vendor/bin/sail up
    ./vendor/bin/sail artisan config:cache
    ./vendor/bin/sail artisan migrate
