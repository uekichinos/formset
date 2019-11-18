<?php

Route::group(['namespace' => 'khyrie\Formset\Http\Controllers', 'middleware' => ['web']], function () {
    Route::get('formset', 'FormsetController@index');
    Route::get('formset/create', 'FormsetController@create');
    Route::post('formset/store', 'FormsetController@store');
    Route::get('formset/edit/{formsetid}', 'FormsetController@edit');
    Route::post('formset/update/{formsetid}', 'FormsetController@update');
    Route::get('formset/show/{formsetid}', 'FormsetController@show');
    Route::get('formset/delete/{formsetid}', 'FormsetController@delete');

    Route::get('formset/{formsetid}/fieldset/create', 'FormsetController@fieldset_create');
    Route::post('formset/{formsetid}/fieldset/store', 'FormsetController@fieldset_store');
    Route::get('formset/{formsetid}/fieldset/edit/{fieldsetid}', 'FormsetController@fieldset_edit');
    Route::post('formset/{formsetid}/fieldset/update/{fieldsetid}', 'FormsetController@fieldset_update');
    Route::get('formset/{formsetid}/fieldset/delete/{fieldsetid}', 'FormsetController@fieldset_delete');

    Route::post('formset/gentable/{formsetid}', 'FormsetController@gentable');
    Route::post('formset/genmigration/{formsetid}', 'FormsetController@genmigration');
});
