<?php
namespace Plexo\Sdk\Exception;

class FingerprintException extends \Plexo\Sdk\Exception\PlexoException
{
    public function __construct($message, $previous = null)
    {
        parent::__construct($message, \Plexo\Sdk\ResultCode::INVALID_FINGERPRINT, $previous);
    }
}
