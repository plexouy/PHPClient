<?php
namespace Plexo\Sdk\Message;

use Plexo\Sdk;

class IssuerData extends Sdk\Message
{
    /**
     *
     * @var string
     */
    public $client;
    
    /**
     * @var int $CommerceId
     * @var int $IssuerId
     * @var array $Metadata
     */

    protected $data = [
        'CommerceId' => null,
        'IssuerId' => null,
        'Metadata' => null,
    ];

    public function __construct($data = null)
    {
        if (!array_key_exists('CommerceId', $data) || !is_numeric($data['CommerceId'])) {
            throw new \Plexo\Sdk\Exception\InvalidArgumentException('CommerceId debe ser un valor numérico.');
        }
        if (!array_key_exists('IssuerId', $data) || !is_numeric($data['IssuerId'])) {
            throw new \Plexo\Sdk\Exception\InvalidArgumentException('IssuerId debe ser un valor numérico.');
        }
        $this->data['CommerceId'] = (int) $data['CommerceId'];
        $this->data['IssuerId'] = (int) $data['IssuerId'];
        if (!array_key_exists('Metadata', $data) || !is_array($data['Metadata'])) {
            $this->data['Metadata'] = $data['Metadata'];
        }
    }

    public function toArray($canonize = false)
    {
        $arr = array_filter($this->to_array());
//        $data = [
//            'Client' => $this->client,
//            'Request' => $arr,
//        ];
        return $arr;
    }
}
