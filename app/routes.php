<?php
    /*******************************************************************************/
    Route::when('*', 'csrf', array('post', 'put', 'delete'));
    Route::when('user/*' , 'auth');
    Route::when('admin/*', 'auth');
    Route::when('owner/*', 'auth');

    /******************************************************************************
    rutas para evitar los errores de las imagenes no encontradas
    ******************************************************************************/
    Route::get('img/avatar/50/{img}.png', function(){ return "";});
    Route::get('images/{img}.png', function(){ return "";});
    Route::get('/{img}.ico', function(){ return "";});
    Route::get('assets/global/img/loader/general/{img}.gif', function(){ return "";});
    /******************************************************************************/


    Route::get('/'     , 'HomeController@index');
    Route::get('logIn' , 'HomeController@login');
    Route::post('logIn', 'HomeController@validate_phone');
    Route::get('logout', 'HomeController@logout');
    Route::post('index', 'HomeController@validate');


    Route::group(array('prefix' => 'user'), function()
    {

        Route::group(array('prefix' => 'tema'), function()
        {
            Route::get('colorSchemes/{color}'         , 'TemaController@colorSchemes' );
            Route::get('navbarColor/{color}'          , 'TemaController@navbarColor'  );
            Route::get('sidebarColor/{color}'         , 'TemaController@sidebarColor' );
            Route::get('sidebarTypeSetting/{tipo}'    , 'TemaController@sidebarTypeSetting' );
        });

        Route::get('profile'                   , 'UserController@edit_profile');
        Route::post('new'                      , 'UserController@create_new'  );
        Route::post('profile'                  , 'UserController@edit_profile');
    });

    Route::group(array('prefix' => 'admin'), function()
    {
        Route::get('users/buscar', 'UserController@buscar');
    });

    Route::group(array('prefix' => 'owner'), function()
    {
        Route::get('users', 'UserController@index');

        Route::group(array('prefix' => 'user'), function()
        {
            Route::get('create'      , 'UserController@create');
            Route::post('create'     , 'UserController@create');
            Route::post('edit'       , 'UserController@edit'  );
            Route::post('delete'     , 'UserController@delete');
            Route::post('remove_role', 'UserController@remove_role');
            Route::post('add_role'   , 'UserController@add_role'   );
            Route::get('roles'       , 'RolesController@index' );
            Route::get('roles/search', 'RolesController@search');
            Route::post('roles/edit' , 'RolesController@edit'  );
            Route::get('users'       , 'UserController@users'  );
        });

    });

    Route::get('/test', function()
    {
    });

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
