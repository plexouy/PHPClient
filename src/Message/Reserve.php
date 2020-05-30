<?php
namespace Plexo\Sdk\Message;

use Plexo\Sdk;

class Reserve extends Sdk\Message // Reference
{
    /**
     * @var bool $Commit
     * @var ReferenceType $Type
     * @var string $MetaReference
     */
    
    protected $data = [
        'Commit' => null,
        'MetaReference' => null,
        'Type' => 0,
    ];

    public function toArray($canonize = false)
    {
//        $arr = $this->to_array();
        $arr = $canonize
            ? [
                'Commit' => $this->Commit,
                'MetaReference' => $this->MetaReference,
                'Type' => $this->Type,
            ]
            : [
                'Commit' => $this->Commit,
                'MetaReference' => $this->MetaReference,
                'Type' => $this->Type,
            ];
//        $data = [
//            'Client' => $this->client,
//            'Request' => $arr,
//        ];
        return $arr;
    }
}
