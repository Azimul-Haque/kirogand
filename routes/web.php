<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'IndexController@index')->name('index.index');
Route::get('/terms-and-conditions', 'IndexController@termsAndConditions')->name('index.terms-and-conditions');
Route::get('/privacy-policy', 'IndexController@privacyPolicy')->name('index.privacy-policy');
Route::get('/refund-policy', 'IndexController@refundPolicy')->name('index.refund-policy');
Route::post('/payment/proceed', 'IndexController@paymentProceed')->name('index.payment.proceed');
Route::get('/payment/cancel', 'IndexController@paymentCancel')->name('index.payment.cancel');
Route::get('/payment/failed', 'IndexController@paymentFailed')->name('index.payment.failed');
Route::get('/payment/fail', 'IndexController@paymentFailed')->name('index.payment.failed');
Route::post('/payment/success', 'IndexController@paymentSuccess')->name('index.payment.success');
Route::post('/payment/app/confirm', 'IndexController@paymentSuccessApp')->name('index.payment.success.app');
Route::get('/payment/app/cancel', 'IndexController@paymentCancelApp')->name('index.payment.cancel.app');
Route::get('/check/ip', 'IndexController@checkIP')->name('index.check.ip');
Route::post('/account/deletion/request', 'IndexController@requestACDelete')->name('index.account.deletion.request');
Route::get('/redirect/playstore', 'IndexController@redirectPlayStore')->name('index.redirect.playstore');
Route::get('/documentation', 'IndexController@getDocumentation')->name('index.documentation');
Route::get('/api-status', 'IndexController@getAPIStatus')->name('index.api.status');

// blog
Route::get('/blogs', 'BlogController@index')->name('blogs.index');
// Route::resource('blogs','BlogController');
Route::get('blog/{slug}',['as' => 'blog.single', 'uses' => 'BlogController@getBlogPost']);
Route::get('blog/author/{id}',['as' => 'blogger.profile', 'uses' => 'BlogController@getBloggerProfile']);
Route::get('/like/{blog_id}',['as' => 'blog.like', 'uses' => 'BlogController@likeBlogAPI']);
Route::get('/check/like/{blog_id}',['as' => 'blog.checklike', 'uses' => 'BlogController@checkLikeAPI']);
Route::get('/blogs/category/{name}',['as' => 'blog.categorywise', 'uses' => 'BlogController@getCategoryWise']);
Route::get('/blogs/archive/{date}',['as' => 'blog.monthwise', 'uses' => 'BlogController@getMonthWise']);

// Clear Route
Route::get('/clear', ['as'=>'clear','uses'=>'IndexController@clear']);

// Payment Routes for bKash
Route::get('bkash/production/test', 'BkashController@prodTest')->name('bkash-prod-test');
Route::post('bkash/production/test/payment', 'BkashController@prodPaymentTest')->name('bkash-prod-test-payment');
Route::get('bkash/production/final/payment/{amount}/{mobile}/{package_id}', 'BkashController@prodPayment')->name('bkash-prod-final-payment');
Route::post('bkash/get-token', 'BkashController@getToken')->name('bkash-get-token');
Route::post('bkash/create-payment', 'BkashController@createPayment')->name('bkash-create-payment');
Route::post('bkash/execute-payment', 'BkashController@executePayment')->name('bkash-execute-payment');
Route::get('bkash/query-payment', 'BkashController@queryPayment')->name('bkash-query-payment');
Route::post('bkash/success', 'BkashController@bkashSuccess')->name('bkash-success');
Route::get('bkash/cancel/page', 'BkashController@bkashCancelPage')->name('bkash-cancel-page');
Route::get('bkash/success/page', 'BkashController@bkashSuccessPage')->name('bkash-success-page');
Route::get('bkash/failed/page', 'BkashController@bkashFailedPage')->name('bkash-failed-page');

