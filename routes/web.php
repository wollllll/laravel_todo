<?php

Auth::routes();
Route::get('/','ListingsController@index')->name('listing.index');
Route::get('listing/create', 'ListingsController@create')->name('listing.create');
Route::post('listing/store','ListingsController@store')->name('listing.store');
Route::get('/listing/{listing}/edit', 'ListingsController@edit')->name('listing.edit');
Route::patch('/listing/{listing}/update','ListingsController@update')->name('listing.update');
Route::get('/listing/{listing}/delete', 'ListingsController@destroy')->name('listing.delete');

Route::get('listing/{listing}/card/create', 'CardsController@create')->name('listing.card.create');
Route::post('/listing/{listing}/card/store', 'CardsController@store')->name('listing.card.store');
Route::get('listing/{listing}/card/{card}/show', 'CardsController@show')->name('listing.card.show');
Route::get('listing/{listing}/card/{card}/edit', 'CardsController@edit')->name('listing.card.edit');
Route::patch('/listing/{listing}/card/{card}/update', 'CardsController@update')->name('listing.card.update');
Route::get('listing/{listing}/card/{card}/delete', 'CardsController@destroy')->name('listing.card.delete');
