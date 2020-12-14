<?php


namespace Rabpack\Routing\src\Web\Traits;


trait HasMethodCaller
{
    public static function __callStatic($name, $arguments)
    {
        $class = get_called_class();
        $instance = $class::instance();

        return $instance->methodCaller($instance,$name,$arguments);
    }
    public function __call($name, $arguments)
    {
        return $this->methodCaller($this,$name,$arguments);
    }

    protected function methodCaller($object,$methodName,$args)
    {
        $name=$methodName."Method";
        return call_user_func_array([$object,$name],$args);
    }
}