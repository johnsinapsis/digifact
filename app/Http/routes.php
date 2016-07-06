<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('home');
});*/

//Route::get('home', ['as' => 'home', 'uses' => 'HomeController@index']);


/************Validaciones y funciones que estan pendientes para tener en cuenta******

-------1) Falta validar que no se puede facturar más cuando se llegue al último consecutivo
-------2) cuando falten los números de consecutivos que se configuraron debe avisar con un mensaje
----------este mensaje puede ser un warning que se puede enviar en un cuadro cuando se hace el llamado
----------a la liquidación
-------3) Falta realizar pruebas cuando el número de servicios supera la hoja de la factura
-------4) Cambiar el correo por un login normal
-------5) Logotipo al iniciar sesión
-------6) Si la factura está anulada, al imprimirla en pdf debe existir una marca de agua que diga anulada
-------7) Activar el menú de la izquierda para que tengan el menú a la mano de los item autorizados
-------8) Construir la caja de administración de permisos
-------9) Cambiar los íconos de los formularios


*/


Route::get('/',[
	'uses' => 'MainController@menu',
	'as' => 'main'
	 
	]); 


Route::group(['middleware' => ['auth','role:1']], function () {

	Route::get('resol',[
		'uses' => 'ResulController@create',
		'as' => 'resol'
	 
	]); 

	Route::post('resol',[
		'uses' => 'ResulController@store',
		'as' => 'resol'
	 
	]);           

	Route::get('resol/{id}',[
		'uses' => 'ResulController@show',
		'as' => 'showresol'
	]);   

	Route::get('resoledit/{id}',[
		'uses' => 'ResulController@edit',
		'as' => 'editresol'
	]);   

	Route::post('resoledit/{id}',[
		'uses' => 'ResulController@update',
		'as' => 'upresol'
	]);   

});

