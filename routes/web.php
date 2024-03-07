<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ToDoListController;
use App\Http\Controllers\CompleteTaskController;
use App\Http\Controllers\User\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::redirect('/','/loginPage');
Route::get('/loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
Route::get('/registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');


Route::get("/",function(){
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::prefix('toDoList')->group(function(){
        Route::get('/home',[ToDoListController::class,'home'])->name('main#home');
        Route::post('/create',[ToDoListController::class,'create'])->name('create#todolist');
        Route::get('/edit/{id}',[ToDoListController::class,'edit'])->name('toDoList#edit');
        Route::post('/update/{id}',[ToDoListController::class,'update'])->name('toDoList#update');
        Route::get('/destroy/{id}',[ToDoListController::class,'destroy'])->name('toDoList#destroy');
        Route::get("/complete/taskPage",[CompleteTaskController::class,'completePage'])->name('toDoList#completeTaskPage');
    });

    // Route::get('/home',[ToDoListController::class,'home'])->name('main#home');
    // Route::post('/create/todolist',[ToDoListController::class,'create'])->name('create#todolist');
    // Route::get('/edit/todoListPage/{id}',[ToDoListController::class,'edit'])->name('toDoList#edit');
    // Route::post('/update/todoListPage/{id}',[ToDoListController::class,'update'])->name('toDoList#update');
    // Route::get('/destroy/todoListPage/{id}',[ToDoListController::class,'destroy'])->name('toDoList#destroy');

    

    Route::prefix('ajax')->group(function(){
        Route::get("/todolist/complete/task",[ToDoListController::class,'complete'])->name('toDoList#completeTask');
        Route::get("/todolist/delete/all/task",[ToDoListController::class,'deleteAll'])->name('toDoList#deleteAll');
    });

    // Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    // Route::group(['prefix'=>"customer","middleware"=>"codelab_middleware"],function(){
    //     Route::get("home",[CustomerController::class,"home"]);
    //     Route::get("about",[CustomerController::class,"about"]);
    //     Route::get("service",[CustomerController::class,"service"]);
    // });

    // Route::get("userPage",function(){
    //     return "userPage";
    // })->middleware("codelab_middleware");
});





