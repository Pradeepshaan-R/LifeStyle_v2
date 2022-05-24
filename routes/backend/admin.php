<?php

use Tabuna\Breadcrumbs\Trail;
use App\Exports\InquiryExport;
use App\Models\Variation_Type;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\HelpController;
use App\Http\Controllers\Backend\TestController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\StockController;
use App\Http\Controllers\Backend\AuthorController;
use App\Http\Controllers\Backend\InquiryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserExtraController;
use App\Http\Controllers\Backend\VariationController;
use App\Http\Controllers\Backend\VariationTypeController;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });

//Test routes
Route::get('test/sendEmail', [TestController::class, 'sendEmail']);

Route::get('help', [HelpController::class, 'index'])->name('help');

Route::resource('author', AuthorController::class);

Route::get('book/autocomplete', [BookController::class, 'autocomplete'])->name('book.autocomplete');
Route::get('book/check_duplicate/{isbn}', [BookController::class, 'checkDuplicate'])->name('book.check_duplicate');
Route::post('book/import', [BookController::class, 'csvImport_show'])->name('book.import_show');
Route::patch('book/import', [BookController::class, 'csvImport_store'])->name('book.import_store');
Route::resource('book', BookController::class);

Route::get('user_settings', [UserExtraController::class, 'user_settings_get'])->name('user_extra.user_settings_get');
Route::post('user_settings', [UserExtraController::class, 'user_settings_set'])->name('user_extra.user_settings_set');
Route::resource('user_extra', UserExtraController::class);


Route::get('inquiry/export_csv', function () {
    return Excel::download(new InquiryExport, 'inquiries.csv');
});
Route::resource('inquiry', InquiryController::class);

Route::resource('brand', BrandController::class);
Route::resource('category', CategoryController::class);
Route::resource('product', ProductController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('stock', StockController::class);
// Route::resource('show_product/{id}',[ ProductController::class ,'show'])->name('show_product');
Route::resource('variation', VariationController::class);
Route::resource('variation_type', VariationTypeController::class);
