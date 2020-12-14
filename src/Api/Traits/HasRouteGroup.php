<?php


namespace Rabpack\Routing\Api\Traits;


trait HasRouteGroup
{
    /**
     * @param callable $callback
     */
    protected function groupMethod(callable $callback)
    {
        $this->registerGroup($callback);
    }
    /**
     * @param string $prefix
     * @return $this
     */
    protected function prefixMethod(string $prefix)
    {
        $this->registerPrefix($prefix);
        return $this;
    }

    /**
     * @param $namespace
     * @return $this
     */
    protected function namespaceMethod($namespace)
    {
       $this->registerNamespace($namespace);
        return $this;
    }
    /**
     * @param string $name
     * @return $this
     */
    protected function nameMethod(string $name)
    {
      $this->addName($name);
        return $this;
    }

}