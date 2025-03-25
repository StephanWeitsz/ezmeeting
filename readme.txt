Move out the Docker files to a folder  called server.
in Server place Packages folder in : mudtec > ezimeeting

Install Docker Desktop

Build Docker Image drom Dockerfile
Compose Up the Docker Image
this should install the Portal, Database, PG-Admin and MailHog 
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

#For testing purpose if you dont have a base laravel application
go to resources > view find the welkome.blade.php 
add following in the section indecated
    <a
        href="{{ url('/eziMeeting') }}"
        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
    >
        EziMeeting
    </a>

    in this section 
        @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end">
                @auth
                    <a
                        href="{{ url('/dashboard') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Dashboard
                    </a>

                    << add it here >>

                @else

if jetstream is installed then there will be a dashboard.blade.php and navigation-menu.blade.php files in the same folder as welcome
edit the navigation-menu.blade.php file 
add the following to the file section indecated
    <x-nav-link href="{{  url('/eziMeeting')  }}" :active="request()->routeIs('eziMeeting')">
        {{ __('eziMeeting') }}
    </x-nav-link>
    <x-nav-link href="{{  url('/telescope')  }}" :active="request()->routeIs('eziMeeting')">
        {{ __('Telescope') }}
    </x-nav-link>

in this section
    <!-- Navigation Links -->
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>

        << add it here >>

    </div> 


# Run composer update
composer update

#publish public
php artisan vendor:publish --tag=public --ansi --force

#Run database migrations
php artisan migrate:refresh
php artisan db:seed --class="Mudtec\\Ezimeeting\\Database\\Seeders\\EzimeetingDatabaseSeeder"
