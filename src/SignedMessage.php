<?php
namespace Plexo\Sdk;

class SignedMessage
{
    protected $auth_param = 'Client';
    protected $client;
    protected $fingerprint;
    protected $object;
    protected $utcUnixTimeExpiration;
    protected $signature;

    /**
     *
     * @param (Message|string) $message
     */
    public function __construct($message = null, $fingerprint = null, $utcUnixTimeExpiration = null, $signature = null)
    {
        // if (is_string($message)) {
        //     $this->createFromString($message);
        // }
        $this->object = $message;
        $this->fingerprint = $fingerprint;
        $this->utcUnixTimeExpiration = $utcUnixTimeExpiration;
        $this->signature = $signature;
    }

    public function __set($name, $value)
    {
        $method_name = 'set' . ucfirst($name);
        if (method_exists($this, $method_name)) {
            call_user_func([$this, $method_name], $value);
        }
    }

    public function setClient($client) {
        $this->client = $client;
    }

    public function setExpirationTime($expirationTime)
    {
        $this->utcUnixTimeExpiration = $expirationTime;
    }

    /**
     *
     * @param string $json
     * @return \self
     */
    public static function fromJson($json)
    {
        $json = str_replace('{}', '{"__sdkEmptyMap":1}', $json);
        $signed_json = json_decode($json, true);
        $signature = $signed_json['Signature'];
        $fingerprint = $signed_json['Object']['Fingerprint'];
        $utcUnixTimeExpiration = $signed_json['Object']['UTCUnixTimeExpiration'];
        $object = array_key_exists('Object', $signed_json['Object']) ? $signed_json['Object']['Object'] : null;
        return new self($object, $fingerprint, $utcUnixTimeExpiration, $signature);
    }

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
            } elseif (is_array($this->object)) {
                $sorted_array = $this->object;
                Utilities\functions\ksortRecursive($sorted_array);
                $arr['Object']['Object'] = $sorted_array;
            } else {
                $object = [
                    $this->auth_param => $this->client,
                    'Request' => $this->object->toArray($canonize),
                ];
                $arr['Object']['Object'] = Utilities\functions\array_filter_recursive($object, $canonize);
            }
        } else {
            $arr['Object']['Object'] = [
                $this->auth_param => $this->client,
            ];
        }
        return $arr;
    }

    public function getMessage()
    {
        return $this->object;
    }

    public function getSignatureBaseString()
    {
        $message = $this->toArray(true);
//        $message['Object'] = Utilities\functions\array_filter_recursive($message['Object']);
        Utilities\functions\ksortRecursive($message['Object']);
        $json = json_encode($message['Object'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $json = preg_replace_callback('/":"float\((\d+)(\.(\d+))?\)"/', function ($matches) {
            return sprintf('":%d.%s', $matches[1], (array_key_exists(3, $matches) ? $matches[3] : 0));
        }, $json);
        $json = str_replace('{"__sdkEmptyMap":1}', '{}', $json);
        return $json;
    }

    /**
     *
     * @param Certificate\Certificate $cert
     * @param int $expirationTime
     * @throws Exception\PlexoException
     */
    public function sign($cert, $expirationTime = null)
    {
        $this->fingerprint = $cert->fingerprint;
        if ($expirationTime || is_null($this->utcUnixTimeExpiration)) {
            $this->setExpirationTime(($expirationTime ? $expirationTime : (time() + 600)));
        }
        $base_string = $this->getSignatureBaseString();
        if (!openssl_sign($base_string, $signature, $cert->pkey, OPENSSL_ALGO_SHA512)) {
            $errstr = openssl_error_string();
            throw new Exception\PlexoException(($errstr ? $errstr : 'No fue posible firmar la petición.'));
        }
        $this->signature = base64_encode($signature);
    }

    public function verify($cert)
    {
        $base_string = $this->getSignatureBaseString();
        return openssl_verify($base_string, base64_decode($this->signature), $cert->cert, OPENSSL_ALGO_SHA512);
    }

    public function isValidExpirationTime()
    {
        return ($this->utcUnixTimeExpiration >= time());
    }

    public function validate()
    {
        if (!$this->isValidExpirationTime()) {
            throw new Exception\ResultCodeException('El mensaje ha expirado', ResultCode::MESSAGE_EXPIRED);
        }
        $cert = null;
        if (Registry::contains('CertificateProvider')) {
            $certificateStore = Registry::get('CertificateProvider');
            $cert = $certificateStore->getByFingerprint($this->fingerprint);
        }
        if (!$cert) {
            $clientConfig = Registry::contains('ClientConfig') ? Registry::get('ClientConfig') : [];
            $client = new Client($clientConfig);
            $response = $client->GetServerPublicKey($this->fingerprint);
            $cert = Certificate\Certificate::fromServerPublicKey($response['Key'], null, $response['Fingerprint']);
        }
        if (!$this->verify($cert)) {
            throw new Exception\SignatureException('Firma inválida ('. openssl_error_string() .')');
        }
    }

    public function __toString()
    {
        return str_replace('\/', '/', json_encode($this->toArray()));
    }
}
