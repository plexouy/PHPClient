<?php
namespace Plexo\Sdk\Models;

class Query
{
    const QUERY_OPERATION_AND  = 0;
    const QUERY_OPERATION_OR   = 1;
    const QUERY_OPERATION_NONE = 2;

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
    const TRANSACTION_FIELD_CACCEL_METADATA        = 16;
    const TRANSACTION_FIELD_RESERVE_METADATA       = 17;
    const TRANSACTION_FIELD_METADATA               = 18;

    const TRANSACTION_OPERATOR_EQUAL                 = 0;
    const TRANSACTION_OPERATOR_NOT_EQUAL             = 1;
    const TRANSACTION_OPERATOR_BIGGER_THAN           = 2;
    const TRANSACTION_OPERATOR_BIGGER_OR_EQUAL_THAN  = 3;
    const TRANSACTION_OPERATOR_SMALLER_THAN          = 4;
    const TRANSACTION_OPERATOR_SMALLER_OR_EQUAL_THAN = 5;
    const TRANSACTION_OPERATOR_CONTAINS              = 6;
    const TRANSACTION_OPERATOR_NOT_CONTAINS          = 7;

    /**
     * @var int
     */
    public $QueryOperator = self::QUERY_OPERATION_AND;

    /**
     * @var int
     */
    public $Field = self::TRANSACTION_FIELD_CREATION_DATE;

    /**
     * @var int
     */
    public $Operator = self::TRANSACTION_OPERATOR_EQUAL;

    /**
     *
     * @var string
     */
    public $Value;

    /**
     *
     * @var array List<Query>
     */
    public $SubQueries = [];

    public function __construct($query_operator = null, $field = null, $operator = null, $value = null, $sub_queries = null) {
        $this->QueryOperator = $query_operator;
        $this->Field = $field;
        $this->Operator = $operator;
        $this->Value = $value;
        if ($sub_queries) {
            $this->SubQueries = $sub_queries;
        }
    }

    public function addSubQuery($query)
    {
        array_push($this->SubQueries, ($query instanceof Query ? $query : Query::fromArray($query)));
        return $this;
    }

    public function setSubQueries($value)
    {
        $this->SubQueries = [];
        foreach ($value as $query) {
            $this->addSubQuery($query);
        }
        return $this;
    }

    public static function fromArray(array $array)
    {
        $inst = new self();
        foreach ($array as $k => $v) {
            $method_name = 'set'.$k;
            if (method_exists($inst, $method_name)) {
                call_user_func([$inst, $method_name], $v);
            } else {
                $inst->{$k} = $v;
            }
        }
        return $inst;
    }

    public function toArray() {
        return [
            'Field' => $this->Field,
            'Operator' => $this->Operator,
            'QueryOperator' => $this->QueryOperator,
            'SubQueries' => array_map(function ($query) {
                return $query->toArray();
            }, $this->SubQueries),
            'Value' => $this->Value,
        ];
    }
}
