<?php

use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\InquiryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\TermsController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [HomeController::class, 'index'])
    ->name('index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.index'));
    });

Route::get('/pages/{id}', [HomeController::class, 'pages'])
    ->name('pages')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Pages'), route('frontend.pages'));
    });

Route::get('terms', [TermsController::class, 'index'])
    ->name('pages.terms')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Terms & Conditions'), route('frontend.pages.terms'));
    });

Route::get('privacy', [TermsController::class, 'privacy'])
    ->name('pages.privacy')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Privacy'), route('frontend.pages.privacy'));
    });

Route::get('inquiry', [InquiryController::class, 'create'])
    ->name('pages.inquiry.create')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Inquiry'), route('frontend.pages.inquiry.create'));
    });

Route::post('inquiry', [InquiryController::class, 'store'])->name('pages.inquiry.store');

// Route::get('customer', [CustomerController::class, 'create'])
//     ->name('pages.customer.create')
//     ->breadcrumbs(function (Trail $trail) {
//         $trail->parent('frontend.index')
//             ->push(__('customer'), route('frontend.pages.customer.create'));
//     });

// Route::post('customer', [CustomerController::class, 'store'])->name('pages.customer.store');
// Route::post('customer/register', [CustomerController::class, 'registerCustomer']);

// Route::resource('customer', CustomerController::class);