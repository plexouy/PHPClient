<?php
namespace Plexo\Sdk;

interface SecurePaymentGatewayInterface
{
    public function Authorize($auth);

    public function Purchase($payment);

    public function Cancel($payment);

    public function StartReserve($payment);

    public function EndReserve($reserve);

    public function Status($payment);

    public function GetInstruments($info);

    public function DeleteInstrument($info);

    public function CreateBankInstrument($request);

    public function GetSupportedIssuers();

    public function GetCommerces();

    public function AddCommerce($commerce);

    public function ModifyCommerce($commerce);

    public function DeleteCommerce($commerce);

    public function SetDefaultCommerce($commerce);

    public function GetCommerceIssuers($commerce);

    public function AddIssuerCommerce($commerce);

    public function DeleteIssuerCommerce($commerce);

    public function ObtainTransactions($query);

    public function ObtainCSVTransactions($query);

    public function GetServerPublicKey($fingerprint);

    public function CodeAction($request);
}