Route::group(['middleware' => ['auth','role:2']], function () {

	Route::get('resoliq',[
		'uses' => 'FactController@selectResol',
		'as' => 'resoliq'
	 
	]);

	Route::post('resoliq',[
		'uses' => 'FactController@index',
		'as' => 'resoliq'
	 
	]);


	Route::get('liq',[
		'uses' => 'FactController@index',
		'as' => 'liq'
	 
	]); 

	Route::post('liq',[
		'uses' => 'FactController@index',
		'as' => 'liq'
	 
	]); 

	
	//Route::get('liq/autocomplete', 'EntityController@query');
	 
	 Route::any('liq/autocomplete', function(){  
	 	// $term = "med";
	 	$term = Input::get('term');
	 	$data = DB::table('entidades')->select('COD_ENT','NOM_ENT')->where('NOM_ENT','LIKE',$term.'%')->get();
	 	//$result[0] = array('value' => 'Medicadiz', 'id' => '2');
	 	foreach ($data as $v) {
	 		$result[] =  array('value' => $v->NOM_ENT, 'id' => $v->COD_ENT);
	 	}
	 	return Response::json($result);
	 });

	 Route::any('price/autocomplete5', function(){  
	 	// $term = "med";
	 	$term = Input::get('term');
	 	$data = DB::table('entidades')->select('COD_ENT','NOM_ENT')->where('NOM_ENT','LIKE',$term.'%')->get();
	 	//$result[0] = array('value' => 'Medicadiz', 'id' => '2');
	 	foreach ($data as $v) {
	 		$result[] =  array('value' => $v->NOM_ENT, 'id' => $v->COD_ENT);
	 	}
	 	return Response::json($result);
	 });


	 Route::any('prod/autocomplete3', function(){  
	 	// $term = "med";
	 	$term = Input::get('term');
	 	$data = DB::table('productos')->select('COD_PRO','NOM_PRO')->where('NOM_PRO','LIKE','%'.$term.'%')->get();
	 	foreach ($data as $v) {
	 		$result[] =  array('value' => $v->NOM_PRO, 'id' => $v->COD_PRO);
	 	}
	 	return Response::json($result);
	 });


	 Route::any('fab/autocomplete', function(){  
	 	// $term = "med";
	 	$term = Input::get('term');
	 	$data = DB::table('productos')->select('COD_PRO','NOM_PRO')->where('TIP_PRO',1)
	 			    ->where('NOM_PRO','LIKE','%'.$term.'%')->get();
	 	foreach ($data as $v) {
	 		$result[] =  array('value' => $v->NOM_PRO, 'id' => $v->COD_PRO);
	 	}
	 	return Response::json($result);
	 });

	 Route::any('serv/autocomplete4', function(){  
	 	// $term = "med";
	 	$term = Input::get('term');
	 	$data = DB::table('servicios')->select('COD_SER','NOM_SER')->where('NOM_SER','LIKE','%'.$term.'%')->get();
	 	foreach ($data as $v) {
	 		$result[] =  array('value' => $v->NOM_SER, 'id' => $v->COD_SER);
	 	}
	 	return Response::json($result);
	 });


	 Route::any('liq/autocomplete2/', function(){  
	 	// $term = "med";
	 	$term = Input::get('term');
	 	$ident = Input::get('ident');
	 	$data = DB::table('servicios')
	 			 ->join('tarifas', 'servicios.COD_SER', '=', 'tarifas.COD_SER')
	 	         ->select('servicios.COD_SER','NOM_SER','VAL_SER')
	 	         ->where('NOM_SER','LIKE',$term.'%')
	 	         ->where('COD_ENT', '=', $ident)->get();
	 	//$result[0] = array('value' => 'consulta salud', 'id' => $ident);
	 	foreach ($data as $v) {
	 		$result[] =  array('value' => $v->NOM_SER, 'id' => $v->COD_SER, 'precio' => $v->VAL_SER);
	 	}
	 	return Response::json($result);
	 });

	 Route::any('liq/autocomplete3/', function(){  
	 	// $term = "med";
	 	$term = Input::get('term');
	 	$ident = Input::get('ident');
	 	$data = DB::table('productos')
	 			 ->join('precios', 'productos.COD_PRO', '=', 'precios.COD_PRO')
	 	         ->select('productos.COD_PRO','NOM_PRO','VAL_PRO','VAL_IVA')
	 	         ->where('NOM_PRO','LIKE',$term.'%')
	 	         ->where('COD_ENT', '=', $ident)->get();
	 	//$result[0] = array('value' => 'consulta salud', 'id' => $ident);
	 	foreach ($data as $v) {
	 		$result[] =  array('value' => $v->NOM_PRO, 'id' => $v->COD_PRO, 'precio' => $v->VAL_PRO, 'iva' => $v->VAL_IVA);
	 	}
	 	return Response::json($result);
	 });

	 Route::any('price/autocomplete6/', function(){  
	 	// $term = "med";
	 	$term = Input::get('term');
	 	$ident = Input::get('ident');
	 	$data = DB::select( DB::raw("SELECT COD_PRO, NOM_PRO FROM productos where EST_PRO = 1 and COD_PRO not in (select COD_PRO from precios where COD_ENT = $ident ) and NOM_PRO like '$term%'") );
	 	//$result[0] = array('value' => 'consulta salud', 'id' => $ident);
	 	foreach ($data as $v) {
	 		$result[] =  array('value' => $v->NOM_PRO, 'id' => $v->COD_PRO);
	 	}
	 	return Response::json($result);
	 });

	 Route::any('fabri/autocomplete/', function(){  
	 	// $term = "med";
	 	$term = Input::get('term');
	 	$pt = Input::get('ident');
	 	$data = DB::select( DB::raw("SELECT COD_PRO, NOM_PRO FROM productos where EST_PRO = 1 and TIP_PRO = 2 and COD_PRO not in (select idinsumo from prod_insumo where idprod = $pt ) and NOM_PRO like '$term%'") );
	 	//$result[0] = array('value' => 'consulta salud', 'id' => $ident);
	 	foreach ($data as $v) {
	 		$result[] =  array('value' => $v->NOM_PRO, 'id' => $v->COD_PRO);
	 	}
	 	return Response::json($result);
	 });

	 Route::any('liq/prev','FactController@preview');

	 Route::get('pdfprev/{id}/{fecha}/{resol}', [
		'uses' => 'FactController@show',
		'as' => 'pdfprev'
		]);

	 Route::any('liq/fact','FactController@store');

	 /*Route::any('liq/{numfac}/{idsel}',function($numfac){
	 	return View('liq.viewliq')->with('mensaje','Factura '.$numfac.' liquidada Satisfactoriamente');
	 });*/

	Route::any('liq/{numfac}/{idsel}',function($numfac,$idsel){
	 	$resol = DB::table('resoluciones')
	 				->where('id',$idsel)
	 				->first();

	 				//dd($resol);
	 	return View('liq.viewliq',[
	 		'mensaje'   => 'Factura '.$numfac.' liquidada Satisfactoriamente',
	 		'idsel'     => $idsel,
       	    'numressel' => $resol->num_resol,
       	    'tipo_fac'  => $resol->tipo_fac,
       	    'fecsel'    => $resol->fec_resol,
       	    'inisel'    => $resol->ini_consec,
       	    'finsel'    => $resol->fin_consec,
       	    'actsel'    => $resol->act_consec,
       	    'prefijo'    => $resol->prefijo,
	 		]);
	 });

	 Route::get('pdffact/{numfac}/{resol}', [
		'uses' => 'FactController@pdfshow',
		'as' => 'pdffact'
		]);


});

