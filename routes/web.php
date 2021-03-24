<?php

use App\Http\Controllers\Test;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Frontpage;
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/runserver', function () {

    // Artisan::call('make:controller Test');
    // $output = Artisan::output();
    // $output = shell_exec("php artisan serve");

    // $data['output'] = shell_exec( '(cd '. base_path() .'ls)' );
    // $data['output'] = shell_exec( " pwd " );
    // Artisan::call('serve');
    // $output = shell_exec("cd .. ; pwd");
    $output['output']  = shell_exec('git pull origin master');
    // $output = shell_exec('cd.');
    // $data['output'] = shell_exec( '(cd '. base_path() .' && git pull origin master)' );
        // dd( '('. base_path() .' php artisan serve)' );

    dd($output);
    // Artisan::call('mail:send 1 --queue=default');

    // dd("Cache is cleared");



    // $cmd = 'php '.base_path().'/php artisan serve';
// $export = shell_exec('ls');
dd($data);

    
    
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::group(['middleware' =>[
    'auth:sanctum',
    'verified'
] ], function (){
    Route::get( '/dashboard', function() {return view('dashboard'); } )->name('dashboard');
    Route::get( '/pages', function() { return view('admin.pages'); } )->name('pages');
    Route::get( '/clients', function() { return view('admin.clients'); } )->name('clients');
    
} ); 


Route::get('/{ urlslug }', Frontpage::class);
Route::get('/', Frontpage::class);
Route::get('/gitpull', [Test::class, 'gitpull']);
