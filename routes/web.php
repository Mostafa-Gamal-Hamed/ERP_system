<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompetitionsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WarehouseController;
use App\Http\Middleware\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Home
Route::controller(HomeController::class)->group(function() {
    Route::get('/', 'home');
    Route::get('/dashboard', 'home')->name('dashboard');
})->middleware(['IsAdmin', 'auth']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';


// Email verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


//// Pages

// Category
Route::controller(CategoryController::class)->group(function() {
    // All categories
    Route::get("categories", "index")->name('category.categories');
    // Add category
    Route::post("addCategory","store")->name('category.store');
    // Update category
    Route::put("updateCategory/{id}", "update")->name('category.update');
    // Delete category
    Route::delete("deleteCategory/{id}", "destroy")->name('category.delete');
});

// Purchases
Route::controller(PurchasesController::class)->group(function() {
    // All Purchases
    Route::get("purchases", "index")->name('purchases.purchases');
    // Add purchase page
    Route::get("addPurchases", "create")->name('purchases.add');
    // Add purchase
    Route::post("storePurchases", "store")->name('purchases.store');
    // Edit Purchases
    Route::get("editPurchase/{id}", "edit")->name('purchases.edit');
    // Update Purchases
    Route::put("updatePurchase/{id}", "update")->name('purchases.update');
    // Delete Purchases
    Route::delete("deletePurchase/{id}", "destroy")->name("purchases.delete");
    // Search
    Route::get("purchases/search", "search")->name("purchases.search");
});

// Customers
Route::controller(CustomersController::class)->group(function() {
    // All Customers
    Route::get("customers", "index")->name('customer.customers');
    // Add customer page
    Route::get("addCustomer", "create")->name('customer.add');
    // Add customer
    Route::post("addCustomer", "store")->name('customer.store');
    // Edit customer
    Route::get("editCustomer/{id}", "edit")->name('customer.edit');
    // Update customer
    Route::put("updateCustomer/{id}", "update")->name('customer.update');
    // Delete customer
    Route::delete("deleteCustomer/{id}", "destroy")->name('customer.delete');
    // Search
    Route::get("customers/search", "search")->name("customer.search");
});

// Sales
Route::controller(SalesController::class)->group(function() {
    // All Sales
    Route::get("sales", "index")->name('sales.sales');
    // Add sale page
    Route::get("addSale", "create")->name('sales.add');
    // Add sale
    Route::post("storeSales", "store")->name('sales.store');
    // Edit sale
    Route::get("editSale/{id}", "edit")->name('sales.edit');
    // Update sale
    Route::put("updateSale/{id}", "update")->name('sales.update');
    // Delete sale
    Route::delete("deleteSale/{id}", "destroy")->name('sales.delete');
    // Search
    Route::get("sales/search", "search")->name("sales.search");
    // Get type
    Route::get('/get-product-types/{product_id}', 'getProductTypes')->name('getProductTypes');
});

// Warehouse
Route::controller(WarehouseController::class)->group(function() {
    // All Warehouse
    Route::get("warehouse", "index")->name('warehouse.warehouse');
    // Add warehouse page
    Route::get("addStock", "create")->name('warehouse.add');
    // Add warehouse
    Route::post("addStock", "store")->name('warehouse.store');
    // Update warehouse
    Route::put("updateStock/{id}", "update")->name('warehouse.update');
    // Delete warehouse
    Route::delete("deleteStock/{id}", "destroy")->name('warehouse.delete');
    // Search
    Route::get("warehouse/search", "search")->name("warehouse.search");
});

// Reports
Route::controller(ReportsController::class)->group(function () {
    // All Reports
    Route::get("reports", "index")->name('reports.reports');
    // Add report page
    Route::get("addReport", "create")->name('reports.add');
    // Add report
    Route::post("storeReport", "store")->name('reports.store');
    // Edit report
    Route::get("editReport/{id}", "edit")->name('reports.edit');
    // Update report
    Route::put("updateReport/{id}", "update")->name('reports.update');
    // Delete report
    Route::delete("deleteReport/{id}", "destroy")->name('reports.delete');
    // Search
    Route::get("reports/search", "search")->name("reports.search");
    // Download pdf
    Route::get("reports/{id}/pdf", "downloadPDF")->name('reports.downloadPDF');
});

// Accounts
Route::controller(AccountController::class)->group(function() {
    // All accounts
    Route::get("accounts", "index")->name('accounts.accounts');
    // Add account page
    Route::get("addAccount", "create")->name('accounts.add');
    // Add account
    Route::post("addAccount", "store")->name('accounts.store');
    // Update account
    Route::put("updateAccount/{id}", "update")->name('accounts.update');
    // Delete account
    Route::delete("deleteAccount/{id}", "destroy")->name('accounts.delete');
    // Search
    Route::get("accounts/search", "search")->name("accounts.search");
});

// Competitions
Route::controller(CompetitionsController::class)->group(function() {
    // All competitions
    Route::get("competitions", "index")->name('competitions.competitions');
    // Add competition page
    Route::get("addCompetition", "create")->name('competitions.add');
    // Add competition
    Route::post("addCompetition", "store")->name('competitions.store');
    // Update competition
    Route::put("updateCompetition/{id}", "update")->name('competitions.update');
    // Delete competition
    Route::delete("deleteCompetition/{id}", "destroy")->name('competitions.delete');
    // Search
    Route::get("competitions/search", "search")->name("competitions.search");
});

// Tasks
Route::controller(TasksController::class)->group(function() {
    // All tasks
    Route::get("tasks", "index")->name('tasks.tasks');
    // Add task page
    Route::get("addTask", "create")->name('tasks.add');
    // Add task
    Route::post("addTask", "store")->name('tasks.store');
    // Edit task
    Route::get("editTask/{id}", "edit")->name('tasks.edit');
    // Update task
    Route::put("updateTask/{id}", "update")->name('tasks.update');
    // Delete task
    Route::delete("deleteTask/{id}", "destroy")->name('tasks.delete');
    // Search
    Route::get("tasks/search", "search")->name("tasks.search");
});

// Users
Route::controller(UsersController::class)->group(function() {
    Route::middleware(Manager::class)->group(function () {
        // All users
        Route::get("users", "index")->name('users.users');
        // Add user page
        Route::get("addUser", "create")->name('users.add');
        // Add user
        Route::post("addUser", "store")->name('users.store');
        // Edit user
        Route::get("editUser/{id}", "edit")->name('users.edit');
        // Update user
        Route::put("updateUser/{id}", "update")->name('users.update');
        // Delete user
        Route::delete("deleteUser/{id}", "destroy")->name('users.delete');
        // Search
        Route::get("users/search", "search")->name("users.search");
        // Change role
        Route::put("changeRole/{id}", "changeRole")->name('users.change');
    });
});
