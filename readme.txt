Move out the Docker files to a folder  called server.
in Server place Packages > mudtec > ezimeeting

Install Docker Desktop

Build Docker Image drom Dockerfile
Compose Up the Docker Image
this should install the Portal, Database, PGAdmin and MailHog 
If the laravel installer does not work. perform actions outlined in docker file

Once laravel is installed perform following actions.

#in composer.json add to autoload and autoload-dev
    "require": {
        "php": "^8.2",
        "laravel/jetstream": "^5.2",
        "laravel/telescope": "^5.2",
        "livewire/livewire": "^3.0"

and

    "autoload": {
        "psr-4": {
            "Mudtec\\Ezimeeting\\": "src/",
            "Mudtec\\Ezimeeting\\Database\\Seeders\\": "packages/mudtec/ezimeeting/src/Database/Seeders",
            "Mudtec\\Ezimeeting\\Database\\Factory\\": "packages/mudtec/ezimeeting/src/Database/Factories"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "Mudtec\\Ezimeeting\\Tests\\": "packages/mudtec/ezimeeting/src/Tests"
        }

and

    "extra": {
        "laravel": {
            "providers": [
                "Mudtec\\Ezimeeting\\Providers\\EzimeetingProvider"
            ]
        },
        "branch-alias": {
            "dev-main": "1.0.x-dev"
        }     
    }


#in PHPunit.xml add the following

    </php>
    <testsuites>
        <testsuite name="Ezimeeting Package Tests">
            <directory>./src/Tests</directory>
        </testsuite>
    </testsuites>

# Run composer update
composer update

#publish public
php artisan vendor:publish --tag=public --ansi --force

#Run database migrations
php artisan migrate:refresh
php artisan db:seed --class="Mudtec\\Ezimeeting\\Database\\Seeders\\EzimeetingDatabaseSeeder"
