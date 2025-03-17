<?php

use Mudtec\Ezimeeting\Models\User;
use Mudtec\Ezimeeting\Models\Corporation;
use Mudtec\Ezimeeting\Models\Department;

if(!function_exists('verify_user')) {
  
    function verify_user($list) {
        if(auth()->check()) {
            $user = User::find(auth()->id());
            $roles  = explode('|', $list);
            foreach($roles as $role) {
                if ($user && $user->hasRole($role)) {
                    return true;
                } //if ($user && $user->hasRole($role)) {
            } //foreach($roles as $role) {              
            return false;
        } //if(auth()->check()) {
        return view('home');
    } //function verify_user($list) {

} //if(!function_exists('verify_user')) {

if(!function_exists('get_user_corporation')) {
    function get_user_corporation() {
        $user = User::with('corporations')->find(auth()->id());
        return $user->corporations;
    }
}

if(!function_exists('get_user_department')) {
    function get_user_department() {
        $user = User::find(auth()->id());
        return $user->corporation->department;
    }
}

