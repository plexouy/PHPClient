<?php
namespace Plexo\Sdk\Models;

class Transaction extends ModelsBase
{
    /**
     *
     * @var string 
     */
    public $TransactionId;

    /**
     *
     * @var Commerce
     */
    public $Commerce;

    /**
     *
     * @var string
     */
    public $InstrumentToken;

    /**
     *
     * @var string
     */
    public $InstrumentName;

    /**
     *
     * @var IssuerInfo
     */
    public $Issuer;

    /**
     *
     * @var float
     */
    public $Amount;

    /**
     *
     * @var int
     */
    public $Installments;

    /**
     *
     * @var Currency
     */
    public $Currency;

    /**
     *
     * @var bool
     */
    public $IsAnonymous;

    /**
     *
     * @var TransactionType
     */
    public $CurrentState;

    /**
     *
     * @var string
     */
    public $InvoiceNumber;

    /**
     *
     * @var FinancialInclusionResult
     */
    public $FinancialInclusion;

    /**
     *
     * @var Dictionary<TransactionType, TransactionInfo>
     */
    public $Transactions;

    /**
     *
     * @var Dictionary<FieldType, string>
     */
    public $FieldInformation;

    public function __construct($data = null)
    {
        $this->TransactionId = $data['TransactionId'];
        $this->Commerce = new Commerce($data['Commerce']);
        $this->InstrumentToken = $data['InstrumentToken'];
        $this->InstrumentName = $data['InstrumentName'];
        $this->Issuer = new IssuerInfo($data['Issuer']);
        $this->Amount = $data['Amount'];
        $this->Installments = $data['Installments'];
        $this->Currency = new Currency($data['Currency']);
        $this->IsAnonymous = $data['IsAnonymous'];
        $this->CurrentState = $data['CurrentState'];
//        $this->CurrentState = new TransactionType($data['CurrentState']);
        $this->InvoiceNumber = $data['InvoiceNumber'];
        $this->FinancialInclusion = new FinancialInclusionResult($data['FinancialInclusion']);
        $this->Transactions = $data['Transactions'];
        $this->FieldInformation = $data['FieldInformation'];
    }
}
