<?php
namespace Plexo\Sdk\Type;

class FieldType {
    // User Generic Information
    const EXPIRATION                   = 0x101;
    const NAME                         = 0x102;
    const ADDRESS                      = 0x103;
    const ZIP_CODE                     = 0x104;
    const EMAIL                        = 0x105;
    const PHONE                        = 0x106;
    const CELLPHONE                    = 0x107;
    const AMOUNT_LIMIT_EXTENSION       = 0x108;
    const BIRTHDATE                    = 0x109;
    const INSTRUMENT_NAME              = 0x10A;
    const IDENTIFICATION               = 0x10B;
    const IDENTIFICATION_TYPE          = 0x10C;
    const IDENTIFICATION_TYPE_EXTENDED = 0x10D;// 0 - CI , 1 - Pasaporte, 3 Otros, 4 RUT
    const ACCOUNT_NUMBER               = 0x10E;// Bank Account Number
    const FIRST_NAME                   = 0x10F;
    const LAST_NAME                    = 0x110;
    const CITY                         = 0x111;

    // New OptionalFields
    const COUNTRY               = 0x0201;
    const SHIPPING_ADDRESS      = 0x0202;
    const SHIPPING_ZIP_CODE     = 0x0203;
    const SHIPPING_CITY         = 0x0204;
    const SHIPPING_COUNTRY      = 0x0205;
    const PROMOTIONAL_CODE      = 0x0206;
    const COMMERCE_REFERENCE_ID = 0x0207;
    const TRANSACTION_DATE_TIME = 0x0208;
    const DEFERRED_MONTHS       = 0x0209;
    const PLAN                  = 0x020A;

    // Provider Related Information starts at 0x400
    const PROVIDER                     = 0x401;// Example Visa

    // User/Provider Related Information starts at 0x500. User Flag | Provider Flag
    const SISTARBANK_PAYMENT_METHOD    = 0x501;
    const REDPAGOS_PRODUCT_NUMBER      = 0x502;
    const REDPAGOS_USER_ENABLED        = 0x503;
    const VISA_NET_USER_ID               = 0x504;
    const CARD_TYPE                      = 0x505;
    const CARD_ISSUER                    = 0x506;
    const CYBERSOURCE_DEVICE_FINGERPRINT = 0x507;
    const CLIENT_IP                      = 0x508;
    const INTEGER_ID                     = 0x509;

    // Commerce Related Information starts at 0x800
    const PROVIDER_COMMERCE_NUMBER     = 0x801;// This Could be the commerce id (Master/Oca/Visa/Etc)
    const OCA_TAXI_CODE                = 0x802;
    const TERMINAL_NUMBER              = 0x803;
    const POS_NUMBER                   = 0x804;
    const PROVIDER_MERCHANT_ID                   = 0x805;
    const PROVIDER_BRANCH_NUMBER                 = 0x806;
    const COMMERCE_RESERVE_EXPIRATION_IN_SECONDS = 0x807;

    // Secure Information Starts at 0x8100. Private Flag | User Flag
    // Secure User Generic Information
    const PAN                          = 0x8101;
    const TOKEN                        = 0x8102;
    const UNIQUE_ID                    = 0x8103;

    // Non Storable Secure Information 0x80;
    const PIN                          = 0x8181;
    const CVC                          = 0x8182;

    const IDENTIFICATION_TYPE_CI       = '0';
    const IDENTIFICATION_TYPE_PASSPORT = '1';
    const IDENTIFICATION_TYPE_OTHER    = '3';
    const IDENTIFICATION_TYPE_RUT      = '4';

    private static $keys = [
        0x101 => 'Expiration',
        'Name',
        'Address',
        'ZipCode',
        'Email',
        'Phone',
        'Cellphone',
        'AmountLimitExtension',
        'Birthdate',
        'InstrumentName',
        'Identification',
        'IdentificationType',
        'IdentificationTypeExtended',
        'AccountNumber',
        'FirstName',
        'LastName',
        'City',
        0x401 => 'Provider',
        0x501 => 'SistarBancPaymentMethod',
        'RedPagosProductNumber',
        'RedPagosUserEnabled',
        'VisaNetUserId',
        'CardType',
        'CardIssuer',
        'CybersourceDeviceFingerprint',
        'ClientIP',
        'IntegerId',
        0x801 => 'ProviderCommerceNumber',
        'OcaTaxiCode',
        'TerminalNumber',
        'PosNumber',
        'ProviderMerchantId',
        'ProviderBranchNumber',
        'CommerceReserveExpirationInSeconds',
        0x8101 => 'Pan',
        'Token',
        'UniqueId',
        0x8181 => 'Pin',
        'CVC',
    ];

    private $param;
    private $value;

    public function __construct($param, $value)
    {
        $this->param = is_string($param) ? self::nameToKey($param) : $param;
        $this->value = $value;
    }

    /**
     *
     * @return int
     */
    public function getParam()
    {
        return $this->param;
    }

    /**
     * @deprecated since version 0.3.4
     * @return string
     * @throws \Plexo\Sdk\Exception\InvalidArgumentException
     */
    public function getParamKey()
    {
        if (!array_key_exists($this->param, self::$keys)) {
            throw new \Plexo\Sdk\Exception\InvalidArgumentException();
        }
        return self::$keys[$this->param];
    }

    /**
     *
     * @return string
     * @throws \Plexo\Sdk\Exception\InvalidArgumentException
     */
    public function getParamName()
    {
        if (!array_key_exists($this->param, self::$keys)) {
            throw new \Plexo\Sdk\Exception\InvalidArgumentException();
        }
        return self::$keys[$this->param];
    }

    public static function nameToKey($param)
    {
        return array_search($param, self::$keys);
    }

    public function getValue()
    {
        return $this->value;
    }
}
