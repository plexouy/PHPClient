<?php
namespace Plexo\Sdk\Type;

class QueryOperation
{
    const TYPE_AND  = 0;
    const TYPE_OR   = 1;
    const TYPE_NONE = 2;
    
    private static $keys = [
        'And',
        'Or',
        'None',
    ];

    private $param;
    private $value;

    public function __construct($param, $value)
    {
        $this->param = $param;
        $this->value = $value;
    }

    public function getParam()
    {
        return $this->param;
    }

    public function getParamKey()
    {
        if (!array_key_exists($this->param, self::$keys)) {
            throw new \Plexo\Sdk\Exception\InvalidArgumentException();
        }
        return self::$keys[$this->param];
    }

    public function getValue()
    {
        return $this->value;
    }
}