Route::group(['middleware' => ['auth','role:3']], function () {

	Route::get('resoanu',[
		'uses' => 'FactController@selectResAnu',
		'as' => 'resoanu'
	 
	]);

	Route::post('resoanu',[
		'uses' => 'FactController@linkanu',
		'as' => 'resoanu'
	 
	]);  

	

	Route::post('anu',[
		'uses' => 'FactController@validanu',
		'as' => 'anu'
	 
	]); 


	});

Route::group(['middleware' => ['auth','role:4']], function () {

	Route::get('imp', function(){
		return View('liq.viewimp');
	});


	Route::post('imp',[
		'uses' => 'FactController@queryFact',
		'as' => 'imp'
	 
	]); 

	Route::any('imp/query','FactController@queryFact');
	
	Route::get('imp/pag',function(){
		return View('liq.listfact');
	});

	});


Route::group(['middleware' => ['auth','role:5']], function () {

	Route::get('resolrad',[
		'uses' => 'FactController@selectResRad',
		'as' => 'resolrad'
	 
	]);

	Route::post('resolrad',[
		'uses' => 'FactController@linkrad',
		'as' => 'resolrad'
	 
	]);  

	Route::get('rad', function(){
		return View('liq.viewrad');
	}); 

	Route::post('rad',[
		'uses' => 'FactController@validrad',
		'as' => 'rad'
	 
	]); 


	});


Route::group(['middleware' => ['auth','role:8']], function () {

	Route::get('config',[
		'uses' => 'ConfigController@create',
		'as' => 'config'
	 
	]); 

	Route::post('config',[
		'uses' => 'ConfigController@store',
		'as' => 'config'
	 
	]); 

	Route::get('configedit/{id}',[
		'uses' => 'ConfigController@edit',
		'as' => 'editconfig'
	]);   

	Route::post('configedit/{id}',[
		'uses' => 'ConfigController@update',
		'as' => 'upconfig'
	]);   

	Route::get('pdfconfig/{id}', [
		'uses' => 'ConfigController@selectResol',
		'as' => 'pdfconfig'
		]);

	Route::post('pdfconfig/{id}', [
		'uses' => 'ConfigController@show',
		'as' => 'pdfview'
		]);

	});

Route::group(['middleware' => ['auth','role:9']], function () {
		// Registration routes...
	Route::get('register', [
	'uses' => 'Auth\AuthController@getRegister',
	'as' => 'register'
	]);

		Route::post('register', [
	 'uses' => 'Auth\AuthController@postRegister',
	 'as' => 'register'
	]);
});

