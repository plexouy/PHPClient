<?php
namespace Plexo\Sdk\Message;

use Plexo\Sdk;

class Reference extends Sdk\Message {

    /**
     *
     * @var string $MetaReference;
     * @var ReferenceType $Type;
     */
    protected $data = [
        'MetaReference' => null,
        'Type' => null,
    ];

    public function toArray($canonize = false)
    {
        $arr = $this->to_array();
        $data = [
            'Client' => $this->client,
            'Request' => $arr,
        ];
        return $data;
    }
	
	public static function getValidationMetadata()
    {
        return [
            'Type' => [
                'type' => 'int',
                'required' => false,
            ],
            'MetaReference' => [
                'type' => 'string',
                'required' => false,
            ],
        ];
    }
}
