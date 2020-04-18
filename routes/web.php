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

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/', 'HomeController@index');

Route::get('/home', 'MenuController@index')->name('home');
Route::get('/','MenuController@index');

Route::get('/admin', function(){
    return 'you are admin';
})->middleware(['auth', 'auth.admin']);




Route::namespace('Admin')->prefix('admin')->middleware(['auth', 'auth.admin'])->name('admin.')->group(function(){
    Route::resource('/users', 'UserController');
    Route::get('/users/profile/{id}', 'UserController@edit')->name('users.profile');
    Route::get('/users/password/{id}', 'UserController@edit')->name('users.password');
    Route::resource('/changepswd', 'ChangeUserPswdController');

});

Route::get('/changepassword/{id}', 'changepasswordController@index')->name('changepassword.index');
Route::put('/changepassword/{id}', 'changepasswordController@update')->name('changepassword.update');

Route::prefix('master')->name('master.')->group(function(){

    
    Route::resource('species', 'SpeciesController');
    Route::resource('specification', 'SpecificationController');

    // ---KBM---
    // Route::resource('kbm', 'KbmController');
    Route::get('/kbm', 'KbmController@index')->name('kbm.index');
    Route::get('/kbm/{id}/edit', 'KbmController@edit')->name('kbm.edit');
    Route::put('/kbm/update/{id}', 'KbmController@update')->name('kbm.update');
    Route::post('/kbm/store','KbmController@store')->name('kbm.store');
    Route::get('/kbm/create', 'KbmController@create')->name('kbm.create');
    Route::delete('/kbm/destroy/{id}', 'KbmController@destroy')->name('kbm.destroy');

    //---KPH---
    Route::get('/kph', 'KphController@index')->name('kph.index');
    Route::get('/kph/{id}/edit', 'KphController@edit')->name('kph.edit');
    Route::put('/kph/update/{id}', 'KphController@update')->name('kph.update');
    Route::post('/kph/store','KphController@store')->name('kph.store');
    Route::get('/kph/create', 'KphController@create')->name('kph.create');
    Route::delete('/kph/destroy/{id}', 'KphController@destroy')->name('kph.destroy');
    Route::get('/kph/show', 'KphController@show')->name('kph.show');

    // --TPK--
    Route::get('/tpk', 'TPKController@index')->name('tpk.index');
    Route::get('/tpk/{id}/edit', 'TPKController@edit')->name('tpk.edit');
    Route::put('/tpk/update/{id}', 'TPKController@update')->name('tpk.update');
    Route::post('/tpk/store','TPKController@store')->name('tpk.store');
    Route::get('/tpk/create', 'TPKController@create')->name('tpk.create');
    Route::delete('/tpk/destroy/{id}', 'TPKController@destroy')->name('tpk.destroy');
    
	// --KPH Type--
    Route::get('/kphtype', 'KphTypeController@index')->name('kphtype.index');
    Route::get('/kphtype/{id}/edit', 'KphTypeController@edit')->name('kphtype.edit');
    Route::put('/kphtype/update/{id}', 'KphTypeController@update')->name('kphtype.update');
    Route::post('/kphtype/store','KphTypeController@store')->name('kphtype.store');
    Route::get('/kphtype/create', 'KphTypeController@create')->name('kphtype.create');
    Route::delete('/kphtype/destroy/{id}', 'KphTypeController@destroy')->name('kphtype.destroy');

    //---GroupVendor---
    Route::get('/groupvendor', 'GroupVendorController@index')->name('groupvendor.index');
    Route::get('/groupvendor/{id}/edit', 'GroupVendorController@edit')->name('groupvendor.edit');
    Route::put('/groupvendor/update/{id}', 'GroupVendorController@update')->name('groupvendor.update');
    Route::post('/groupvendor/store','GroupVendorController@store')->name('groupvendor.store');
    Route::get('/groupvendor/create', 'GroupVendorController@create')->name('groupvendor.create');
    Route::delete('/groupvendor/destroy/{id}', 'GroupVendorController@destroy')->name('groupvendor.destroy');
    // Route::get('/groupvendor/show', 'GroupVendorController@show')->name('groupvendor.show');

    // ---Vendor---
    Route::get('/vendor', 'VendorController@index')->name('vendor.index');
    Route::get('/vendor/{id}/edit', 'VendorController@edit')->name('vendor.edit');
    Route::put('/vendor/update/{id}', 'VendorController@update')->name('vendor.update');
    Route::post('/vendor/store','VendorController@store')->name('vendor.store');
    Route::get('/vendor/create', 'VendorController@create')->name('vendor.create');
    Route::delete('/vendor/destroy/{id}', 'VendorController@destroy')->name('vendor.destroy');
    Route::get('/vendor/getcity/{id}', 'VendorController@getcity');

    //grader
    Route::get('/grader', 'GraderSkillController@show')->name('grader');
    Route::post('/grader/store','GraderSkillController@store')->name('grader.store');
    Route::get('/grader/show', 'GraderSkillController@show')->name('grader.show');
    Route::get('/grader/create', 'GraderSkillController@create')->name('grader.create');
    Route::get('/grader/{id}/edit', 'GraderSkillController@edit')->name('grader.edit');
    Route::put('/grader/update/{id}', 'GraderSkillController@update')->name('grader.update');
    Route::delete('/grader/destroy/{id}', 'GraderSkillController@destroy')->name('grader.destroy');

    // --Item Group--
    Route::get('/itemgroup', 'ItemGroupController@index')->name('itemgroup.index');
    Route::get('/itemgroup/{id}/edit', 'ItemGroupController@edit')->name('itemgroup.edit');
    Route::put('/itemgroup/update/{id}', 'ItemGroupController@update')->name('itemgroup.update');
    Route::post('/itemgroup/store','ItemGroupController@store')->name('itemgroup.store');
    Route::get('/itemgroup/create', 'ItemGroupController@create')->name('itemgroup.create');
    Route::delete('/itemgroup/destroy/{id}', 'ItemGroupController@destroy')->name('itemgroup.destroy');

    //BANK
    Route::get('/bank', 'BankController@index')->name('bank.index');
    Route::get('/bank/edit/{id}', 'BankController@edit')->name('bank.edit');
    Route::post('/bank/update/{id}', 'BankController@update')->name('bank.update');
    Route::post('/bank/store', 'BankController@store')->name('bank.store');
    Route::delete('/bank/destroy/{id}', 'BankController@destroy')->name('bank.destroy');

    //BANK ACCOUNT
    Route::get('/bank/account', 'BankController@indexaccount')->name('account.index');
    Route::get('/bank/account/edit/{id}', 'BankController@editaccount')->name('account.edit');
    Route::post('/bank/account/update/{id}', 'BankController@updateaccount')->name('account.update');
    Route::post('/bank/account/store', 'BankController@saveaccount')->name('account.store');
    Route::delete('/bank/account/destroy/{id}', 'BankController@destroyaccount')->name('account.destroy');

    //QUALITY
    Route::get('/quality', 'QualityController@index')->name('quality.index');
    Route::get('/quality/{id}/edit', 'QualityController@edit')->name('quality.edit');
    Route::put('/quality/update/{id}', 'QualityController@update')->name('quality.update');
    Route::post('/quality/store','QualityController@store')->name('quality.store');
    Route::get('/quality/create', 'QualityController@create')->name('quality.create');
    Route::delete('/quality/destroy/{id}', 'QualityController@destroy')->name('quality.destroy');

    // --measurement--
    Route::get('/measurement', 'MeasurementController@index')->name('measurement.index');
    Route::get('/measurement/{id}/edit', 'MeasurementController@edit')->name('measurement.edit');
    Route::put('/measurement/update/{id}', 'MeasurementController@update')->name('measurement.update');
    Route::post('/measurement/store','MeasurementController@store')->name('measurement.store');
    Route::get('/measurement/create', 'MeasurementController@create')->name('measurement.create');
    Route::delete('/measurement/destroy/{id}', 'MeasurementController@destroy')->name('measurement.destroy');

    // --Objective--
    Route::get('/objective', 'objectivecontroller@index')->name('objective.index');
    Route::get('/objective/{id}/edit', 'objectivecontroller@edit')->name('objective.edit');
    Route::put('/objective/update/{id}', 'objectivecontroller@update')->name('objective.update');
    route::post('/objective/store','objectivecontroller@store')->name('objective.store');
    Route::get('/objective/create', 'objectivecontroller@create')->name('objective.create');
    Route::delete('/objective/destroy/{id}', 'objectivecontroller@destroy')->name('objective.destroy');
	
	// --Owner--
    Route::get('/owner', 'OwnerController@index')->name('owner.index');
    Route::get('/owner/{id}/edit', 'OwnerController@edit')->name('owner.edit');
    Route::put('/owner/update/{id}', 'OwnerController@update')->name('owner.update');
    Route::post('/owner/store','OwnerController@store')->name('owner.store');
    Route::get('/owner/create', 'OwnerController@create')->name('owner.create');
    Route::delete('/owner/destroy/{id}', 'OwnerController@destroy')->name('owner.destroy');


    //Inventory Item
    // Route::get('/inventoryitem', 'InventoryItemController@index')->name('index');
    Route::get('/inventoryitem', 'InventoryItemController@index')->name('index');
    Route::get('/inventoryitem/specification', 'InventoryItemController@index')->name('index');
    Route::post('/inventoryitem/store', 'InventoryItemController@index')->name('inventoryitem.store');

    //warehouse
    Route::resource('warehouse', 'WarehouseController');

    //HJD
    Route::get('/hjd', 'HJDcontroller@index')->name('hjd');
});



