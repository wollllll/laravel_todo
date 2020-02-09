<?php

//===ここから削除（トップページをリスト一覧画面にするため。未ログイン時はログイン画面に遷移します）===
Route::get('/', function () {
    return view('welcome');
});
//===ここまで削除===

//===ここから追加===
//リスト一覧画面
Route::get('/','ListingsController@index');

//リスト新規画面
Route::get('/new', 'ListingsController@new')->name('new');

//リスト新規処理
Route::post('/listings','ListingsController@store');

//リスト更新画面
Route::get('/listingsedit/{listing_id}', 'ListingsController@edit');

//リスト更新処理
Route::post('/listing/edit','ListingsController@update');

//リスト削除処理
Route::get('/listingsdelete/{listing_id}', 'ListingsController@destroy');
//===ここまで追加===

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('listing/{listing_id}/card/new', 'CardsController@new')->name('new_card');
Route::post('/listing/{listing_id}/card', 'CardsController@store');
Route::get('listing/{listing_id}/card/{card_id}', 'CardsController@show');
Route::get('listing/{listing_id}/card/{card_id}/edit', 'CardsController@edit');
Route::post('/card/edit', 'CardsController@update');
Route::get('listing/{listing_id}/card/{card_id}/delete', 'CardsController@destroy');
