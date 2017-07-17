<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;


/*Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});*/
Route::get('/', function () {
    return view('welcome');
});
Route::auth();

Route::get('/home', 'HomeController@index');

/*
 * para control de facebook ini
 */
// Generate a login URL
Route::get('/facebook/login', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
{
    // Send an array of permissions to request
    $login_link = $fb
        ->getRedirectLoginHelper()
        ->getLoginUrl(env('APP_URL').'/facebook/callback', ['email', 'user_events']);

    echo '<!DOCTYPE html>
<html lang="en">
<link href="'. asset('/css/skins/skin-red.css').'" rel="stylesheet" type="text/css" />
<link href="'. asset('/css/bootstrap.css').'" rel="stylesheet" type="text/css" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<link href="'. asset('/css/AdminLTE.css').'" rel="stylesheet" type="text/css" />
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Facebook</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body><a href="' . $login_link . '" class="btn btn-block btn-social btn-facebook" > <span class="fa fa-facebook"></span>'.trans('home.facebook1').'</a><body>
</html>';
});

// Endpoint that is redirected to after an authentication attempt
Route::get('/facebook/callback', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
{
    // Obtain an access token.
    try {
        $token = $fb->getAccessTokenFromRedirect();
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        dd($e->getMessage());
    }

    // Access token will be null if the user denied the request
    // or if someone just hit this URL outside of the OAuth flow.
    if (! $token) {
        // Get the redirect helper
        $helper = $fb->getRedirectLoginHelper();

        if (! $helper->getError()) {
            abort(403, 'Unauthorized action.');
        }

        // User denied the request
        dd(
            $helper->getError(),
            $helper->getErrorCode(),
            $helper->getErrorReason(),
            $helper->getErrorDescription()
        );
    }

    if (! $token->isLongLived()) {
        // OAuth 2.0 client handler
        $oauth_client = $fb->getOAuth2Client();

        // Extend the access token.
        try {
            $token = $oauth_client->getLongLivedAccessToken($token);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }
    }

    $fb->setDefaultAccessToken($token);

    // Save for later
    Session::put('fb_user_access_token', (string) $token);

    // Get basic info on the user from Facebook.
    try {
        $response = $fb->get('/me?fields=id,name,email');
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        dd($e->getMessage());
    }

    // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
    $facebook_user = $response->getGraphUser();

    // Create the user if it does not exist or update the existing entry.
    // This will only work if you've added the SyncableGraphNodeTrait to your User model.
    //dd($facebook_user);
    $user = App\User::createOrUpdateGraphNode($facebook_user);
    //dd($user);
    // Log the user into Laravel
    Auth::login($user);

    return redirect('/')->with('message', 'Successfully logged in with Facebook');
});
/*
 * para control de facebook fin
 */
/**
 * del arbol
 * https://packagist.org/packages/jaapmoolenaar.nl/crud-generator
 * php artisan crud:controller ArbolController --crud-name=posts --model-name=Post --view-path=directory --route-group=admin
 * php artisan crud:view arbol --fields=nombre_comun:string,nombre_cientifico:string,patrimonial:boolean,descripcion:text,historia:string,lat:string,lng:string --view-path=directory --route-group=admin
 */
Route::resource('arbol', 'ArbolController');
/**
 * fin arbol
 */

Route::group(['middleware' => ['web']], function () {
    //Route::resource('admin/posts', 'Admin\\PostsController');
});

/**
 * del motivosdenuncias
 * https://packagist.org/packages/jaapmoolenaar.nl/crud-generator
 * php artisan crud:controller MotivosDenunciasController --crud-name=motivo_denuncias --model-name=Motivos_Denuncias --view-path=directory
 * php artisan crud:view motivo_denuncias --fields=nombre_denuncia:string --view-path=directory
 */
Route::resource('motivo_denuncias', 'MotivosDenunciasController');
/**
 * fin motivosdenuncias
 */

