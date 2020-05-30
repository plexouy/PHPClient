<?php
namespace Plexo\Sdk;

class IssuerSignedRequest extends SignedMessage
{
    protected $auth_param = 'Issuer';
}
