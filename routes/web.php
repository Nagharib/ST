<?php

Route::get('/', function () {
    //factory(App\Model\userRole::class)->create();
    return view('index');
})->name('login')->middleware('guest');


/*Route::get('/index', function () {
    //factory(App\Model\userRole::class)->create();
    return view('index');
})->name('index')->middleware('guest');*/

Route::get('/','IndexController@index')->name('index')->middleware('guest');
Route::get('/hotel','IndexController@hotel')->name('hotel')->middleware('guest');

Route::get('/kota/{city?}','IndexController@city')->name('kota')->middleware('guest');
Route::get('/detailHotel/{id?}','IndexController@detailHotel')->name('detail')->middleware('guest');
Route::post('/book1/{id?}','IndexController@bookHotel')->name('book1')->middleware('guest');
Route::post('/book2','IndexController@WA')->name('book2')->middleware('guest');


/*Route::get('/hotel', function () {
    //factory(App\Model\userRole::class)->create();
    return view('hotel');
})->name('hotel')->middleware('guest');
*/

Route::get('/coba', function () {
    //factory(App\Model\userRole::class)->create();
    return view('coba');
})->name('coba')->middleware('guest');

Route::get('/logout',function(){
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('block', function () {
    return view('block');
})->name('block');

Route::get('/home', function () {
    //factory(App\Model\userRole::class)->create();
    $data['title'] = 'Perumahan';
    $data['deskripsi_title'] = 'Sistem Informasi Perumahan';
    return view('backend.dashboard',$data);
})->middleware('auth')->name('home');

Route::post('/ceklogin','Login\loginCtrl@checkLogin')->name('login.check');

//
Route::group(['middleware' => ['auth'],'prefix' => 'admin','namespace' => 'admin'], function () {
    Route::get('/','DashboardCtrl@index')->name('dashboard.index');
  
    
    Route::get('checkin/tamu','CheckinCtrl@listCheckin')->name('checkin.tamu');
    //ARDI//
   /* Route::resource('promo','PromoCtrl');*/
    Route::resource('promo2','ImageController');
    Route::resource('promokota','PromokotaController');
    Route::resource('tambahhotel','HotelCtrl2');
    Route::resource('tambahroom','HotelRoomCtrl2');
  

    Route::resource('hotel','HotelCtrl');
    Route::resource('hotel_room','HotelRoomCtrl');
    Route::resource('employee','EmployeeCtrl');
    Route::resource('block','BlockCtrl');
    Route::resource('unit','UnitCtrl');

    Route::resource('perumahan','UnitCtrl');
    Route::resource('blockp','SelectCtrl');


    // END //
    Route::resource('kamar','KamarCtrl');
    Route::resource('typekamar','TypeKamarCtrl');
    Route::resource('kategorilayanan','layananKategoriCtrl');
    Route::resource('layanan','layananCtrl');
    Route::resource('tamu','tamuCtrl');
    Route::resource('user','userCtrl');
    Route::resource('perusahaan','PerusahaanCtrl');
    Route::resource('checkin','CheckinCtrl');
    Route::resource('transaksilayanan','TransaksiLayananCtrl');
    Route::resource('berita','BeritaCtrl');

    Route::get('checkout','CheckinCtrl@checkout')->name('checkin.checkout');
    Route::get('checkout/print/{id}','CheckinCtrl@checkoutprint')->name('checkin.checkoutprint');
    Route::get('checkout/{id}','CheckinCtrl@checkoutedit')->name('checkin.checkoutedit');



    Route::post('checkout','CheckinCtrl@checkoutsave')->name('checkin.checkoutsave');

/*    Route::post('/images','ImageController@store')->name('api.images');*/

    Route::get('laporan/{type}','LaporanCtrl@laporan')->name('laporan')->middleware('role');
});

    Route::group(['middleware' => 'auth','prefix' => 'api','namespace' => 'admin'], function () {
    Route::get('kamar','KamarCtrl@getKamar')->name('api.kamar');
    Route::get('typekamar','TypeKamarCtrl@getTypeKamar')->name('api.typekamar');
    Route::get('kategorilayanan','layananKategoriCtrl@getLayananKategori')->name('api.layanankategori');
    Route::get('layanan','layananCtrl@getLayanan')->name('api.layanan');

    //ardi///////////////////////////////
    Route::get('perum','PerumCtrl@getLayanan')->name('api.perum');
    Route::get('promo','PromoCtrl@getLayanan')->name('api.promo');
    
    Route::get('promo2','ImageController@index');
    Route::get('/delete/{id_promo_header}','ImageController@destroy')->name('api.delete');
    Route::post('promo2','ImageController@store');

    Route::get('promokota','PromokotaController@index');
    Route::get('/deletekota/{id}','PromokotaController@destroy')->name('api.deletekota');
    
    Route::post('promokota','PromokotaController@store');

    Route::get('tambahhotel','HotelCtrl2@index');
    Route::get('/deleteHotel/{id}','HotelCtrl2@destroy')->name('api.deleteHotel');
    Route::get('/hapusGambar/{gambarid}/{id}','HotelCtrl2@hapusGambar')->name('api.hapusGambar');
    Route::get('/editHotel/{id}','HotelCtrl2@update')->name('api.editHotel');
    Route::post('tambahhotel','HotelCtrl2@store');
    Route::post('editHotel/{id}','HotelCtrl2@updateData');
    
    Route::get('tambahroom','HotelRoomCtrl2@index');
    Route::post('tambahroom','HotelRoomCtrl2@store');
    Route::get('/editRoomHotel/{id}','HotelRoomCtrl2@update')->name('api.editRoomHotel');
    Route::post('/editRoomHotel/{id}','HotelRoomCtrl2@updateData');
    Route::get('/hapusGambarRoom/{gambarid}/{id}','HotelRoomCtrl2@hapusGambar')->name('api.hapusGambarRoom');

    
    Route::get('hotel','HotelCtrl@getLayanan')->name('api.hotel');
    Route::get('hotel_room','HotelRoomCtrl@getLayanan')->name('api.hotel_room');

    Route::get('employee','EmployeeCtrl@getLayanan')->name('api.employee');
     
    /////////////////////////////////////////


    
    Route::get('tamu','tamuCtrl@getTamu')->name('api.tamu');
    Route::get('user','userCtrl@getUser')->name('api.user');
    Route::get('berita','BeritaCtrl@getBerita')->name('api.berita');

    Route::get('getlayanan/{id}','TransaksiLayananCtrl@getLayanan')->name('api.transaksilayanan');
    Route::get('getkamarkotor','TransaksiLayananCtrl@getKamarKotor')->name('api.kamarkotor');

    Route::post('getlaporan/{kamar}','LaporanCtrl@getLaporan')->name('api.laporankamar');
});



    ////////////// ARDI /////////////////////////
    Auth::routes();

    Route::get('/users/confirmation/{token}','RegisterAuthCustom@confirmation')->name('confirmation');
    Route::get('/users/confirm/{email}','RegisterAuthCustom@confirm')->name('confirm');
    Route::get('reg','RegisterAuthCustom@showRegisterForm');
    //Route::get('account/{account_id}','RegisterAuthCustom@showAccountForm')->name('acc');     
    Route::post('regins','RegisterAuthCustom@register');
   Route::post('regAccount','RegAccountCtrl@regAccount');
   Route::post('account/addAccount/{idna}','RegAccountCtrl@AddAccount');
   //Route::post('AddAccount','RegAccountCtrl@AddAccount');
   // Route::get('account/{account_id}','RegAccountCtrl@regAccount')->name('acc');  
    Route::get('account/{id}','RegAccountCtrl@regAccount')->name('acc');  
    //Route::get('account/addAccount/{idna}','RegAccountCtrl@AddAccount');  
    //Route::get('register','RegisterAuthCustom@showRegisterForm');

    /////////////////////////////////////////////
    ///
    ///
    /*
        Route::get('register','RegisterAuthCustom@showRegisterForm');
        Route::get('account','RegisterAuthCustom@showAccountForm');
        Route::get('already','RegisterAuthCustom@already');
    */
        Route::post('regInsert','RegisterAuthCustom@regInsert');
    

        Route::get('/location/perumahan', 'LocationController@perumahan');
        Route::get('/location/block', 'LocationController@block');
        Route::get('/location/userna', 'LocationController@userna');
        Route::get('/location/editblock', 'LocationController@editblock');

        //USER 
         Route::get('/userp/userpilih', 'UserCreatController@userpilih');
         Route::get('/userp/userpilih2', 'UserCreatController@userpilih2');

Auth::routes();


