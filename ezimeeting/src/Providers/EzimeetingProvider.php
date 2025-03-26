<?php

namespace Mudtec\Ezimeeting\Providers;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Illuminate\Support\Facades\Blade;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\View;
use Illuminate\Routing\Router;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\View\Compilers\BladeCompiler;
use Mudtec\Ezimeeting\Http\Controllers\HomeController;
//use Illuminate\Support\Facades\Gate;

use Illuminate\Contracts\Http\Kernel;

use Livewire\Livewire;

use Mudtec\Ezimeeting\Models\User;
use Mudtec\Ezimeeting\Policies\UserPolicy;

use Mudtec\Ezimeeting\Http\Middleware\CheckCorporationMembership;
use Mudtec\Ezimeeting\Listeners\eziMeetingLogin;
use Mudtec\Ezimeeting\Listeners\eziMeetingRegister;

//use Mudtec\Ezimeeting\Database\Seeders\EzimeetingDatabaseSeeder;

class EzimeetingProvider extends ServiceProvider
{
    public const HOME = '/home';
    protected $namespace = 'Mudtec\Ezimeeting\Http\Controllers';
   
    /*
    protected $policies = [
        'Mudtec\Ezimeeting\Models\User' => UserPolicy::class,
    ];
    */

    public function boot() 
    {
        //$this->registerConfigs();
        $this->registerHelpers();
        $this->registerListners();
        $this->registerMigrations();
        $this->registerRoutes();
        $this->registerViews();
        $this->registerLivewire();
        $this->registerPublishables();
        //$this->registerPolicies();
  
    }

    protected function registerListners() {
        Event::listen(Login::class, eziMeetingLogin::class);
        Event::listen(Registered::class, eziMeetingRegister::class);
    }

    protected function registerConfigs() {
        $configFiles = [
            __DIR__.'/../../config/ezimeeting.php' => 'ezimeeting',
           // __DIR__.'/../../config/auth.php' => 'auth',
        ];
    
        foreach ($configFiles as $configFile => $configKey) {
            $this->mergeConfigFrom($configFile, $configKey);
        }
    }

    protected function registerHelpers() {
        // Register the helper files
        $helperFiles = [
            __DIR__.'/../Helpers/mud_functions.php',
            
            // Add more helper files here
        ];

        foreach ($helperFiles as $file) {
            if (file_exists($file)) {
                require $file;
            }
        }
    }
    
    protected function registerViews() {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'ezimeeting');
        Blade::anonymousComponentPath(__DIR__.'/../../resources/views/components', 'ezim');
    }

    protected function registerLivewire() {
        Livewire::component('menu', \Mudtec\Ezimeeting\Livewire\Menus\Menu::class);

        Livewire::component('corporationRegister', \Mudtec\Ezimeeting\Livewire\Registration\CorporationRegister::class);

        Livewire::component('corporationList', \Mudtec\Ezimeeting\Livewire\Admin\Corporations\CorporationList::class);
        Livewire::component('corporationCreate', \Mudtec\Ezimeeting\Livewire\Admin\Corporations\CorporationCreate::class);
        Livewire::component('corporationEdit', \Mudtec\Ezimeeting\Livewire\Admin\Corporations\CorporationEdit::class);
        Livewire::component('corporationUser', \Mudtec\Ezimeeting\Livewire\Admin\Corporations\CorporationUser::class);

        Livewire::component('departmentCorparationsList', \Mudtec\Ezimeeting\Livewire\Admin\Departments\DepartmentCorporationsList::class);
        Livewire::component('departmentList', \Mudtec\Ezimeeting\Livewire\Admin\Departments\DepartmentList::class);
        Livewire::component('departmentCreate', \Mudtec\Ezimeeting\Livewire\Admin\Departments\DepartmentCreate::class);
        Livewire::component('departmentEdit', \Mudtec\Ezimeeting\Livewire\Admin\Departments\DepartmentEdit::class);
        Livewire::component('departmentManager', \Mudtec\Ezimeeting\Livewire\Admin\Departments\DepartmentManager::class);

        Livewire::component('usersList', \Mudtec\Ezimeeting\Livewire\Admin\Users\UsersList::class);
        Livewire::component('userEdit', \Mudtec\Ezimeeting\Livewire\Admin\Users\UserEdit::class);
        Livewire::component('userRole', \Mudtec\Ezimeeting\Livewire\Admin\Users\UserRole::class);

        Livewire::component('rolesList', \Mudtec\Ezimeeting\Livewire\Admin\Roles\rolesList::class);
        Livewire::component('roleCreate', \Mudtec\Ezimeeting\Livewire\Admin\Roles\roleCreate::class);
        Livewire::component('roleEdit', \Mudtec\Ezimeeting\Livewire\Admin\Roles\roleEdit::class);

        Livewire::component('meetingStatusManager', \Mudtec\Ezimeeting\Livewire\Admin\Meeting\MeetingStatusManager::class);
        Livewire::component('meetingIntervalManager', \Mudtec\Ezimeeting\Livewire\Admin\Meeting\MeetingIntervalManager::class);
        Livewire::component('meetingLocationManager', \Mudtec\Ezimeeting\Livewire\Admin\Meeting\MeetingLocationManager::class);

        Livewire::component('meetingDelegateRoleManager', \Mudtec\Ezimeeting\Livewire\Admin\Meeting\MeetingDelegateRoleManager::class);
        Livewire::component('meetingAttendeeStatusManager', \Mudtec\Ezimeeting\Livewire\Admin\Meeting\MeetingAttendeeStatusManager::class);
        Livewire::component('meetingMinuteActionStatusManager', \Mudtec\Ezimeeting\Livewire\Admin\Meeting\MeetingMinuteActionStatusManager::class);

        Livewire::component('newMeeting', \Mudtec\Ezimeeting\Livewire\Meeting\NewMeeting::class);
        Livewire::component('newMeetingDelegates', \Mudtec\Ezimeeting\Livewire\Meeting\NewMeetingDelegates::class);
        Livewire::component('MeetingList', \Mudtec\Ezimeeting\Livewire\Meeting\MeetingList::class);
        Livewire::component('MeetingDetail', \Mudtec\Ezimeeting\Livewire\Meeting\MeetingDetail::class);
        Livewire::component('MeetingDelegates', \Mudtec\Ezimeeting\Livewire\Meeting\MeetingDelegates::class);
        Livewire::component('MeetingDelegateRoles', \Mudtec\Ezimeeting\Livewire\Meeting\MeetingDelegateRoles::class);
        Livewire::component('MeetingMinutesList', \Mudtec\Ezimeeting\Livewire\Meeting\MeetingMinutesList::class);
        Livewire::component('newMeetingMinute', \Mudtec\Ezimeeting\Livewire\Meeting\NewMeetingMinute::class);

        //Livewire::component('MeetingMinutes', \Mudtec\Ezimeeting\Livewire\Meeting\MeetingMinutes::class);

        
    }

    public function registerPublishables() {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('ezi-meeting.php'),
            ], 'ezi-meeting:config');

            $this->publishes([
                __DIR__.'/../../resources/assets/' => public_path(''),
                ], 'ezi-meeting:assets');
        }
    }

    public function registerRoutes() {

        //$this->app['router']->pushMiddlewareToGroup(\Mudtec\Ezimeeting\Http\Middleware\RedirectToEzimeeting::class);
        //$this->app['router']->pushMiddlewareToGroup('web', \Mudtec\Ezimeeting\Http\Middleware\CheckCorporationMembership::class);
        
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

    public function registerMigrations() {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }

    public function register() {
        
    }
}