/**
 * del denuncias
 * https://packagist.org/packages/jaapmoolenaar.nl/crud-generator
 * php artisan crud:controller DenunciasController --crud-name=denuncias --model-name=Denuncias --view-path=directory
 * php artisan crud:view denuncias --fields=descripcion:text,lugar:string,lat:string,lng:string,motivo_den_id:integer --view-path=directory
 * */
Route::resource('denuncias', 'DenunciasController');
/**
 * fin denuncias
 */

/**
 * del usuariologin
 * https://packagist.org/packages/jaapmoolenaar.nl/crud-generator
 * php artisan crud:controller UsuarioLogController --crud-name=usuario --model-name=User --view-path=directory
 * php artisan crud:view usuario --fields=name:string,first_name:string,last_name:string,rol:boolean,padrino:boolean,username:string,email:email,password:password --view-path=directory
 */
Route::resource('usuario', 'UsuarioLogController');
/**
 * fin usuariologin
 */
/*
 * log outside
 */
Route::get('loginOUT', function()
{
    $remember = \Illuminate\Support\Facades\Input::get('remember');
    $credentials = array(
        'email' => \Illuminate\Support\Facades\Input::get('username'),
        'password' => \Illuminate\Support\Facades\Input::get('password'),
        'remember' => !empty($remember) ? $remember : null
    );

    //if (Auth::attempt( $credentials ))
    if (Auth::attempt(['email' => \Illuminate\Support\Facades\Input::get('username'),
        'password' => \Illuminate\Support\Facades\Input::get('password')],
        !empty($remember) ? $remember : null))
    {
        return Response::json('Logged in'.Auth::viaRemember());
        //return Redirect::to_action('user@index'); you'd use this if it's not AJAX request
    }else{
        return Response::json('Error logging in', 400);
        /*return Redirect::to_action('home@login')
        -> with_input('only', array('new_username'))
        -> with('login_errors', true);*/
    }
}); // <- Note the EXTRA ")" at the end here


Route::resource('opciones_check', 'OpcionesCheckListController');
Route::resource('areas', 'AreasController');
Route::resource('modelo', 'ModeloEquipoController');
Route::resource('orden', 'OrdenDeCompraController');

Route::resource('equipos', 'EquiposController');
Route::resource('custodio', 'CustodiosController');
Route::resource('estaciones', 'EstacionesController');
Route::resource('checklist', 'CheckListController');
Route::resource('checklist_opcionescheck', 'CheckList_OpcionesCheckListController');

Route::get('checklist_crear/{area_id}/{checklist}', 'CheckListController@crearChecklist');
Route::post('checklist_crear/{area_id}/{checklist}', 'CheckListController@crearChecklist');

Route::get('checklist_editar/{area_id}/{checklist}', 'CheckListController@editarChecklist');
Route::post('checklist_editar/{area_id}/{checklist}', 'CheckListController@editarChecklist');


Route::resource('equiposerching', 'EquiposController@home');
Route::resource('postSearch', 'EquiposController@postSearch');

Route::get('tags', function (Illuminate\Http\Request  $request) {
    $term = $request->term ?: '';
    $term = str_replace(" ", "%", "$term");
    $tags= App\Equipos::where('no_serie', 'like', '%'.$term.'%')->
    orwhere('codigo_barras', 'like', '%'.$term.'%')->
    orwhere('codigo_otro', 'like', '%'.$term.'%')->
    orwhere('descripcion', 'like', '%'.$term.'%')->
    orwhere('ip', 'like', '%'.$term.'%')->
    orwhere('codigo_avianca', 'like', '%'.$term.'%')->pluck('no_serie','id');
    $valid_tags = [];
    foreach ($tags as $id => $tag) {
        $valid_tags[] = ['id' => $id, 'text' => $tag];
    }
    return \Response::json($valid_tags);
});

Route::resource('config', 'ConfiguracionController');

Route::get('test', function (Illuminate\Http\Request  $request) {
    $dat = App\Configuracion::Config('CUSTODIO_BODEGA');
    dd($dat);
});

