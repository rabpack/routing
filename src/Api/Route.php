<?php
/*
|---------------------------------------------------
|Routing Class
|---------------------------------------------------
|for creation routing use of singleton design pattern
|___________________________________________________
 * */
namespace Rabpack\Routing\Api;


use Rabpack\Routing\Api\Traits\HasBuildMethod;
use Rabpack\Routing\Api\Traits\HasMethodCaller;
use Rabpack\Routing\Api\Traits\HasRouteGroup;
use Rabpack\Routing\Api\Traits\HasRouteMethod;

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