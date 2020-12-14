<?php


namespace Rabpack\Routing\Web\Traits;



trait HasRouteMethod
{
    /**
     * @param string $route
     * @param string $actions
     * @return $this
     */
    protected function getMethod(string $route, string $actions)
    {
        $this->addRoute($route,$actions,'get');
        return $this;
    }

    /**
     * @param string $route
     * @param string $actions
     * @return $this
     */
    protected function postMethod(string $route, string $actions)
    {
        $this->addRoute($route,$actions,'post');
        return $this;
    }

    /**
     * @param string $route
     * @param string $actions
     * @return $this
     */
    protected function putMethod(string $route, string $actions)
    {
        $this->addRoute($route,$actions,'put');
        return $this;
    }

    /**
     * @param string $route
     * @param string $actions
     * @return $this
     */
    protected function patchMethod(string $route, string $actions)
    {
        $this->addRoute($route,$actions,'patch');
        return $this;
    }

    /**
     * @param string $route
     * @param string $actions
     * @return $this
     */
    protected function deleteMethod(string $route, string $actions)
    {
        $this->addRoute($route,$actions,'delete');
        return $this;
    }

    /**
     * @param string $route
     * @param string $actions
     * @return $this
     */
    protected function anyMethod(string $route, string $actions)
    {
        $this->addRoute($route,$actions,'any');
        return $this;
    }



}