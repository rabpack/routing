# routing
For Run Routing in index.php file new object of Application Class:

$app = new Application();

then for use of this class should create a one file in project. 
For example, create a file named Web in your project:<br>
Web.php Contents : 
--------------------------------------------
use Rabpack\Routing\Web\Route;

Route::get('/','HomeController@index');<br>
Route::get('/posts','HomeController@post');<br>
---------------------------------------------
This file is used to define the route.
then should this file add to index.php :<br> 

index.php : 
-----------------------------------------------------------------------------
  require autoload.php : <br>
  require_once dirname(__DIR__)."/vendor/autoload.php"; <br>
  
   create new object Application class : <br> 
  $app = new Rabpack\Routing\Application\Application();<br>
  
  call method globalRoutes for create HttpVerbs : <br>
  $app->globalRoutes();<br>
  
  require routes file : <br>  
  require_once dirname(__DIR__)."/routes/web.php";<br>
  require_once dirname(__DIR__)."/routes/api.php";<br>
  
  call method loadConfig : <br>
  $app->loadConfig("root path","controllers dir path","Controllers Namespace");<br>
  -----------------------------------------------------------------------------
  Example Create Routes : <br>
  -----------------------------------------------------------------------------
 
  use Rabpack\Routing\Web\Route;<br> 
  
  Route::get('/','HomeController@index'); // route : http://example.com => controller : HomeController => method : index <br>
  
  Route::get('/posts','PostController@index'); // route : http://example.com/posts => controller : PostController => method : index <br>
  
  Route::namespace('Admin')->prefix('admin')->group(function () {<br> 
      Route::get('/','DashboardController@index');  // route : http://example.com/admin/ => controller : Admin\DashboardController => method : index <br>
      Route::prefix('post')->group(function () {
         Route::get('/','PostController@index'); // route : http://example.com/admin/post/ => controller : Admin\PostController => method : index <br>
         Route::get('/show','PosrController@show'); // route : http://example.com/admin/post/show => controller : Admin\PostController => method : show <br>
         Route::put('/edit/{id}','PostController@edit'); // route : http://example.com/admin/post/edit/115 => controller : Admin\PostController => method : edit <br>
      });
  });
  -----------------------------------------------------------------------------
