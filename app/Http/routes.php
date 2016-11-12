<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Role;
use App\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function () {
    $user = User::findorFail(1);

    $role = new Role(['name'=>'Subscriber']);

    $user->roles()->save($role);
});

Route::get('/read', function () {
    $user = User::findOrFail(1);

    foreach ($user->roles as $role) {
        echo $role->name;
    }

});

Route::get('/update', function () {
    $user = User::findOrfail(1);

    if ($user->has('roles')){
        foreach ($user->roles as $role) {
            $role->update(['name'=>'Administrator']);
            $role->save();
        }
    }

});

Route::get('/delete', function () {
    $user = User::findOrfail(1);

    foreach ($user->roles as $role) {
        $role->where('name', 'Subscriber')->delete(1);

    }

});
