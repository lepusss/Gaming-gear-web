<?php
use App\Http\Controllers\AdminController;


use App\Http\Controllers\TemplateController;
use App\Http\Controllers\CustomAuthController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[TemplateController::class,'index']);
Route::get('/customerHome',[TemplateController::class,'showCustomer'])->middleware('isLoggedIn');
// Route::get('home2',[TemplateController::class,'pageBreak']);





// Route::post('/upload',[ProductController::class,'upload']);
//Login and registration

Route::get('/registration',[CustomAuthController::class,'registration'])->middleware('alreadyLoggedIn');
Route::post('/register-user',[CustomAuthController::class,'registerUser'])->name('register-user');
Route::get('/adLogin',[AdminController::class,'login'])->middleware('alreadyLoggedIn');
Route::post('/login-admin',[AdminController::class,'loginAdmin'])->name('login-admin');
Route::get('/logout',[AdminController::class,'logout'])->name('logout');
// Admin

Route::get('/addashboard',[AdminController::class,'addashboard'])->middleware('isLoggedIn');

//Function product
Route::get('product-list',[AdminController::class,'showProduct']);
Route::get('add-product',[AdminController::class,'addProduct']);
Route::post('save-product',[AdminController::class,'saveProduct']);
Route::get('edit-product/{productID}',[AdminController::class,'editProduct']);
Route::post('update-product',[AdminController::class,'updateProduct']);
Route::get('delete-product/{productID}',[AdminController::class,'deleteProduct']);
//Category
Route::get('categoryFrontEnd',[AdminController::class,'catShow']);
Route::get('accountDetails',[TemplateController::class,'customerDetails']);
Route::get('add-category',[AdminController::class,'addCategory']);
Route::post('save-category',[AdminController::class,'saveCat']);
Route::get('delete-category/{categoryID}',[AdminController::class,'deleteCategory']);
Route::get('edit-category/{categoryID}',[AdminController::class,'editCategory']);
Route::post('update-category',[AdminController::class,'updateCategory']);
//Manufactuer
Route::get('manufacturer-list',[AdminController::class,'manuShow']);
Route::get('add-manufacturer',[AdminController::class,'addManufacturer']);
Route::post('save-manufacturer',[AdminController::class,'saveManu']);
Route::get('delete-manufacturer/{manufacturerID}',[AdminController::class,'deleteManufacturer']);
Route::get('edit-manufacturer/{manufacturerID}',[AdminController::class,'editManufacturer']);
Route::post('update-manufacturer',[AdminController::class,'updateManufacturer']);
//Customer management
Route::get('customer-list',[AdminController::class,'cusShow']);
Route::get('delete-customer/{customerID}',[AdminController::class,'deleteCustomer']);
