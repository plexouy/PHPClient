<?php
namespace Plexo\Sdk\Models;

class TransactionQuery extends ModelsBase
{
    /**
     * @var array List<Query> $Queries
     * @var array List<TransactionOrder> $Order
     * @var int $Limit
     * @var int $Skip
     */
    protected $data = [
        'Queries' => [],
        'Order' => [],
        'Limit' => 20,
        'Skip' => 0,
    ];

    /**
     * 
     * @param array $data
     */
    public function __construct(array $data = null)
    {
        if ($data) {
            if (array_key_exists('Queries', $data)) {
                $this->data['Queries'] = array_map(function ($item) {
                    return Query::fromArray($item);
                }, $data['Queries']);
            }
            if (array_key_exists('Order', $data)) {
                $this->data['Order'] = array_map(function ($item) {
                    return TransactionOrder::fromArray($item);
                }, $data['Order']);
            }
            if (array_key_exists('Limit', $data)) {
                $this->data['Limit'] = $data['Limit'];
            }
            if (array_key_exists('Skip', $data)) {
                $this->data['Skip'] = $data['Skip'];
            }
        }
    }

    public static function getValidationMetadata()
    {
        return [
            'Queries' => [
                'type' => 'array',
                'required' => false,
            ],
            'Order' => [
                'type' => 'array',
                'required' => false,
            ],
            'Limit' => [
                'type' => 'int',
                'required' => true,
            ],
            'Skip' => [
                'type' => 'int',
                'required' => true,
            ],
        ];
    }

    public function toArray($canonize = false)
    {
        $data = [
            'Limit' => $this->data['Limit'],
            'Order' => array_map(function ($item) {
                return $item->toArray();
            }, $this->data['Order']),
            'Queries' => array_map(function ($item) {
                return $item->toArray();
            }, $this->data['Queries']),
            'Skip' => $this->data['Skip'],
        ];
        return $data;
    }
}