Route::get('tags_custodio', function (Illuminate\Http\Request  $request) {
    $term = $request->term ?: '';
    $term = str_replace(" ", "%", "$term");
    $tags= App\Custodios::where('nombre_responsable', 'like', '%'.$term.'%')->
    orwhere('cargo', 'like', '%'.$term.'%')->
    orwhere('area_piso', 'like', '%'.$term.'%')->pluck('nombre_responsable','id');
    $valid_tags = [];
    foreach ($tags as $id => $tag) {
        $valid_tags[] = ['id' => $id, 'text' => $tag];
    }
    return \Response::json($valid_tags);
});

Route::get('tags_checklist', function (Illuminate\Http\Request  $request) {
    $term = $request->term ?: '';
    $term = str_replace(" ", "%", "$term");
    $tags= App\CheckList_OpcionesCheckList::where('valor1', 'like', '%'.$term.'%')->
    orwhere('valor2', 'like', '%'.$term.'%')->
    orwhere('valor3', 'like', '%'.$term.'%')->
    orwhere('valor4', 'like', '%'.$term.'%')->pluck('atributo','id');
    $valid_tags = [];
    foreach ($tags as $id => $tag) {
        $valid_tags[] = ['id' => $id, 'text' => $tag];
    }
    return \Response::json($valid_tags);
});

Route::get('tags_model', function (Illuminate\Http\Request  $request) {
    $term = $request->term ?: '';
    $term = str_replace(" ", "%", "$term");
    $tags= App\CheckList_OpcionesCheckList::where('valor1', 'like', '%'.$term.'%')->
    orwhere('valor2', 'like', '%'.$term.'%')->
    orwhere('valor3', 'like', '%'.$term.'%')->
    orwhere('valor4', 'like', '%'.$term.'%')->pluck('atributo','id');
    $valid_tags = [];
    foreach ($tags as $id => $tag) {
        $valid_tags[] = ['id' => $id, 'text' => $tag];
    }
    return \Response::json($valid_tags);
});

Route::get('reasignar/{custodio_id}', 'EquiposController@reasignarindex');
Route::post('reasignar/{custodio_id}', 'EquiposController@reasignarindex');

Route::get('reasignarindexecho', 'EquiposController@reasignarindexecho');
Route::post('reasignarindexecho', 'EquiposController@reasignarindexecho');


Route::get('pdf/{custodio_id}', 'PdfController@invoice');

Route::get('checklist_crear_mini/{area_id}/{checklist}', 'CheckListController@crearChecklist_mini');
Route::post('checklist_crear_mini/{area_id}/{checklist}', 'CheckListController@crearChecklist_mini');


Route::resource('checklist_opcionescheck', 'CheckList_OpcionesCheckListController');

//Route::get('checklist_crear_option', 'CheckListController@crearChecklist');
//Route::post('checklist_crear_option', 'CheckListController@crearChecklist');

// API ROUTES ==================================
Route::group(array('prefix' => 'api'), function() {
    Route::get('checklist_crear_option/{id}', 'CheckList_OpcionesCheckListController@crearChecklist_option_create');
    Route::post('checklist_crear_option', 'CheckList_OpcionesCheckListController@crearChecklist_option_storage');
    Route::delete('checklist_crear_option/{id}/delete', 'CheckList_OpcionesCheckListController@crearChecklist_option_delete');
});

Route::get('tags_model_tipo', function (Illuminate\Http\Request  $request) {
    $term = $request->term ?: '';
    $term = str_replace(" ", "%", "$term");
    $tags= App\ModeloEquipo::where('tipo_equipo', 'like', '%'.$term.'%')->groupby('tipo_equipo')->pluck('tipo_equipo');
    return \Response::json($tags);
});
Route::get('tags_model_modelo', function (Illuminate\Http\Request  $request) {
    $term = $request->term ?: '';
    $term = str_replace(" ", "%", "$term");
    $tags= App\ModeloEquipo::where('modelo', 'like', '%'.$term.'%')->groupby('modelo')->pluck('modelo');
    return \Response::json($tags);
});

