<?php
namespace Plexo\Sdk;

class SignedResponse extends SignedMessage
{
    private $ResultCode;
    private $Response;
    private $ErrorMessage;

    public function getFingerprint()
    {
        return $this->fingerprint;
    }
    
    public function getResponse()
    {
        return $this->Response;
    }
}
