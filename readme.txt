edit Docker line 75 to install laravel 10 or 11
# Building process
>> COPY baseELEVEN/. .
>> COPY baseTEN/. .

Login to terminal and run
# Install Jetstream with Livewire scafolding
php artisan jetstream:install livewire  --teams

# Install NPM dependencies and build assets
npm install && npm run build

#Run database migrations
php artisan migrate


in composer.json add
 
"require": {
       "mudtec/ezimeeting": "dev-main"

and 
 "repositories": {
        "0": {
            "type": "path",
            "url": "./packages/mudtec/ezimeeting"
        }
    }


# Run composer update
composer update

#publish public
php artisan vendor:publish --tag=public --ansi --force


///
php artisan migrate:fresh
php artisan db:seed --class="Mudtec\\Ezimeeting\\Database\\Seeders\\EzimeetingDatabaseSeeder"

