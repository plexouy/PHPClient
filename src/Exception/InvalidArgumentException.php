<?php
namespace Plexo\Sdk\Exception;

class InvalidArgumentException extends \Plexo\Sdk\Exception\PlexoException
{
    public function __construct($message, $previous = null)
    {
        parent::__construct($message, \Plexo\Sdk\ResultCode::ARGUMENT_ERROR, $previous);
    }
}
