<?php
namespace Plexo\Sdk\Models;

class TransactionOrder extends ModelsBase
{
    const TRANSACTION_FIELD_CREATION_DATE          =  0;
    const TRANSACTION_FIELD_TRANSACTION_STATE      =  1;
    const TRANSACTION_FIELD_PURCHASE_STATUS        =  2;
    const TRANSACTION_FIELD_CANCEL_STATUS          =  3;
    const TRANSACTION_FIELD_RESERVE_STATUS         =  4;
    const TRANSACTION_FIELD_TRANSACTION_ID         =  5;
    const TRANSACTION_FIELD_ISSUER_ID              =  6;
    const TRANSACTION_FIELD_BANK_ID                =  7;
    const TRANSACTION_FIELD_COMMERCE_ID            =  8;
    const TRANSACTION_FIELD_PURCHASE_EXTERNAL_ID   =  9;
    const TRANSACTION_FIELD_CANCEL_EXTERNAL_ID     = 10;
    const TRANSACTION_FIELD_RESERVE_EXTERNAL_ID    = 11;
    const TRANSACTION_FIELD_PURCHASE_AUTHORIZATION = 12;
    const TRANSACTION_FIELD_CANCEL_AUTHORIZATION   = 13;
    const TRANSACTION_FIELD_RESERVE_AUTHORIZATION  = 14;
    const TRANSACTION_FIELD_PURCHASE_METADATA      = 15;
    const TRANSACTION_FIELD_CANCEL_METADATA        = 16;
    const TRANSACTION_FIELD_RESERVE_METADATA       = 17;
    const TRANSACTION_FIELD_METADATA               = 18;
        
    const TRANSACTION_ORDER_DIRECTION_ASC  = 0;
    const TRANSACTION_ORDER_DIRECTION_DESC = 1;

    /**
     *
     * @var int
     */
    public $Field = self::TRANSACTION_FIELD_CREATION_DATE;

    /**
     *
     * @var int
     */
    public $Direction = self::TRANSACTION_ORDER_DIRECTION_ASC;

    /**
     * 
     * @param int $field
     * @param int $direction
     */
    public function __construct($field = self::TRANSACTION_FIELD_CREATION_DATE, $direction = self::TRANSACTION_ORDER_DIRECTION_ASC)
    {
        $this->Field = $field;
        $this->Direction = $direction;
    }

    public static function fromArray(array $array)
    {
        $inst = new self();
        foreach ($array as $k => $v) {
            $inst->{$k} = $v;
        }
        return $inst;
    }

    public function toArray($canonize = false)
    {
        return [
            'Direction' => $this->Direction,
            'Field' => $this->Field,
        ];
    }
}
