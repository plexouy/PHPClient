<?php
namespace Plexo\Sdk;

use Plexo\Sdk\Exception;

//use Symfony\Component\Validator\Validation;

abstract class Message implements MessageInterface
{
    protected $data;
    protected $validatedData;

    public function __construct($data = null)
    {
        $this->load($data);
    }

    public function validate()
    {
        $scheme = call_user_func(array(get_called_class(), 'getValidationMetadata'));
        $errors = [];
        foreach ($scheme as $key => $val) {
            if ($val['required'] && is_null($this->data[$key])) {
                array_push($errors, new Exception\InvalidArgumentException(sprintf('%s cannot be empty', $key)));
            } elseif (!is_null($this->data[$key]) && !call_user_func('is_' . $val['type'], $this->data[$key])) {
                array_push($errors, new Exception\InvalidArgumentException(sprintf('%s must be of type %s', $key, $val['type'])));
            }
        }
        return count($errors) ? $errors : false;
    }

    protected function load($data)
    {
        if (is_null($data)) {
            return;
        }
        if (!is_array($data)) {
            throw new Exception('Initialization data must be an array.');
        }
        foreach ($data as $k => $v) {
            if (array_key_exists($k, $this->data)) {
                $this->data[$k] = $v;
            }
        }
    }

    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->data)) {
            $this->data[$name] = $value;
        }
    }
    
    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
    }
    
    public function to_array()
    {
        return $this->data;
    }
}