Route::get('admin/users/generatePDF/{id}', 'Admin\UserController@generatePDF')->name('generatePDF');
Route::get('admin/PDF', 'Admin\UserController@PDF')->name('PDF');


Route::post('/users/sendemail/send', 'CrudController@send');



Route::prefix('ipl')->name('ipl.')->group(function ()
{    
    // Route::get('/create/{id}', 'Requirements\StoryController@create')->name('stories.create');
    // Route::get('/', 'IplController@getCodeIPL')->name('ipl');
    Route::get('/', 'IplController@show')->name('ipl');
    Route::get('/getCodeIPL', 'IplController@getCodeIPL')->name('getCodeIPL');
    Route::post('/store', 'IplController@store')->name('store');
    Route::get('/show', 'IplController@show')->name('show');
    Route::get('/create', 'IplController@getCodeIPL')->name('create');
    Route::get('/{id}/edit', 'IplController@edit')->name('edit');
    Route::put('/update/{id}', 'IplController@update')->name('update');
    Route::delete('/destroy/{id}', 'IplController@destroy')->name('destroy');
    Route::get('/send/{id}', 'IplController@send')->name('send');
    Route::get('/approved/{id}', 'IplController@approve')->name('approve');
    Route::get('/rejected/{id}', 'IplController@reject')->name('reject');
    Route::get('/revision/{id}', 'IplController@revise')->name('revise');
});

