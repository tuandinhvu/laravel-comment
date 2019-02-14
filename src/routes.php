<?php
/**
 * Created by PhpStorm.
 * User: tuan3
 * Date: 2/12/2019
 * Time: 12:30 AM
 */
Route::group(['middleware'=>'web'], function(){
    Route::post('comment/create', 'Fastup\Comment\Controllers\CommentController@create')->name('sendComment');
    Route::post('comment/edit', 'Fastup\Comment\Controllers\CommentController@create');
    Route::post('comment/delete', 'Fastup\Comment\Controllers\CommentController@create');
});

