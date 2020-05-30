<?php
namespace Plexo\Sdk\Exception;

class ConfigurationException extends \Plexo\Sdk\Exception\PlexoException
{
    public function __construct($message, $previous = null)
    {
        parent::__construct($message, \Plexo\Sdk\ResultCode::SYSTEM_ERROR, $previous);
    }
}