Route::resource('reporte1', 'ReporteController');

Route::get('reporte1excel', 'ReporteController@excel');

Route::resource('bitacora', 'BitacoraController');

Route::resource('repo_novedades', 'RepoNovedadesController');

Route::get('custodio_custom/{custodio_id}', 'CustodiosController@show_custom');
Route::post('custodio_custom', 'CustodiosController@show_custom_post');

Route::resource('informes', 'InformeMantenimientoPreventivoController');
Route::resource('ubicacion', 'UbicacionController');

Route::resource('tecnico', 'InformeMantenimientoPreventivoTecnicoController');

Route::get('provider', function()
{
    //https://apps.dev.microsoft.com/#/application/3452e5ca-8189-48b1-b29b-4fe9faadfde9
    $provider = new Stevenmaguire\OAuth2\Client\Provider\Microsoft([
        'clientId'          => '3452e5ca-8189-48b1-b29b-4fe9faadfde9',
        'clientSecret'      => 'pL1J0qP6Agpa6cOwwHNy59s',
        'redirectUri'       => 'https://inventario2.aerogal.dev/microsoft_redirect'
    ]);

    if (!isset($_GET['code'])) {

        // If we don't have an authorization code then get one
        $options = [
            'state' => 'OPTIONAL_CUSTOM_CONFIGURED_STATE',
            'scope' => ['wl.basic'] // array or string
        ];

        $authUrl = $provider->getAuthorizationUrl($options);
        //$authUrl = $provider->getAuthorizationUrl();
        $_SESSION['oauth2state'] = $provider->getState();
        header('Location: '.$authUrl);
        exit;

// Check given state against previously stored one to mitigate CSRF attack
    } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

        unset($_SESSION['oauth2state']);
        exit('Invalid state');

    } else {

        // Try to get an access token (using the authorization code grant)
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

        // Optional: Now you have a token you can look up a users profile data
        try {

            // We got an access token, let's now get the user's details
            $user = $provider->getResourceOwner($token);

            // Use these details to create a new profile
            printf('Hello %s!', $user->getFirstname());

        } catch (Exception $e) {

            // Failed to get user details
            exit('Oh dear...');
        }

        // Use this to interact with an API on the users behalf
        echo $token->getToken();
    }
}); // <- Note the EXTRA ")" at the end here


Route::get('option', function()
{
    $options = [
        'state' => 'OPTIONAL_CUSTOM_CONFIGURED_STATE',
        'scope' => ['wl.basic', 'wl.signin'] // array or string
    ];

    $authorizationUrl = $provider->getAuthorizationUrl($options);
}); // <- Note the EXTRA ")" at the end here

Route::get('microsoft_redirect', function(Request $request)
{
    echo "microsoft_redirect".'<br/>';
    echo $request->input('error').'<br/>';
    echo $request->input('error_description').'<br/>';
    echo $request->input('code').'<br/>';
    echo $request->input('state').'<br/>';
    dd($request);
}); // <- Note the EXTRA ")" at the end here


Route::get('auth2', function () {
    return view('auth.index');
});


/***INI Oauth2*/

Route::get('/redirect', function () {
    $query = http_build_query([
        'client_id' => '4',
        'redirect_uri' => 'http://example.com/callback',
        'response_type' => 'MVjPWI9dMm2Qg6j8EMeQvznB3bvjaNZPXsSY0X9g',
        'scope' => '',
    ]);

    return redirect('http://inventario2.aerogal.dev/oauth/authorize?'.$query);
});

Route::get('/callback', function (Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://inventario2.aerogal.dev/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => 'client-id',
            'client_secret' => 'client-secret',
            'redirect_uri' => 'http://example.com/callback',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
});
/***FIN Oauth2*/


Route::group(['prefix' => 'api'], function()
{
    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');
});


// Route::get('buscaDatoEquipo/{dato}/{valor}', 'EquiposController@buscaDato');