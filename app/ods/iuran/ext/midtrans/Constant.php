<?php


namespace App\Ods\Iuran\Ext\Midtrans;


abstract class Constant
{
    public const IDENTIFIER = 'iuran';
    public const DELIMITER = '/;:';

    public const MIDTRANS_SANDBOX_BASE_URL = 'https://app.sandbox.midtrans.com';
    public const MIDTRANS_PRODUCTION_BASE_URL = 'https://api.midtrans.com';
}
