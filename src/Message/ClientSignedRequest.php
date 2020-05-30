<?php
namespace Plexo\Sdk\Message;

use Plexo\Sdk;

class ClientSignedRequest extends Sdk\Message
{
    /**
     *
     * @var string
     */
    public $client;
    
    /**
     * @var int $Action              Action type defined in Sdk\ActionType
     * @var int $Type                Authorization type defined in Sdk\Type\AuthorizationType 
     * @var string $MetaReference 
     * @var string $RedirectUri
     * @var string $OptionalMetadata (Optional) 
     * @var array $ClientInformation (Optional) Sdk\Type\FieldType's list
     * @var array <string> $LimitIssuers  (Optional) 
     * @var Dictionary<string, string> $PromotionInfoIssuers (Optional)  
     * @var string $ExtendableInstrumentToken (Optional) 
     */

    protected $data = [
        'Action' => null,
        'ClientInformation' => null,
        'DoNotUseCallback' => false,
        'ExtendableInstrumentToken' => null,
        'LimitIssuers' => null,
        'MetaReference' => null,
        'OptionalMetadata' => null,
        'PromotionInfoIssuers' => null,
        'RedirectUri' => null,
        'Type' => null,
    ];

//    /**
//     *
//     * @var int Action type defined in Sdk\ActionType
//     */
//    public $Action;
//    
//    /**
//     *
//     * @var int Authorization type defined in Sdk\Type\AuthorizationType 
//     */
//    public $Type;
//    
//    /**
//     *
//     * @var string 
//     */
//    public $MetaReference;
//
//    /**
//     *
//     * @var string 
//     */
//    public $RedirectUri;
//    
//    /**
//     *
//     * @var string (Optional) 
//     */
//    public $OptionalMetadata;
//
//    /**
//     *
//     * @var array <string, object> (Optional) 
//     */
//    public $ClientInformation;
//
//    /**
//     *
//     * @var array <string> (Optional) 
//     */
//    public $LimitIssuers;
//
//    /**
//     *
//     * @var Dictionary<string, string> (Optional)  
//     */
//    public $PromotionInfoIssuers;
//
//    /**
//     *
//     * @var string (Optional) 
//     */
//    public $ExtendableInstrumentToken;
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('Action', new Assert\Range(array(
            'min' => 1,
        )));
//        $metadata->addPropertyConstraint('Action', new Assert\NotBlank());
//        $metadata->addPropertyConstraint('name', new Assert\Length(array(
//            'min' => 5,
//            'max' => 20,
//        )));
        $metadata->addPropertyConstraint('RedirectUri', new Assert\Url());
    }
    
    public static function getValidationMetadata()
    {
        return [
            'Action' => [
                'type' => 'int',
                'required' => true,
            ],
            'Type' => [
                'type' => 'int',
                'required' => true,
            ],
            'MetaReference' => [
                'type' => 'string',
                'required' => true,
            ],
           'RedirectUri' => [
                'type' => 'string',
                'required' => true,
           ],
            'OptionalMetadata' => [
                'type' => 'string',
                'required' => false,
            ],
            'ClientInformation' => [
                'type' => 'array',
                'required' => false,
            ],
            'DoNotUseCallback' => [
                'type' => 'bool',
                'required' => false,
            ],
            'LimitIssuers' => [
                'type' => 'array',
                'required' => false,
            ],
            'PromotionInfoIssuers' => [
                'type' => 'array',
                'required' => false,
            ],
            'ExtendableInstrumentToken' => [
                'type' => 'string',
                'required' => false,
            ],
        ];
    }
    
//    public function validate()
//    {
//        $scheme = self::getValidationMetadata();
////        parent::validate();
//    }
    
    public function toArray($canonize = false)
    {
//        $scheme = self::getValidationMetadata();
        $arr = $this->to_array();
        if (is_array($arr['ClientInformation'])) {
            $clientInformation = array();
            foreach ($arr['ClientInformation'] AS $v) {
                $k = $canonize ? $v->getParamKey() : $v->getParam();
                $clientInformation[$k] = (string) $v->getValue();
            }
            $arr['ClientInformation'] = $clientInformation;
        }
        $data = [
            'Client' => $this->client,
            'Request' => $arr,
        ];
        return $data;
    }
}
