<?php
/*
|---------------------------------------------------
|Routing Class
|---------------------------------------------------
|for creation routing use of singleton design pattern
|___________________________________________________
 * */
namespace Rabpack\Routing\src\Web;



use Rabpack\Routing\src\Web\Traits\HasBuildMethod;
use Rabpack\Routing\src\Web\Traits\HasMethodCaller;
use Rabpack\Routing\src\Web\Traits\HasRouteGroup;
use Rabpack\Routing\src\Web\Traits\HasRouteMethod;

class Route
{
    use HasRouteMethod,HasBuildMethod,HasRouteGroup,HasMethodCaller;

    /**
     * @var null
     */
    private static $instance = null;
    /**
     * @var
     */
    private $prefix = [];
    /**
     * @var
     */
    private $namespaceRoute = [];
    /**
     * @var int
     */
    private $numberGroup = 0;
    /**
     * @var string
     */
    private $routeName = '';
    /**
     * @var array
     */
    private $nameRouteHttpVerb= [];
    /**
     * Route constructor.
     */
    private function __construct(){}

    /**
     * @return Route|null
     */
    public static function instance()
    {
        if (self::$instance == null)
                 self::$instance = new self();
        return self::$instance;
    }



}