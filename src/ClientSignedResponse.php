<?php
namespace Plexo\Sdk;

class ClientSignedResponse extends SignedMessage
{
    public function toArray($canonize = false)
    {
        $arr = [
            'Object' => [
                'Fingerprint' => strtoupper($this->fingerprint),
                'UTCUnixTimeExpiration' => $this->utcUnixTimeExpiration,
            ],
            'Signature' => $this->signature,
        ];
        if ($this->object) {
            if ($this->object instanceof Exception\PlexoException) {
                $arr['Object']['Object'] = [
                    'ResultCode' => $this->object->getCode(),
                    'ErrorMessage' => $this->object->getMessage(),
                ];
            } else {
                $object = is_array($this->object) ? $this->object : $this->object->toArray($canonize);
                $arr['Object']['Object'] = Utilities\functions\array_filter_recursive($object, $canonize);
            }
        }
        if ($this->client) {
            $arr['Object']['Object']['Client'] = $this->client;
        }
        return $arr;
    }
}
