<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

/*
|--------------------------------------------------------------------------
| Pages
|--------------------------------------------------------------------------
*/

Route::get('/', 'PagesController@landing')->name('landing');

Route::get('/register/buyer','Auth\RegisterController@getBuyer');
Route::post('/register/buyer','Auth\RegisterController@postBuyer');

Route::get('/register/seller','Auth\RegisterController@getSeller');
Route::post('/register/seller','Auth\RegisterController@postSeller');

Route::get('/register/buyer-seller','Auth\RegisterController@getBuyerAndSeller');
Route::post('/register/buyer-seller','Auth\RegisterController@postBuyerAndSeller');
Route::get('/register/check_email_unique','Auth\RegisterController@CheckEmailUnique');
Route::get('/register/check_username_unique','Auth\RegisterController@CheckUsernameUnique');
Route::get('/loadprovince/{id?}','PagesController@LoadProvince');

Route::get('/about-us','PagesController@AboutUs');
Route::get('/contact-us','PagesController@getContactUs');
Route::post('/contact-us','PagesController@postContactUs');
Route::get('/traceability','PagesController@Traceability');
Route::get('/producers','PagesController@getProducers');
Route::get('/single-producer/{id?}','PagesController@getSingleProducers')->name('single-producers');

Route::group(['prefix'=>'buyer','middleware'=>'authmiddleware'],function(){
    Route::get('/dashboard', 'BuyerController@Index')->name('home');
    Route::get('/myaccount', 'BuyerController@getMyAccount')->name('profile');
    Route::post('/myaccount', 'BuyerController@postMyAccount')->name('profile');
    Route::post('/becomeseller','BuyerController@postBecomeSeller')->name('becomeseller');
    Route::post('/logout','Auth\LoginController@logout')->name('logout');

    //request diamond step
    //Route::get('/request-diamond','BuyerController@getRequestDiamond')->name('request-diamond');
    Route::get('/pdiamond-step1/{id?}','BuyerController@getPostDiamondStep1')->name('post-diamond-step-1');
    Route::post('/pdiamond-step1/{id?}','BuyerController@postPostDiamondStep1')->name('post-diamond-step-1');
    Route::get('/pdiamond-step2/{id?}','BuyerController@getPostDiamondStep2')->name('post-diamond-step-2');
    Route::post('/pdiamond-step2/{id?}','BuyerController@postPostDiamondStep2')->name('post-diamond-step-2');
    Route::post('/update-request','BuyerController@postUpdateRequest')->name('update-request');
    // profile -> reset password
    Route::get('/reset-password','BuyerController@getResetPassword')->name('reset-password');

    //My Request
    Route::get('/all-request','BuyerController@getAllRequest')->name('all-request');
    Route::get('/pending-request','BuyerController@getPendingRequest')->name('pending-request');
    Route::get('/published-request','BuyerController@getPublishedRequest')->name('published-request');
    Route::get('/archived-request','BuyerController@getArchivedRequest')->name('archived-request');

    //Ajax Request
    Route::post('/AjaxMyRequest','BuyerController@postGetAjaxMyRequest')->name('ajax-request');

    Route::get('/getDiamondFullDetail/{id?}','BuyerController@getDiamondFullDetail')->name('getDiamondFullDetail');
    Route::get('/getRequestFullDetail/{id?}','BuyerController@getRequestFullDetail')->name('getRequestFullDetail');

    //search-request
    Route::get('/search-diamond','BuyerController@getSearchDiamond')->name('search-Diamond');
    Route::post('/AjaxSearchDiamond','BuyerController@postAjaxSearchDiamond')->name('search-diamond');

    //compare diamonds
    Route::post('/compareDiamond','BuyerController@postCompareDiamond')->name('compareDiamond');

    //Archived Request
    Route::post('/archiverequest','BuyerController@postArchiveRequest')->name('archived-request');
    //Delete Request
    Route::post('/deleterequest','BuyerController@postDeleteRequest')->name('delete-request');

    //edit request
    Route::get('/edit-request/{id?}','BuyerController@getEditRequest')->name('editrequest');

    //download as pdf
    Route::get('/download-as-pdf/{id?}','BuyerController@getDownloadASPdf')->name('download-as-pdf');
});
Route::group(['prefix'=>'seller','middleware'=>'authmiddleware'],function(){
    Route::get('/dashboard', 'SellerController@Index')->name('home');
    Route::get('/myaccount', 'SellerController@getMyAccount')->name('profile');
    Route::post('/myaccount', 'SellerController@postMyAccount')->name('profile');
    Route::post('/becomebuyer','SellerController@postBecomeBuyer')->name('becomebuyer');
    //post diamond step
    Route::get('/post-diamond','SellerController@getPostDiamond')->name('post-diamond');
    Route::get('/pdiamond-step1/{id?}','SellerController@getPostDiamondStep1')->name('post-diamond-step-1');
    Route::post('/pdiamond-step1','SellerController@postPostDiamondStep1')->name('post-diamond-step-1');
    Route::get('/pdiamond-step2/{id?}','SellerController@getPostDiamondStep2')->name('post-diamond-step-2');
    Route::post('/pdiamond-step2/{id?}','SellerController@postPostDiamondStep2')->name('post-diamond-step-2');
    Route::post('/update-diamond','SellerController@postUpdateDiamond')->name('Update-Diamond');

    //delete diamond img
    Route::get('/deleteimg/{id?}','SellerController@getDeleteDiamondImg')->name('deleteimg');
    Route::post('/logout','Auth\LoginController@logout')->name('logout');

    // profile -> reset password
    Route::get('/reset-password','SellerController@getResetPassword')->name('reset-password');

    //My post
    Route::get('/all-post','SellerController@getAllPost')->name('all-post');
    Route::get('/pending-post','SellerController@getPendingPost')->name('pending-post');
    Route::get('/published-post','SellerController@getPublishedPost')->name('published-post');
    Route::get('/archived-post','SellerController@getArchivedPost')->name('archived-post');
    
    //Ajax Request
    Route::post('/AjaxMyPost','SellerController@postGetAjaxMyPost')->name('ajax-request');

    //compare diamonds
    Route::post('/compareDiamond','SellerController@postCompareDiamond')->name('compareDiamond');

    Route::get('/getDiamondFullDetail/{id?}','SellerController@getDiamondFullDetail')->name('getDiamondFullDetail');
    Route::get('/getRequestFullDetail/{id?}','SellerController@getRequestFullDetail')->name('getRequestFullDetail');

    //Csv upload
    Route::get('/upload-csv-1','SellerController@getUploadCSVStep1')->name('step-1');
    Route::post('/upload-csv-1','SellerController@postUploadCSVStep1')->name('upload-csv-1');
    Route::get('/upload-csv-2','SellerController@getUploadCSVStep2')->name('step-2');
    Route::post('/upload-csv-2','SellerController@postUploadDmgImgStep2')->name('upload-csv-2');
    Route::get('/upload-csv-3','SellerController@getUploadCSVStep3')->name('step-3');
    Route::post('/upload-csv-3','SellerController@postUploadDmgPdfStep3')->name('upload-csv-3');

    //search-request
    Route::get('/search-request','SellerController@getSearchRequest')->name('search-request');
    Route::post('/AjaxMyRequest','SellerController@postGetAjaxMyRequest')->name('search-request');

    //Archived Request
    Route::post('/archivediamond','SellerController@postArchiveDiamond')->name('archived-diamond');
    //Delete Request
    Route::post('/deletediamond','SellerController@postDeleteDiamond')->name('delete-diamond');

    //edit post
    Route::get('/editpost/{id?}','SellerController@getEditPost')->name('editpost');

    //download as pdf
    Route::get('/download-as-pdf/{id?}','SellerController@getDownloadASPdf')->name('download-as-pdf');
});