Route::group(['middleware' => ['auth','role:10']], function () { 
	Route::get('ref/{numfac}',  [
		'uses' => 'FactController@refact',
		'as' => 'ref'
		]);
	
	Route::get('ref/pdfprev/{id}/{fecha}', [
		'uses' => 'FactController@show',
		'as' => 'pdfprev'
		]);

	Route::any('ref/liq/fact','FactController@store');

	Route::any('ref/liq/{numfac}',function($numfac){
	 	return View('liq.viewliq')->with('mensaje','Factura '.$numfac.' liquidada Satisfactoriamente');
	 });

	Route::get('ref/pdffact/{numfac}/{resol}', [
		'uses' => 'FactController@pdfshow',
		'as' => 'pdffact'
		]);

});

Route::group(['middleware' => ['auth','role:11']], function () {

	Route::get('pago', function(){
		return View('cartera.viewpago');
	}); 

	Route::post('pago',[
		'uses' => 'PagoController@store',
		'as' => 'pago'
	 
	]); 

});

Route::group(['middleware' => ['auth','role:12']], function () {

	Route::get('informes', function(){
		return View('cartera.viewinfo');
	}); 

	Route::post('informes',[
		'uses' => 'PagoController@store',
		'as' => 'informes'
	 
	]); 

	Route::get('infopago', function(){
		return View('cartera.viewinfpago');
	}); 

	Route::post('infopago',[
		'uses' => 'PagoController@querypago',
		'as' => 'infopago'
	 
	]); 

	Route::get('infoedad', function(){
		return View('cartera.viewinfedad');
	}); 

	Route::post('infoedad',[
		'uses' => 'PagoController@queryedad',
		'as' => 'infoedad'
	 
	]); 

	Route::get('inforad',[
		'uses' => 'FactController@queryrad',
		'as' => 'inforad'
	 
	]); 

	Route::get('inforango', function(){
		return View('cartera.viewinfrango');
	}); 

	Route::post('inforango',[
		'uses' => 'FactController@queryrango',
		'as' => 'inforango'
	 
	]);


});


Route::group(['middleware' => ['auth','role:13']], function () {
		
	Route::get('anupago', function(){
		return View('cartera.viewanupago');
	}); 

		Route::post('anupago', [
	 'uses' => 'PagoController@listpagoanu',
	 'as' => 'anupago'
	]);

	Route::get('borrapago/{id}',  [
		'uses' => 'PagoController@delete',
		'as' => 'borrapago'
		]);
});


Route::group(['middleware' => ['auth','role:14']], function () {
		
	Route::get('producto', function(){
		return View('config.viewproducto');
	}); 

	Route::post('update/{id}', [
	 'uses' => 'ProductoController@update',
	 'as' => 'upprod'
	]);
		
	Route::post('producto', [
	 'uses' => 'ProductoController@store',
	 'as' => 'producto'
	]);

	Route::post('buscaprod',  [
		'uses' => 'ProductoController@show',
		'as' => 'buscaprod'
		]);

	Route::get('editprod/{id}', [
	 'uses' => 'ProductoController@edit',
	 'as' => 'editprod'
	]);
});


Route::group(['middleware' => ['auth','role:15']], function () {
		
	Route::get('fabrica', function(){
		return View('config.viewprodInsumo');
		}); 

		Route::post('fabrica', [
	 	'uses' => 'FabricaController@store',
	 	'as' => 'fabrica'
		]);

		Route::post('copiaprec',  [
		'uses' => 'PrecioController@copiaprec',
		'as' => 'copiaprec'
		]);

		Route::post('buscafab',  [
		'uses' => 'FabricaController@show',
		'as' => 'buscafab'
		]);

		Route::any('erasefabri','FabricaController@delete');


		Route::get('fabri_postdelete','FabricaController@link_postdelete');
});


