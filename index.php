<?php 

// GET /posts - PostController@index - Display a list of posts
// GET /posts/create - PostController@create - Display the create form
// POST /posts - PostController@store - Store a new post
// GET /posts/{post} - PostController@show - Display a specific post
// GET /posts/{post}/edit - PostController@edit - Display the edit form for a specific post
// PUT /posts/{post} - PostController@update - Update a specific post (PUT method)
// PATCH /posts/{post} - PostController@update - Update a specific post (PATCH method)
// DELETE /posts/{post} - PostController@destroy - Delete a specific post


// Üstteki tüm işlemleri yapman için gereken Route sadece resource Routesi


Route::resource('posts', 'PostController');


// bunu yazdıktan sonra resourcefull bir controller ile tüm işlemleri buradan yapabilirsin


//resourcelardan başka custom routeların varsa resourcenin üstüne koy
Route::resource('posts', 'PostController')->only(['index', 'create', 'update']); // sadece bu methodları çalıştır
Route::resource('posts', 'PostController')->except(['index', 'create', 'update']); // bu methodlar hariç çalıştır




Route::apiResource('posts', 'PostController'); //api için


Route::group(['middleware' => 'auth'], function () {  //auth olmadan girilemeyen routeları grupladık


        Route::resource('tasks', 'PostController');

            Route::group(['middleware' => 'admin'], function () {  //iç içe middleware kurma (auth olduğu kontrol ettikten sonra admin olup olmadığını kontrol ediyor

            Route::resource('users', 'PostController');

            });
});



Route::group(['middleware' => 'auth'], function () {

    
    Route::group(['middleware' => 'user', 'prefix' => 'user', 'namespace' => 'User', 'as' => 'user.'], function () {

        // user/tasks  user/tasks/create  (auth protected) - User\TaskController (namespace ile Controllers dosyasının içine oluşturduğun yeni dosyayı namespace ile atayabilirsin )
        // <a href="{{ route('user.tasks.index') }}"           href böyle olmalı
        Route::resource('tasks', 'TaskController');

        // user/projects  user/projects/create (auth protected) - User\TaskController
        // <a href="{{ route('user.projects.index') }}"           href böyle olmalı
        Route::resource('projects', 'ProjectController');


    });


    
    
    Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {

        // admin/users  admin/users/create    (auth protected) - Admin\TaskController 
        // <a href="{{ route('admin.tasks.index') }}"           href böyle olmalı
        Route::resource('users', 'UserController');

    });


});
?>
