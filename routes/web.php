<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\VendorPaymentController;
use App\Http\Controllers\Employee\RewardController;
use App\Http\Controllers\Employee\SalaryController;
use App\Http\Controllers\Employee\DiscountController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\VacationController;

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
Route::get('/changeconf', function () {

    config(['app.device' => true]);
    $r = config('app.device');
    return dd($r);
});


Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return 'Application cache has been cleared';
});

Auth::routes();



Route::group(['middleware' => ['auth']], function () {
    Route::post('/logoutt', [LoginController::class, 'logoutOver'])->name('logoutOver');
    Route::get('/', [ReportsController::class, 'statics']);
    Route::get('/home', [ReportsController::class, 'statics'])->name('home');
    Route::group(['prefix' => 'shiping', 'as' => 'shiping.'], function () {
        Route::get('/{id}', [ShippingController::class, 'index'])->name('index');  // Changed to Route::get()
        Route::get('finished/{id}', [ShippingController::class, 'indexfinished'])->name('indexfinished');  // Changed to Route::get()
        Route::get('/edit/{id}', [ShippingController::class, 'edit'])->name('edit');
        Route::post('/update', [ShippingController::class, 'update'])->name('update');
        Route::post('/deleteShipping', [ShippingController::class, 'deleteShipping'])->name('deleteshiping'); // Use delete method for delete operation
        Route::post('/info', [ShippingController::class, 'info'])->name('info');  // Changed to Route::get()
        Route::post('/infopay', [ShippingController::class, 'infopay'])->name('infopay');  // Changed to Route::get()
        Route::get('/enterDriver/{id}', [ShippingController::class, 'enterDriver'])->name('enterDriver'); // Use POST for form submission
        Route::post('/storeDriverShipping', [ShippingController::class, 'storeDriverShiping'])->name('storeDrivershiping');
        Route::get('/trashed', [ShippingController::class, 'indexTrashed'])->name('indexTrashed');  // Changed to Route::get()
        Route::get('/create', [ShippingController::class, 'create'])->name('create');
        Route::post('/store', [ShippingController::class, 'store'])->name('store');
        Route::post('/delete', [ShippingController::class, 'delete'])->name('delete'); // Use DELETE method for delete
        Route::post('/changestatus', [ShippingController::class, 'changestatus'])->name('changestatus'); // Use DELETE method for delete

        
        Route::get('/exportpdf', [ShippingController::class, 'exportPDF'])->name('exportPDF');
        Route::get('/print/{id}', [ShippingController::class, 'print'])->name('print');
        Route::get('/printforcompany/{id}', [ShippingController::class, 'printforcompany'])->name('printforcompany');
        Route::get('/printfordriver/{id}', [ShippingController::class, 'printfordriver'])->name('printfordriver');
        Route::get('/editDriver/{id}', [ShippingController::class, 'editDriver'])->name('editDriver');
    });
    
    Route::group(['prefix' => 'payment', 'as' => 'payment.'], function () {
        Route::post('/store', [PaymentController::class, 'newpay'])->name('store');
        Route::get('/', [PaymentController::class, 'index'])->name('index');
    });
    Route::group(['prefix' => 'driver', 'as' => 'driver.'], function () {
        Route::get('/index', [DriverController::class, 'index'])->name('index');
        Route::get('/driverjson', [DriverController::class, 'driverjson'])->name('json');
        Route::post('/store', [DriverController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [DriverController::class, 'edit'])->name('edit');
        Route::post('/update', [DriverController::class, 'update'])->name('update');
        Route::any('/delete', [DriverController::class, 'delete'])->name('delete');

    });
    Route::group(['prefix' => 'types', 'as' => 'types.'], function () {
        Route::get('/typesjson', [TypeController::class, 'typesjson'])->name('json');
        Route::get('/index', [TypeController::class, 'index'])->name('index');
        Route::post('/store', [TypeController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [TypeController::class, 'edit'])->name('edit');
        Route::post('/update', [TypeController::class, 'update'])->name('update');
        Route::any('/delete', [TypeController::class, 'delete'])->name('delete');

    });
    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
    });
    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
        Route::get('/', [ReportsController::class, 'index'])->name('index');
        Route::get('/drivers/{id}', [ReportsController::class, 'shipnumberReport'])->name('shipnumberReport');
        Route::get('/carnum', [ReportsController::class, 'carnumreport'])->name('carnumreport');
        Route::get('/shipnumber', [ReportsController::class, 'shipnumber'])->name('shipnumber');
        
        Route::post('/carsnotdecharge', [ReportsController::class, 'carsnotdecharge'])->name('carsnotdecharge');
        Route::post('/carstatus', [ReportsController::class, 'carstatus'])->name('carstatus');
        Route::post('/typerepo', [ReportsController::class, 'typereport'])->name('typereport');
        Route::post('/vendorpaymentsreport', [ReportsController::class, 'vendorpaymentsreport'])->name('vendorpaymentsreport');
        Route::get('/printrec/{id}', [VendorPaymentController::class, 'printrec'])->name('printrec');
    });
    Route::group(['prefix' => 'discount', 'as' => 'discount.'], function () {
        Route::any('/', [DiscountController::class, 'index'])->name('index');
        Route::any('/trashed', [DiscountController::class, 'indextrashed'])->name('indextrashed');
        Route::any('/store', [DiscountController::class, 'storedebit'])->name('storedebit');
        Route::any('/store2', [DiscountController::class, 'storediscount'])->name('storediscount');
        Route::any('/delete', [DiscountController::class, 'delete'])->name('delete');
        Route::post('/exportexl', [DiscountController::class, 'exportexel'])->name('exportexel');
    });
    Route::group(['prefix' => 'rewards', 'as' => 'rewards.'], function () {
        Route::any('/', [RewardController::class, 'index'])->name('index');
        Route::any('/trashed', [RewardController::class, 'indextrashed'])->name('indextrashed');
        Route::any('/store', [RewardController::class, 'store'])->name('store');
        Route::any('/delete', [RewardController::class, 'delete'])->name('delete');
        Route::post('/exportexl', [RewardController::class, 'exportexel'])->name('exportexel');
    });
    Route::group(['prefix' => 'employees', 'as' => 'employees.'], function () {
        Route::any('/', [EmployeeController::class, 'index'])->name('index');
        Route::any('/trashed', [EmployeeController::class, 'indexemployeetrashed'])->name('trashed');
        Route::any('/edit/{id}', [EmployeeController::class, 'edit'])->name('edit');
        Route::any('/create', [EmployeeController::class, 'create'])->name('create');
        Route::any('/store', [EmployeeController::class, 'store'])->name('store');
        Route::any('/delete', [EmployeeController::class, 'delete'])->name('delete');
        Route::any('/update', [EmployeeController::class, 'update'])->name('update');
        Route::any('/export', [EmployeeController::class, 'exportemployee'])->name('exportemployee');
        Route::post('/restore', [EmployeeController::class, 'restore'])->name('restore');
        Route::post('/destroy', [EmployeeController::class, 'destroy'])->name('destroy');

        Route::group(['prefix' => 'vacations', 'as' => 'vacations.'], function () {
            Route::get('/', [VacationController::class, 'index'])->name('index');
            Route::get('/trashed', [VacationController::class, 'indextrashed'])->name('indextrashed');
            Route::post('/store', [VacationController::class, 'store'])->name('store');
            Route::post('/delete', [VacationController::class, 'delete'])->name('delete');
            Route::get('/create', [VacationController::class, 'create'])->name('create');
            Route::post('/exportexl', [VacationController::class, 'exportexel'])->name('exportexel');
        });
        Route::group(['prefix' => 'vendorpayments', 'as' => 'vendorpayments.'], function () {
            Route::get('/', [VendorPaymentController::class, 'index'])->name('index');
        });
        Route::group(['prefix' => 'dataentry', 'as' => 'dataentry.'], function () {
            Route::get('/', [EmployeeController::class, 'indexdataentry'])->name('index');
            Route::post('/addbalance', [EmployeeController::class, 'addbalance'])->name('addbalance');
            Route::post('/status', [EmployeeController::class, 'status'])->name('status');
            
            Route::get('/trashed', [EmployeeController::class, 'indexdatainttrashed'])->name('trashed');
            Route::get('/create', [EmployeeController::class, 'createdataentry'])->name('create');
            Route::get('/edit/{id}', [EmployeeController::class, 'editdataentry'])->name('edit');
        });
    });
    Route::group(['prefix' => 'salaries', 'as' => 'salaries.'], function () {
        Route::any('/', [SalaryController::class, 'index'])->name('index');
        Route::any('/trashed', [SalaryController::class, 'indextrashed'])->name('indextrashed');
        Route::any('/create', [SalaryController::class, 'create'])->name('create');
        Route::any('/store', [SalaryController::class, 'store'])->name('store');
        Route::any('/delete', [SalaryController::class, 'delete'])->name('delete');
    });
    Route::resource('roles', \App\Http\Controllers\Role\RoleController::class);
    Route::post('roles/delete/{id}', [\App\Http\Controllers\Role\RoleController::class, 'delete'])->name('role.delete');
});