Route::post('/reset-password','HomeController@postResetPassword')->name('reset-password');

Route::get('/home', 'HomeController@index')->name('home');





//*******************Admin Panel************************************************//

Route::get('/admin/login','Admin\AdminController@getAdminLogin');
Route::post('admin/login','Admin\AdminController@postLogin');
Route::get('admin/password/reset','Admin\AdminController@getResetAdminPassword');
Route::post('admin/password/reset','Admin\AdminController@postResetAdminPassword');
Route::group(['prefix'=>'admin','middleware'=>'adminauth'],function(){

    Route::get('/dashboard','Admin\AdminController@getDashboard');
    Route::get('/logout','Admin\AdminController@getLogout');
    Route::get('/AjaxVendorsList','Admin\AdminController@getAjaxVendorsList');

    //users
    Route::get('/seller-users','Admin\AdminController@getSellerUsers');
    Route::get('/AjaxSellersList','Admin\AdminController@getAjaxSellersList');
    Route::get('/users/edit/{id?}','Admin\AdminController@getEditUser');
    Route::post('/users/edit/{id?}','Admin\AdminController@postEditUser');
    Route::post('/changeuserpassword','Admin\AdminController@postResetPassword');

    //vendors
    Route::get('/vendors','Admin\AdminController@getVendors');
    Route::get('/view-diamonds/{id?}','Admin\AdminController@getDiamonds');
    Route::get('/AjaxDiamondsList/{id?}','Admin\AdminController@getAjaxDiamondsList');
    Route::get('/edit-diamond/{id?}','Admin\AdminController@getEditDiamond');
    Route::post('/edit-diamond/{id?}','Admin\AdminController@postEditDiamond');
    //delete diamond img
    Route::get('/deleteimg/{id?}','Admin\AdminController@getDeleteDiamondImg')->name('deleteimg');
    Route::post('deleteDiamond','Admin\AdminController@postDeleteDiamond');

    Route::get('/buyer-users','Admin\AdminController@getBuyersUsers');
    Route::get('/AjaxBuyersList','Admin\AdminController@getAjaxBuyersList');

    Route::get('/profile','Admin\AdminController@getAdminProfile');
    Route::post('/profile','Admin\AdminController@postAdminProfile');

    //landing pages
    /*Route::get('content/public-home','Admin\AdminController@getPublicHomeContent');
    Route::post('content/public-home','Admin\AdminController@postPublicHomeContent');

    Route::get('content/trading-home','Admin\AdminController@getPublicTradingContent');*/
    Route::post('images/pages_img','Admin\AdminController@UploadContentImage');

    Route::get('content/about-us','Admin\AdminController@getAboutUsContent');
    Route::post('content/about-us','Admin\AdminController@postAboutUsContent');

    Route::get('content/traceability','Admin\AdminController@getTraceability');
    Route::post('content/traceability','Admin\AdminController@postTraceability');

    Route::get('content/producer','Admin\AdminController@getProducer');
    Route::post('content/producer','Admin\AdminController@postProducer');

    Route::get('producer/deleteimg/{id?}','Admin\AdminController@getDeleteProducerImg')->name('deleteimg');
    Route::get('producer/deletepdf/{id?}','Admin\AdminController@getDeleteProducerPdf')->name('deletepdf');

    Route::get('content/deleteProducer/{id?}','Admin\AdminController@getDeleteProducer');
});

