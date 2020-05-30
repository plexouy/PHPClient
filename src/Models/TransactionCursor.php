<?php
namespace Plexo\Sdk\Models;

class TransactionCursor extends ModelsBase
{
    /**
     *
     * @var int
     */
    public $Start;

    /**
     *
     * @var int
     */
    public $TotalCount;

    /**
     *
     * @var array List<Transaction>
     */
    public $Transactions;

    /**
     * 
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->Start = $data['Start'];
        $this->TotalCount = $data['TotalCount'];
        $this->Transactions = array_map(function ($item) {
            return new Transaction($item);
        }, $data['Transactions']);
    }
}
