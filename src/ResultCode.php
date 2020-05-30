<?php
namespace Plexo\Sdk;

abstract class ResultCode
{
    const OK                                                   =  0;
    const ARGUMENT_ERROR                                       =  1;
    const INVALID_SESSION                                      =  2;
    const SESSION_EXPIRED                                      =  3;
    const TOKEN_EXPIRED                                        =  4;
    const MISSING_PAYMENT_INSTRUMENT                           =  5;
    const DUPLICATE_TRANSACTION                                =  6;
    const SYSTEM_ERROR                                         =  7;
    const CLIENT_SERVER_ERROR                                  =  8;
    const DISABLED_CARD                                        =  9;
    const EXPIRED_CARD                                         = 10;
    const NOT_FOUND                                            = 11;
    const INVALID_FINGERPRINT                                  = 12;
    const INVALID_SIGNATURE                                    = 13;
    const MESSAGE_EXPIRED                                      = 14;
    const INVALID_PAYMENT_INSTRUMENT                           = 15;
    const CURRENCY_NOT_SUPPORTED_BY_INSTRUMENT                 = 16;
    const ISSUER_NOT_ASSOCIATED_WITH_CLIENT_OR_ISSUER_INACTIVE = 17;
    const INVALID_CURRENCY                                     = 18;
    const INVALID_CARD                                         = 19;
    const EXTERNAL_LIMITED_CARD                                = 20;
    const FORBIDDEN                                            = 21;
    const INVALID_VERIFICATION                                 = 22;
    const REQUIRES_SESSION_EXTENDED_AMOUNT                     = 23;
    const REQUIRES_CLIENT_EXTENDED_AMOUNT                      = 24;
    const ALREADY_EXISTS                                       = 25;
    const MISSING_FIELDS                                       = 26;
    const CODE_EXPIRED                                         = 27;
}
