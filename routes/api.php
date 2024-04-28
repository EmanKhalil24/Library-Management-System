<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


Route::group(['middleware' => 'api', 'namespace' => 'App\Http\Controllers'], function(){
    // Book Management endpoints
    Route::post('/addBooks', 'BookController@store');
    Route::get('/book/{book_id}', 'BookController@showBookDetails');
    Route::get('/Allbooks', 'BookController@showBooks');
    Route::put('/UpdateBook/{post_id}', 'BookController@updateBook');
    Route::delete('/deleteBook/{post_id}', 'BookController@deleteBook');

    // Patron Management endpoints
    Route::post('/addPatron', 'PatronController@addPatron');
    Route::get('/patron/{patron_id}', 'PatronController@showPatronDetails');
    Route::get('/Allpatrons', 'PatronController@showPatrons');
    Route::put('/UpdatePatron/{patron_id}', 'PatronController@updatePatron');
    Route::delete('/deletePatron/{post_id}', 'PatronController@deletePatron');

    Route::post('/borrow/{book_id}/patron/{patron_id}', 'PatronController@borrowBook');
    Route::put('/return/{book_id}', 'PatronController@returnBook');
});
