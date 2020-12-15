# routing

#Install Package : <br>

"composer require rabpack/routing"<br>

For Run Routing in index.php file new object of Application Class:<br>

$app = new Application();<br>

then for use of this class should create a one file in project. <br>
For example, create a file named Web in your project:<br>

Web.php Contents :
------------------------------------------------------------------------
    use Rabpack\Routing\Web\Route;

    Route::get('/','HomeController@index');
    Route::get('/posts','HomeController@post');
------------------------------------------------------------------------

This file is used to define the route.<br>
then should this file add to index.php :<br> 

index.php : 
-----------------------------------------------------------------------------
    require autoload.php : 
    require_once dirname(__DIR__)."/vendor/autoload.php"; 
  
    create new object Application class : 
    $app = new Rabpack\Routing\Application\Application();
  
    call method globalRoutes for create HttpVerbs : 
    $app->globalRoutes();
  
    require routes file : <br>  
    require_once dirname(__DIR__)."/routes/web.php";
    require_once dirname(__DIR__)."/routes/api.php";
  
    call method loadConfig : 
    $app->loadConfig("root path","controllers dir path","Controllers Namespace");
-----------------------------------------------------------------------------
  
  Example Create Routes : <br>
-----------------------------------------------------------------------------
     use Rabpack\Routing\Web\Route;
  
    Route::get('/','HomeController@index'); // route : http://example.com => controller : HomeController => method : index 
  
     Route::get('/posts','PostController@index'); // route : http://example.com/posts => controller : PostController => method : index 
  
     Route::namespace('Admin')->prefix('admin')->group(function () { 
  
      Route::get('/','DashboardController@index');  // route : http://example.com/admin/ => controller : Admin\DashboardController => method : index 
      
      Route::prefix('post')->group(function () {
      
         Route::get('/','PostController@index'); // route : http://example.com/admin/post/ => controller : Admin\PostController => method : index 
         
         Route::get('/show','PosrController@show'); // route : http://example.com/admin/post/show => controller : Admin\PostController => method : show
         
         Route::put('/edit/{id}','PostController@edit'); // route : http://example.com/admin/post/edit/115 => controller : Admin\PostController => method : edit
         
      });
     });
  -----------------------------------------------------------------------------
