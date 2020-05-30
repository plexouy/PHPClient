<?php
namespace Plexo\Sdk\Exception;

class MessageExpiredException extends \Plexo\Sdk\Exception\PlexoException
{
    public function __construct($message, $previous = null)
    {
        parent::__construct($message, \Plexo\Sdk\ResultCode::MESSAGE_EXPIRED, $previous);
    }
}
