<?php
namespace Plexo\Sdk\Type;

class TransactionField
{
    const CREATION_DATE          =  0;
    const TRANSACTION_STATE      =  1;
    const PURCHASE_STATUS        =  2;
    const CANCEL_STATUS          =  3;
    const RESERVE_STATUS         =  4;
    const TRANSACTION_ID         =  5;
    const ISSUER_ID              =  6;
    const BANK_ID                =  7;
    const COMMERCE_ID            =  8;
    const PURCHASE_EXTERNAL_ID   =  9;
    const CANCEL_EXTERNAL_ID     = 10;
    const RESERVE_EXTERNAL_ID    = 11;
    const PURCHASE_AUTHORIZATION = 12;
    const CANCEL_AUTHORIZATION   = 13;
    const RESERVE_AUTHORIZATION  = 14;
    const PURCHASE_METADATA      = 15;
    const CANCEL_METADATA        = 16;
    const RESERVE_METADATA       = 17;
    const METADATA               = 18;

    private static $keys = [
        'CreationDate',
        'TransactionState',
        'PurchaseStatus',
        'CancelStatus',
        'ReserveStatus',
        'TransactionId',
        'IssuerId',
        'BankId',
        'CommerceId',
        'PurchaseExternalId',
        'CancelExternalId',
        'ReserveExternalId',
        'PurchaseAuthorization',
        'CancelAuthorization',
        'ReserveAuthorization',
        'PurchaseMetadata',
        'CancelMetadata',
        'ReserveMetadata',
        'Metadata',
    ];

    private $param;
    private $value;

    public function __construct($param, $value)
    {
        $this->param = $param;
        $this->value = $value;
    }

    public function getParam()
    {
        return $this->param;
    }

    public function getParamKey()
    {
        if (!array_key_exists($this->param, self::$keys)) {
            throw new \Plexo\Sdk\Exception\InvalidArgumentException();
        }
        return self::$keys[$this->param];
    }

    public function getValue()
    {
        return $this->value;
    }
}