Route::prefix('sendgrader')->name('sendgrader.')->group(function ()
{
    Route::get('/', 'SendGraderController@show')->name('sendgrader');
    Route::post('/store', 'SendGraderController@store')->name('store');
    Route::get('/ipl/{id}', 'SendGraderController@showgrader')->name('input_showgrader');
    Route::get('/graders/{id}', 'SendGraderController@showgrader')->name('show');
    Route::get('/edit/{id}', 'SendGraderController@edit')->name('edit');
    Route::put('/update/{id}', 'SendGraderController@update')->name('update');
    Route::delete('/destroy/{id}', 'SendGraderController@destroy')->name('destroy');
    Route::get('/getKBM/{id}', 'SendGraderController@getKBM')->name('getKBM');
    Route::get('/getKPH/{id}', 'SendGraderController@getKPH')->name('getKPH');
    Route::get('/getTPK/{id}', 'SendGraderController@getTPK')->name('getTPK');
});

//SURAT PERINTAH TUGAS GRADER
Route::prefix('spgrader')->name('spgrader.')->group(function ()
{
    Route::get('/', 'SPgraderController@show')->name('spgrader');
    Route::post('/store/{id}', 'SPgraderController@store')->name('store');
    Route::get('/pdf/{id}', 'SPgraderController@PDF')->name('pdf');
    Route::get('/shownoipl', 'SPgraderController@shownoipl')->name('shownoipl');
});

//GRADING RESULT
Route::prefix('gradingresult')->name('gradingresult.')->group(function ()
{
    Route::get('/', 'GradingResultController@create')->name('grading');
    Route::get('/getdata/{id}', 'GradingResultController@getdata')->name('getdatasendgrader');
    Route::post('/store', 'GradingResultController@store')->name('store');
    Route::get('/create', 'GradingResultController@create')->name('create');
    Route::get('/edit/{id}', 'GradingResultController@edit')->name('edit');
    Route::post('/update/{id}', 'GradingResultController@update')->name('update');
    Route::delete('/destroy/{id}', 'GradingResultController@destroy')->name('destroy');
    
    Route::get('/pdf/{id}', 'GradingResultController@pdf')->name('pdf');

    // acc
    Route::get('/acc', 'GradingResultController@acc')->name('acc');
    Route::get('/approved/{id}', 'GradingResultController@approve')->name('approve');
    Route::get('/rejected/{id}', 'GradingResultController@reject')->name('reject');
    Route::get('/revision/{id}', 'GradingResultController@revise')->name('revise');
    Route::get('/send/{id}', 'GradingResultController@send')->name('send');

    Route::post('/choose', 'GradingResultController@selectprint')->name('choose');
});


