<?php
namespace Plexo\Sdk\Message;

use Plexo\Sdk;

class DeleteInstrumentRequest extends Sdk\Message // Reference
{
    /**
     *
     * @var string
     */
    public $client;

    /**
     * @var string $InstrumentToken
     * @var string $MetaReference
     * @var int $Type One of the AuthorizationType constants
     */
    protected $data = [
        'InstrumentToken' => null,
        'MetaReference' => null,
        'Type' => null,
    ];

    public function toArray($canonize = false)
    {
        $arr = $this->to_array();
//        $data = [
//            'Client' => $this->client,
//            'Request' => $arr,
//        ];
        return $arr;
    }
}
