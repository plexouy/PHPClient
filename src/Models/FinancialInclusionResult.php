<?php
namespace Plexo\Sdk\Models;

class FinancialInclusionResult
{
    /**
     *
     * @var bool
     */
    public $IsApplied;

    /**
     *
     * @var float
     */
    public $ReturnAmount;

    /**
     *
     * @var int Plexo\Sdk\Type\InclusionType::*
     */
    public $LawNumber;
}