Route::get('bkash/cancel/page/web', 'BkashController@bkashCancelPageWeb')->name('bkash-cancel-page-web');
Route::get('bkash/success/page/web', 'BkashController@bkashSuccessPageWeb')->name('bkash-success-page-web');
Route::get('bkash/failed/page/web', 'BkashController@bkashFailedPageWeb')->name('bkash-failed-page-web');
// Payment Routes for bKash

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
Route::get('/dashboard/clear/query/cache', 'DashboardController@clearQueryCache')->name('dashboard.clearquerycache');

Route::get('/dashboard/users', 'DashboardController@getUsers')->name('dashboard.users');
Route::get('/dashboard/users/sort', 'DashboardController@getUsersSort')->name('dashboard.userssort');
Route::get('/dashboard/users/expired', 'DashboardController@getExpiredUsers')->name('dashboard.expiredusers');
Route::post('/dashboard/users/expired/send/sms', 'DashboardController@sendExpiredSMS')->name('dashboard.users.expired.sms');
Route::get('/dashboard/users/{search}', 'DashboardController@getUsersSearch')->name('dashboard.users.search');
Route::get('/dashboard/users/{id}/single', 'DashboardController@getUser')->name('dashboard.users.single');
Route::get('/dashboard/users/{id}/single/otherpage', 'DashboardController@getUserWithOtherPage')->name('dashboard.users.singleother');
Route::post('/dashboard/users/store', 'DashboardController@storeUser')->name('dashboard.users.store');
Route::post('/dashboard/users/{id}/update', 'DashboardController@updateUser')->name('dashboard.users.update');
Route::post('/dashboard/users/bulk/package/update', 'DashboardController@updateBulkPackageDate')->name('dashboard.users.bulk.package.update');
Route::get('/dashboard/users/{id}/delete', 'DashboardController@deleteUser')->name('dashboard.users.delete');
Route::post('/dashboard/users/{id}/single/notification', 'DashboardController@sendSingleNotification')->name('dashboard.users.singlenotification');
Route::post('/dashboard/users/{id}/single/sms', 'DashboardController@sendSingleSMS')->name('dashboard.users.singlesms');

Route::get('/dashboard/payments', 'DashboardController@getPayments')->name('dashboard.payments');
Route::get('/dashboard/payments/{search}', 'DashboardController@getPaymentsSearch')->name('dashboard.payments.search');

Route::get('/dashboard/packages', 'DashboardController@getPackages')->name('dashboard.packages');
Route::post('/dashboard/packages/store', 'DashboardController@storePackage')->name('dashboard.packages.store');
Route::post('/dashboard/packages/{id}/update', 'DashboardController@updatePackage')->name('dashboard.packages.update');

Route::get('/dashboard/messages', 'DashboardController@getMessages')->name('dashboard.messages');
Route::post('/dashboard/messages/{id}/update', 'DashboardController@updateMessage')->name('dashboard.messages.update');
Route::get('/dashboard/messages/delete/{id}', 'DashboardController@deleteMessage')->name('dashboard.messages.delete');



Route::get('/dashboard/notifications', 'DashboardController@getNotifications')->name('dashboard.notifications');
Route::post('/dashboard/notifications/send', 'DashboardController@sendNotification')->name('dashboard.notifications.send');
Route::get('/dashboard/notifications/delete/{id}', 'DashboardController@deleteNotification')->name('dashboard.notifications.delete');
Route::post('/dashboard/notifications/send/again', 'DashboardController@sendAgainNotification')->name('dashboard.notifications.sendagain');

Route::get('/dashboard/blogs', 'DashboardController@getBlogs')->name('dashboard.blogs');
Route::get('/dashboard/blogs/{search}', 'DashboardController@getBlogsSearch')->name('dashboard.blogs.search');
Route::post('/dashboard/blogs/store', 'DashboardController@storeBlog')->name('dashboard.blogs.store');
Route::post('/dashboard/blogs/{id}/update', 'DashboardController@updateBlog')->name('dashboard.blogs.update');
Route::get('/dashboard/blogs/{id}/delete', 'DashboardController@deleteBlog')->name('dashboard.blogs.delete');
Route::post('/dashboard/blogs/category/store', 'DashboardController@storeBlogCategory')->name('dashboard.blogs.blogcategory.store');
Route::post('/dashboard/blogs/category/{id}/update', 'DashboardController@updateBlogCategory')->name('dashboard.blogs.blogcategory.update');




