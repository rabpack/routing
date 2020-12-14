<?php


namespace Rabpack\Routing;


use Exception;
use ReflectionMethod;
class Router
{
    /**
     * @var array[]
     */
    private $routes;
    private $methodField;
    private $current_route;
    private $values = [];

    /**
     * Router constructor.
     */
    public function __construct()
    {

        global $routes;
        $this->routes = $routes;
        $this->methodField = $this->methodField();
        $this->current_route = explode('/',RABCO_PACKAGE_CURRENT_ROUTE);
    }

    public function run()
    {
       $match = $this->match();
       if (empty($match))
           $this->notFound();

       $controllerName = str_replace('\\',RABCO_PACKAGE_DS,$match['controller']);
       $controllerPath = trim(RABCO_PACKAGE_CONTROLLER_DIR,'/ ').RABCO_PACKAGE_DS.$controllerName.'.php';

       if (!file_exists($controllerPath))
           throw new Exception("Controller (\"$controllerName\") Not Found");
       $controllerNameSpace = str_replace('/','\\',trim(RABCO_PACKAGE_CONTROLLER_DIR,'/ '));
       $controller = $controllerNameSpace.'\\'.$match['controller'];
       $obj = new $controller();
       if (!class_exists($controller))
           throw new Exception("Class (\"$controller\") Not Found");
       if (!method_exists($obj,$match['method']))
           throw new Exception("Method (\"{$match['method']}\") in Class (\"$controller\") Not Found");
          $reflection = new ReflectionMethod($controller,$match['method']);
          $countParameters = $reflection->getNumberOfParameters();
          if ($countParameters <= $this->values) {
              call_user_func_array([$obj,$match['method']],$this->values);
          }
    }

    /**
     * @return array
     */
    private function match(): array
    {
      $reserveRoutes = $this->routes[$this->methodField];
      foreach ($reserveRoutes as $route){
          if ($this->compare($route['uri']) == true)
             return ['controller'=>trim($route['controller'],'\\'),'method'=>$route['method']];
          else {
              $this->values = [];
              $this->valuesDefault = [];
          }
      }
      return [];

    }

    /**
     * @param string $reserveRoute
     * @return bool
     */
    private function compare(string $reserveRoute): bool
    {
        #part 1 of 3 part
        if (trim($reserveRoute,'/') === '')
            return trim($this->current_route[0],'/') === '' ? true : false;
        #part 2 of 3 part
    $reserveRouteArray = explode('/',$reserveRoute);
   foreach ($reserveRouteArray as $key=>$reserve){
       if (strlen($reserve) == 0 ) unset($reserveRouteArray[$key]);
   }
    $reserveRouteArray = array_values($reserveRouteArray);
    if (sizeof($reserveRouteArray) != sizeof($this->current_route))
        return false;
        #part 3 of 3 part
    foreach ($this->current_route as $key => $routeElement){
        $reserveRouteArrayElement = $reserveRouteArray[$key];

       if (preg_match('/{([^.}]*)}/',$reserveRouteArrayElement,$matches))

           array_push($this->values, $routeElement);

       elseif($reserveRouteArrayElement != $routeElement)
           return false;

    }
    return true;
    }
    private function notFound()
    {
        http_response_code(404);
        require_once __DIR__ . RABCO_PACKAGE_DS . 'View' . RABCO_PACKAGE_DS . '404.php';
        exit;
    }
    /**
     * @return string
     */
    private function methodField(): string
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        if ($method == 'post') {
            if (isset($_POST['_method'])) {
                if ($_POST['_method'] == 'patch') {
                    $method = 'patch';
                }elseif ($_POST['_method'] == 'put'){
                    $method = 'put';
                }elseif ($_POST['_method'] == 'delete') {
                    $method = 'delete';
                }elseif ($_POST['_method'] == 'any'){
                    $method = 'any';
                }
            }
        }
        return $method;
    }



}