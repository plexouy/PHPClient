<?php
namespace Plexo\Sdk\Models;

class Item extends ModelsBase// implements PlexoModelInterface
{
    /**
     * @var float $Amount
     * @var string $ClientItemReferenceId
     * @var array List<InfoLine> $InfoLines
     * @var string $MetaData
     * @var array List<string> $Tags
     */
    protected $data = [
        'Amount' => null,
        'ClientItemReferenceId' => null,
        'InfoLines' => [],
        'MetaData' => null,
        'Tags' => null,
    ];

    /**
     * 
     * @param array $params
     */
    public function __construct(array $params = []) {
        foreach ($params as $k => $v) {
            $this->data[$k] = $v;
        }
    }

    public static function getValidationMetadata()
    {
        return [
            'Amount' => [
                'type' => 'float',
                'required' => true,
            ],
            'ClientItemReferenceId' => [
                'type' => 'string',
                'required' => false,
            ],
            'InfoLines' => [
                'type' => 'array',
                'required' => false,
            ],
            'MetaData' => [
                'type' => 'string',
                'required' => false,
            ],
            'Tags' => [
                'type' => 'array',
                'required' => false,
            ],
        ];
    }

    public function addInfoLine($infoLine)
    {
        array_push($this->data['InfoLines'], ($infoLine instanceof InfoLine ? $infoLine : InfoLine::fromArray($infoLine)));
        return $this;
    }

    public function setInfoLines(array $infoLines)
    {
        $this->data['InfoLines'] = [];
        foreach ($infoLines as $infoLine) {
            $this->addInfoLine($infoLine);
        }
        return $this;
    }

    public function toArray($canonize = false)
    {
        return [
            'Amount'                => is_null($this->Amount) ? null : ($canonize ? sprintf('float(%s)', (float) $this->Amount) : (float) $this->Amount),
            'ClientItemReferenceId' => $this->ClientItemReferenceId,
            'InfoLines'             => count($this->data['InfoLines'])
                ? array_map(function ($infoLine) use ($canonize) {
                    return ($infoLine instanceof InfoLine) ? $infoLine->toArray($canonize) : $infoLine;
                }, $this->data['InfoLines'])
                : null,
            'MetaData'              => $this->MetaData,
            'Tags'                  => $this->Tags,
        ];
    }
}