//PURCHASE ORDER RAW MATERIAL-PRM
Route::prefix('po')->name('po.')->group(function ()
{
    Route::get('/', 'PurchaseOrderRMcontroller@create')->name('create');
    Route::get('/detail', 'PurchaseOrderRMcontroller@create')->name('create');
    Route::get('/condition', 'PurchaseOrderRMcontroller@create')->name('create');

    Route::get('/get/{id}', 'PurchaseOrderRMcontroller@get');
    Route::get('/getaccount/{id}', 'PurchaseOrderRMcontroller@getaccount');
    Route::get('/getpo/{id}', 'PurchaseOrderRMcontroller@getpo')->name('getpo');
    Route::post('/store', 'PurchaseOrderRMcontroller@storeGeneral')->name('store');
    Route::post('/storedetail', 'PurchaseOrderRMcontroller@storeDetail')->name('storedetail');
    Route::post('/storecondition', 'PurchaseOrderRMcontroller@storeCondition')->name('storecondition');
    
    Route::get('/edit/{id}', 'PurchaseOrderRMcontroller@editGeneral')->name('edit');
    Route::post('/update/{id}', 'PurchaseOrderRMcontroller@updateGeneral')->name('update');

    Route::get('/edit_detail/{id}', 'PurchaseOrderRMcontroller@editDetail')->name('editDetail');
    Route::post('/updatedetail/{id}', 'PurchaseOrderRMcontroller@updateDetail')->name('updatedetail');

    Route::get('/edit_condition/{id}', 'PurchaseOrderRMcontroller@editCondition')->name('editCondition');
    Route::post('/updatecondition/{id}', 'PurchaseOrderRMcontroller@updateCondition')->name('updatecondition');

    Route::get('/deleteGeneral/{id}', 'PurchaseOrderRMcontroller@deleteGeneral');
    Route::get('/deleteDetail/{id}', 'PurchaseOrderRMcontroller@deleteDetail');
    Route::get('/deleteCondition/{id}', 'PurchaseOrderRMcontroller@deleteCondition');

    Route::get('/show', 'PurchaseOrderRMcontroller@show')->name('show');
    Route::get('/getbeneficiary/{id}', 'PurchaseOrderRMcontroller@getbeneficiary');
    Route::get('/getKBM/{id}', 'PurchaseOrderRMcontroller@getKBM');
    Route::get('/selectipl/{id}', 'PurchaseOrderRMcontroller@selectipl');
});

//PIM PRM - PLANNING PRM
Route::prefix('PIM')->name('pim.')->group(function ()
{
    Route::get('/', 'PIMcontroller@create')->name('create');
    Route::get('/get/{id}', 'PIMcontroller@get')->name('get');
    Route::get('/get_certificate/{id}', 'PIMcontroller@get_certificate');
    
    Route::get('/getKBM/{id}', 'PIMcontroller@getKBM');

    Route::post('/store', 'PIMcontroller@store')->name('store');
    Route::get('/delete/{id}', 'PIMcontroller@delete');
    Route::get('/edit/{id}', 'PIMcontroller@edit')->name('edit');
    Route::post('/update/{id}', 'PIMcontroller@update')->name('update');

    Route::get('/report/{id}', 'PIMcontroller@report')->name('report');

    // Route::get('/getpim', 'PIMcontroller@getpim')->name('getpim');
    
});

//JOB ORDER
Route::prefix('JO')->name('jo.')->group(function ()
{
    Route::get('/', 'JOcontroller@create')->name('create');
    Route::post('/store', 'JOcontroller@store')->name('store');
    // Route::post('/save', 'JOcontroller@save')->name('save');
    Route::get('/selectpim/{id}', 'JOcontroller@selectpim')->name('selectpim');
    Route::get('/edit/{id}', 'JOcontroller@edit')->name('edit');
    Route::post('/update/{id}', 'JOcontroller@update')->name('update');
    Route::get('/delete/{id}', 'JOcontroller@delete')->name('delete');
    Route::get('/report/{id}', 'JOcontroller@report')->name('report');
});

