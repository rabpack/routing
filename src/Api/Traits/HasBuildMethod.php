<?php


namespace Rabpack\Routing\src\Api\Traits;


trait HasBuildMethod
{
    /**
     * @param string $route
     * @param string $actions
     * @param string $httpVerb
     */
    private function addRoute(string $route, string $actions, string $httpVerb): void
    {

        $routeFill = implode('/',$this->prefix).'/'.trim($route,'/');
        $route = isset($this->prefix) ? 'api/'.$routeFill  : 'api/'.trim($route,'/');
        $actions = explode('@',$actions);

        $controller =  isset($this->namespaceRoute) ? trim(implode('\\',$this->namespaceRoute),'\\ ')."\\".trim($actions[0],'\\') : trim($actions[0],'\\');

        global $routes;
        array_push($routes[$httpVerb],['uri'=>$route,'controller'=>$controller,'method'=>$actions[1],'name'=>'']);

        $this->nameRouteHttpVerb = ['httpVerb'=>$httpVerb,'route'=>$route];
    }

    /**
     * @param callable $callback
     */
    protected function registerGroup(callable $callback):void
    {
        $this->numberGroup++;
        $callback();
        $this->numberGroup--;
        //Register Prefix
       $this->addPrefix();
        //Register Namespace
       $this->addNamespace();
    }

    /**
     * @param string $prefix
     */
    private function registerPrefix(string $prefix): void
    {
        if ($this->numberGroup == 0 )
            $this->prefix = [];

        $this->prefix[] = $prefix;
    }

    /**
     *
     */
    private function addPrefix(): void
    {
        if (count($this->prefix) > $this->numberGroup) {
            array_pop($this->prefix);
        }

        if ($this->numberGroup == 1) {
            foreach ($this->prefix as $key=>$value){
                if ($key != 0)
                    unset($this->prefix[$key]);
            }
        }
    }
    /**
     * @param string $namespace
     */
    private function registerNamespace(string $namespace): void
    {
        if ($this->numberGroup == 0)
            $this->namespaceRoute = [];

        $this->namespaceRoute[] = $namespace;
    }

    /**
     *
     */
    private function addNamespace(): void
    {
        if (count($this->namespaceRoute) > $this->numberGroup) {
            array_pop($this->namespaceRoute);
        }

        if ($this->numberGroup == 1) {
            foreach ($this->namespaceRoute as $key=>$value){
                if ($key != 0)
                    unset($this->namespaceRoute[$key]);
            }
        }
    }

    /**
     * @param string $name
     */
    private function addName(string $name): void
    {
        $this->routeName = $name;
        global $routes;
        $routes[$this->nameRouteHttpVerb['httpVerb']][count($routes[$this->nameRouteHttpVerb['httpVerb']])-1]['name'] = $this->routeName;
        $this->routeName = '';
    }
}