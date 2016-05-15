<?php

Route::filter('cache', function($route, $request, $response, $age=60){
    $response->setTtl($age);
});

Route::filter('auth', function()
{
    if (!Auth::check())
    {
        if (Request::ajax())
        {
            return Response::json('Su sesion a expirado favor logearse de nuevo', 401);
        }
        else
        {
            return Redirect::to('logIn');
        }
    }
});


Route::filter('csrf', function()
{
	if (Input::has('_token')) {
		if (Session::token() != Input::get('_token'))
		{
			throw new Illuminate\Session\TokenMismatchException;
		}
	}
});


/*************************************************************************
    INICIO DE PERMISOS DE INGRESO A RUTAS CON ROLES
*************************************************************************/
/**Administrador , Propietario  y Usuario**/
Entrust::routeNeedsRole( 'user/*'   ,  array('Owner','Admin','User') , '<script>window.location.reload();</script>', false );

/**Administrador y Propietario**/
Entrust::routeNeedsRole( 'admin/*'     , array('Owner','Admin') , '<script>window.location.reload();</script>', false );

/**Propietario**/
Entrust::routeNeedsRole( 'owner/*' , array('Owner') , '<script>window.location.reload();</script>', false );
/*************************************************************************
    FIN DE PERMISOS DE INGRESO A RUTAS CON ROLES
*************************************************************************/
