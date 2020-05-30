<?php
namespace Plexo\Sdk\Exception;

class SignatureException extends PlexoException
{
    public function __construct($message, $previous = null) {
        parent::__construct($message, \Plexo\Sdk\ResultCode::INVALID_SIGNATURE, $previous);
    }
}
