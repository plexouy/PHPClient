<?php
namespace Plexo\Sdk\Message;

use Plexo\Sdk;

class Commerce extends Sdk\Message
{
    /**
     * @var int $CommerceId
     * @var string $Name
     */

    protected $data = [
        'CommerceId' => null,
        'Name' => null,
    ];

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
