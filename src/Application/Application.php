<?php


namespace Rabpack\Routing\Application;


use Rabpack\Routing\Router;

class Application
{
    /**
     * @param string $baseDir
     * @param string $controllerDir
     * @param string $controllerNamespace
     * @throws \Exception
     */
    public function loadConfig(string $baseDir, string $controllerDir, string $controllerNamespace)
    {
        $temporary = explode('?',trim($_SERVER['REQUEST_URI'],'/'));
        define('RABCO_PACKAGE_CURRENT_ROUTE',$temporary[0]);
        define('RABCO_PACKAGE_BASE_DIR',$baseDir);
        define('RABCO_PACKAGE_CONTROLLER_DIR',$controllerDir);
        define('RABCO_PACKAGE_DS',DIRECTORY_SEPARATOR);
        define('RABCO_PACKAGE_CONTROLLER_NAME_SPACE',$controllerNamespace);
        $router = new Router();
        $router->run();
    }

    public function globalRoutes()
    {
        global $routes;
        $routes = [
            "get"=>[],
            "post"=>[],
            "put"=>[],
            "patch"=>[],
            "delete"=>[],
            "any"=>[]
        ];
    }
}