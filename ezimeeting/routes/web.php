<?php

use Illuminate\Support\Facades\Route;

use Mudtec\Ezimeeting\Http\Controllers\HomeController as HomeController;
use Mudtec\Ezimeeting\Http\Controllers\AdminController as AdminController;
use Mudtec\Ezimeeting\Http\Controllers\CorporationController as CorporationController;
use Mudtec\Ezimeeting\Http\Controllers\DepartmentController as DepartmentController;
use Mudtec\Ezimeeting\Http\Controllers\CorpuserController as CorpuserController;
use Mudtec\Ezimeeting\Http\Controllers\RoleController as RoleController;
use Mudtec\Ezimeeting\Http\Controllers\MeetingController as MeetingController;

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('web')->group(function () {  
    Route::get('/underDevelopment', function () {
        return view('ezimeeting::underDevelopment');
    })->name('underDevelopment');
    
    Route::get('/admin/corporations', [CorporationController::class, 'corporations'])->name('corporations');
    Route::get('/admin/corporations/create', [CorporationController::class, 'create'])->name('corporationsCreate');
    Route::get('/admin/corporations/update/{corporation}', [CorporationController::class, 'update'])->name('corporationsUpdate');
    Route::get('/admin/corporations/users', [CorporationController::class, 'users'])->name('corporationsUser');

    Route::get('/admin/departments', [DepartmentController::class, 'corporations'])->name('corpDepartments');
    Route::get('/admin/departments/{corporation}', [DepartmentController::class, 'departments'])->name('departments');
    Route::get('/admin/departments/{corporation}/create', [DepartmentController::class, 'create'])->name('departmentCreate');
    Route::get('/admin/departments/{corporation}/update/{department}', [DepartmentController::class, 'update'])->name('departmentUpdate');
    Route::get('/admin/department/managers', [DepartmentController::class, 'manager'])->name('departmentManagers');

    Route::get('/admin/users', [CorpuserController::class, 'list'])->name('corpUsers');
    Route::get('/admin/users/{user}', [CorpuserController::class, 'edit'])->name('corpUserEdit');

    Route::get('/admin/meeting/status/manager', [AdminController::class, 'meetingstatus'])->name('meetingStatus');
    Route::get('/admin/meeting/interval/manager', [AdminController::class, 'meetinginterval'])->name('meetingInterval');
    Route::get('/admin/meeting/location/manager', [AdminController::class, 'meetinglocation'])->name('meetingLocation');

    Route::get('/admin/meeting/delegate/role/manager', [AdminController::class, 'meetingdelegaterole'])->name('meetingDelegateRole');
    Route::get('/admin/meeting/attendee/status/manager', [AdminController::class, 'meetingattendeestatus'])->name('meetingAttendeeStatus');
    Route::get('/admin/meeting/minute/action/status/manager', [AdminController::class, 'meetingminuteactionstatus'])->name('meetingMinuteActionStatus');

    Route::get('/admin/roles', [RoleController::class, 'roles'])->name('roles');
    Route::get('/admin/role/create', [RoleController::class, 'create'])->name('roleCreate');
    Route::get('/admin/role/{role}', [RoleController::class, 'role'])->name('roleUpdate');

    
    Route::get('/meeting/new', [MeetingController::class, 'new'])->name('newMeeting');
});