// Route::get('/dashboard/balance', 'DashboardController@getBalance')->name('dashboard.balance');
// Route::post('/dashboard/balance/store', 'DashboardController@storeBalance')->name('dashboard.balance.store');
// Route::get('/dashboard/balance/{id}/delete', 'DashboardController@deleteBalance')->name('dashboard.balance.delete');


Route::get('/dashboard/sites', 'DashboardController@getSites')->name('dashboard.sites');
Route::post('/dashboard/sites/store', 'DashboardController@storeSite')->name('dashboard.sites.store');
Route::post('/dashboard/sites/{id}/update', 'DashboardController@updateSite')->name('dashboard.sites.update');
Route::delete('/dashboard/sites/{id}/delete', 'DashboardController@deleteSite')->name('dashboard.sites.delete');

Route::get('/dashboard/sites/{id}', 'DashboardController@getSingleSite')->name('dashboard.sites.single');
Route::get('/dashboard/sites/{id}/categorywise', 'DashboardController@getSiteCategorywise')->name('dashboard.sites.categorywise');
Route::get('/dashboard/expense', 'DashboardController@getExpensePage')->name('dashboard.expense.index');
Route::post('/dashboard/expense/store', 'DashboardController@storeExpense')->name('dashboard.expense.store');
Route::get('/dashboard/expense/{id}/delete', 'DashboardController@deleteExpense')->name('dashboard.expense.delete');

Route::get('/dashboard/categories', 'DashboardController@getCategories')->name('dashboard.categories');
Route::get('/dashboard/categories/{id}', 'DashboardController@getSingleCategory')->name('dashboard.categories.single');
Route::get('/dashboard/categories/{id}/{selecteddate}', 'DashboardController@getSingleCategoryDate')->name('dashboard.categories.singledate');
Route::get('/dashboard/categories/{id}/{selecteddate}/{site_id}', 'DashboardController@getSingleCategoryDateSite')->name('dashboard.categories.singledatesite');
Route::post('/dashboard/categories/store', 'DashboardController@storeCategory')->name('dashboard.categories.store');
Route::post('/dashboard/categories/{id}/update', 'DashboardController@updateCategory')->name('dashboard.categories.update');

Route::get('/dashboard/monthly', 'DashboardController@getMonthly')->name('dashboard.monthly');



Route::get('/dashboard/creditors', 'DashboardController@getCreditors')->name('dashboard.creditors');
Route::get('/dashboard/creditors/{id}', 'DashboardController@getSingleCreditor')->name('dashboard.creditors.single');
Route::post('/dashboard/creditors/store', 'DashboardController@storeCreditor')->name('dashboard.creditors.store');
Route::post('/dashboard/creditors/{id}/update', 'DashboardController@updateCreditor')->name('dashboard.creditors.update');
Route::get('/dashboard/creditors/add/due', 'DashboardController@getAddDuePage')->name('dashboard.addduepage');
Route::post('/dashboard/creditors/due/store', 'DashboardController@storeCreditorDue')->name('dashboard.creditorsdue.store');
Route::post('/dashboard/creditors/due/{id}/update', 'DashboardController@updateCreditorDue')->name('dashboard.creditorsdue.update');
Route::get('/dashboard/creditors/due/{id}/delete', 'DashboardController@deleteCreditorDue')->name('dashboard.creditorsdue.delete');


Route::get('/dashboard/expenses/{transactiondate}/{user}', 'ExpenseController@getTodaysExpenseList')->name('dashboard.expenses.getlist');
Route::get('/dashboard/deposit/{transactiondate}/{user}', 'ExpenseController@getTodaysDepositList')->name('dashboard.deposit.getlist');

// test html question data
// Route::get('/single/exam/pdf/{softtoken}/{examid}', 'DashboardController@getExamSolvePDF')->name('index.single.exam.solve.pdf');

// COMPONENTS
Route::get('/dashboard/components', 'DashboardController@getComponents')->name('dashboard.components');