Route::group(['middleware' => ['auth','role:16']], function () {
		
	Route::get('entidad', function(){
		return View('config.viewentidad');
	}); 

		Route::post('upent/{id}', [
	 'uses' => 'EntityController@update',
	 'as' => 'upent'
	]);

	Route::post('entidad', [
	 'uses' => 'EntityController@store',
	 'as' => 'entidad'
	]);

	Route::post('buscaent',  [
		'uses' => 'EntityController@show',
		'as' => 'buscaent'
		]);

	Route::get('editent/{id}', [
	 'uses' => 'EntityController@edit',
	 'as' => 'editent'
	]);

	Route::any('depto','UbiController@list_depto');
	
	Route::any('ciudad','UbiController@list_ciudad');


});


Route::group(['middleware' => ['auth','role:17']], function () {

		Route::get('precios', function(){
		return View('config.viewprecio');
		}); 

		Route::post('precios', [
	 	'uses' => 'PrecioController@store',
	 	'as' => 'precios'
		]);

		Route::post('copiaprec',  [
		'uses' => 'PrecioController@copiaprec',
		'as' => 'copiaprec'
		]);

		Route::post('buscapre',  [
		'uses' => 'PrecioController@show',
		'as' => 'buscapre'
		]);

		Route::any('eraseprec','PrecioController@delete');


		Route::get('prec_postdelete','PrecioController@link_postdelete');


	});


Route::group(['middleware' => ['auth','role:18']], function () {

		Route::get('tarifas', function(){
		return View('config.viewtarifa');
		}); 

		Route::post('tarifas', [
	 	'uses' => 'TarifaController@store',
	 	'as' => 'tarifas'
		]);

		Route::post('copiatar',  [
		'uses' => 'TarifaController@copiatar',
		'as' => 'copiatar'
		]);

		Route::post('buscatar',  [
		'uses' => 'TarifaController@show',
		'as' => 'buscatar'
		]);

		Route::any('erasetar','TarifaController@delete');


		Route::get('tar_postdelete','TarifaController@link_postdelete');


	});



Route::group(['middleware' => ['auth','role:19']], function () {

	Route::get('inventarios', function(){
		return View('inv.dashboard');
	}); 

	Route::post('inventarios',[
		'uses' => 'PagoController@store',
		'as' => 'inventarios'
	 
	]); 

	Route::get('bodega', function(){
		return View('inv.viewbodega');
	}); 

	Route::post('bodega',[
		'uses' => 'PagoController@querypago',
		'as' => 'bodega'
	 
	]); 

	Route::get('infoedad', function(){
		return View('cartera.viewinfedad');
	}); 

	Route::post('infoedad',[
		'uses' => 'PagoController@queryedad',
		'as' => 'infoedad'
	 
	]); 

	Route::get('inforad',[
		'uses' => 'FactController@queryrad',
		'as' => 'inforad'
	 
	]); 

	Route::get('inforango', function(){
		return View('cartera.viewinfrango');
	}); 

	Route::post('inforango',[
		'uses' => 'FactController@queryrango',
		'as' => 'inforango'
	 
	]);


});



// Authentication routes...
Route::get('login', [
	'uses' => 'Auth\AuthController@getLogin',
	'as'   => 'login'
	]);
Route::post('login', 'Auth\AuthController@postLogin');


Route::get('logout', [
    'uses' => 'Auth\AuthController@getLogout',
    'as'   => 'logout'
]);



// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

//Route::get('main', 'MainController@index');

Route::group(['middleware' => 'auth'], function () {

    Route::get('account', function () {
        return view('account');
    });

    Route::get('account/password', 'AccountController@getPassword');
    Route::post('account/password', 'AccountController@postPassword');

    Route::get('account/edit-profile', 'AccountController@editProfile');
    Route::put('account/edit-profile', 'AccountController@updateProfile');

    Route::group(['middleware' => 'verified'], function () {

        Route::get('publish', function () {
            return view('publish');
        });
        Route::post('publish', function () {
            return Request::all();
        });

    });

    Route::group(['middleware' => 'role:admin'], function () {

        Route::get('admin/settings', function () {
            return view('admin/settings');
        });

    });

    Route::group(['middleware' => 'role:editor'], function () {

        Route::get('admin/posts', function () {
            return view('admin/posts');
        });

    });

});
