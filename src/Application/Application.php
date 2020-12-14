<?php


namespace Rabpack\Routing\Application;


use Rabpack\Routing\Router;

class Application
{
    /**
     * Application constructor.
     * @param string $baseDir
     * @param string $controllerDir
     * @throws \Exception
     */
    public function __construct(string $baseDir,string $controllerDir)
    {
        $this->loadConfig($baseDir,$controllerDir);
    }

    /**
     * @param string $baseDir
     * @param string $controllerDir
     * @throws \Exception
     */
    private function loadConfig(string $baseDir,string $controllerDir)
    {
        $temporary = explode('?',trim($_SERVER['REQUEST_URI'],'/'));
        define('RABCO_PACKAGE_CURRENT_ROUTE',$temporary[0]);
        define('RABCO_PACKAGE_BASE_DIR',$baseDir);
        define('RABCO_PACKAGE_CONTROLLER_DIR',$controllerDir);
        define('RABCO_PACKAGE_DS',dirname(DIRECTORY_SEPARATOR));
        global $routes;
        $routes = [
            "get"=>[],
            "post"=>[],
            "put"=>[],
            "patch"=>[],
            "delete"=>[],
            "any"=>[]
        ];
        $router = new Router();
        $router->run();
    }
}