// TT - Tanda Terima
Route::prefix('TT')->name('tt.')->group(function ()
{
    Route::get('/', 'TTcontroller@create')->name('create');
    Route::post('/store', 'TTcontroller@store')->name('store');
    Route::post('/storebarcode', 'TTcontroller@storebarcode')->name('storebarcode');
    Route::get('/selectpim/{id}', 'TTcontroller@selectpim')->name('selectpim');
    Route::get('/getdistrict/{id}', 'TTcontroller@getdistrict');
    Route::get('/getvillage/{id}', 'TTcontroller@getvillage');
    Route::get('/edit/{id}', 'TTcontroller@edit')->name('edit');
    Route::post('/update/{id}', 'TTcontroller@update')->name('update');
    Route::get('/delete/{id}', 'TTcontroller@delete')->name('delete');
});

//Penerimaan Daftar Kapling - 14
Route::prefix('receipt')->name('receipt.')->group(function ()
{
    Route::get('/general', 'ReceiptController@create')->name('create');
    Route::get('/info', 'ReceiptController@create')->name('create');
    Route::get('/vendor', 'ReceiptController@create')->name('create');
    Route::get('/graderout', 'ReceiptController@create')->name('create');
    Route::get('/graderin', 'ReceiptController@create')->name('create');
    Route::get('/document', 'ReceiptController@create')->name('create');
    Route::get('/external', 'ReceiptController@create')->name('create');
    Route::get('/invoicing', 'ReceiptController@create')->name('create');


    Route::get('/', 'ReceiptController@create')->name('create');
    // Route::get('/selecttt/{id}', 'ReceiptController@selecttt');
    Route::get('/selectpim/{id}', 'ReceiptController@selectpim');
    Route::get('/select_receiptlog/{id}', 'ReceiptController@select_receiptlog');
    Route::get('/viewGeneral/{id}', 'ReceiptController@viewGeneral');
    Route::get('/generate_pricing/{id}', 'ReceiptController@generate_pricing');
    Route::get('/generate_invoicing/{id}', 'ReceiptController@generate_invoicing');
    Route::get('/export_vendorreceipt/{id}', 'ReceiptController@export_vendorreceipt');
    Route::post('/import', 'ReceiptController@import')->name('import');

    Route::get('/export_graderoutreceipt/{id}', 'ReceiptController@export_graderoutreceipt');
    Route::post('/importgraderout', 'ReceiptController@importgraderout')->name('importgraderout');

    Route::get('/export_graderinreceipt/{id}', 'ReceiptController@export_graderinreceipt');
    Route::post('/importgraderin', 'ReceiptController@importgraderin')->name('importgraderin');

    Route::get('/export_documentreceipt/{id}', 'ReceiptController@export_documentreceipt');
    Route::post('/importdocument', 'ReceiptController@import_documentreceipt')->name('importdocument');

    Route::post('/store', 'ReceiptController@store')->name('store');
    Route::post('/storeinformation', 'ReceiptController@storeinformation')->name('storeinformation');
    Route::post('/storegraderin', 'ReceiptController@storegraderin')->name('storegraderin');
    Route::post('/storegraderout', 'ReceiptController@storegraderout')->name('storegraderout');
    Route::get('/grader/{id}', 'ReceiptController@deletegrader');
    Route::get('/editgeneral/{id}', 'ReceiptController@editgeneral')->name('editgeneral');
    Route::post('/updategeneral/{id}', 'ReceiptController@updategeneral')->name('updategeneral');
    Route::get('/generate_itemcode/{id}', 'ReceiptController@generate_itemcode')->name('generate_itemcode');
    
    Route::get('/view_external', 'ReceiptController@view_external')->name('view_external');

    Route::get('/report_invoicing/{id}', 'ReceiptController@report_invoicing')->name('report_invoicing');
    Route::get('/report_external/{id}', 'ReceiptController@report_external')->name('report_external');
   
});

//invoice
Route::prefix('invoice')->name('invoice.')->group(function ()
{
    Route::get('/', 'SupplierInvoicePaymentController@create')->name('create');
    Route::get('/store', 'SupplierInvoicePaymentController@store')->name('store');
    Route::get('/selectpo/{id}', 'SupplierInvoicePaymentController@selectpo');
});


Route::get('/page-content', 'ITDeptController@index');

Route::get('/karyawans', 'CrudController@index')->name('karyawans')->middleware(['auth', 'auth.admin']);

// Route::resource('karyawans', 'CrudController')->name('karyawans')->middleware(['auth', 'auth.admin']);



