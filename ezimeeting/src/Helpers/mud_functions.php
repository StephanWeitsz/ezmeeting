<?php

use Mudtec\Ezimeeting\Models\User;

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