<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\PaymentTransaction;
use App\Service\MyFathoorahService;
use App\Traits\GeneralTrait;
trait PaymentTrait
{
    use GeneralTrait;
    private $fathoorahService;
    public function __construct(MyFathoorahService $myFathoorahService)
    {
        $this->fathoorahService = $myFathoorahService;
    }
    public function pay($value)
    {
        $paymentData = [
            'NotificationOption' => 'EML', //'SMS', 'EML', or 'ALL'
            'InvoiceValue'       => $value,
            'CustomerName'       => Auth()->user()->name,
            'DisplayCurrencyIso' => 'KWD',
            // 'MobileCountryCode'  => '+20',
            // 'CustomerMobile'     => '01210732005',
            'CustomerEmail'      => Auth()->user()->email,
            'CallBackUrl'        => 'http://127.0.0.1:8000/api/success-pay',
            'ErrorUrl'           => 'http://127.0.0.1:8000/api/error-pay',
            //'Language'           => 'en', //or 'ar'
            //'CustomerReference'  => 'orderId',
            //'CustomerCivilId'    => 'CivilId',
            //'UserDefinedField'   => 'This could be string, number, or array',
            //'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
            //'SourceInfo'         => 'Pure PHP', //For example: (Laravel/Yii API Ver2.0 integration)
            //'CustomerAddress'    => $customerAddress,
            //'InvoiceItems'       => $invoiceItems,
        ];
        $pay_data =  $this->fathoorahService->sendPayment($paymentData);
        PaymentTransaction::create([
            'invoice_id' => $pay_data['Data']['InvoiceId'],
            'user_id' => Auth()->user()->id,
            'value' => $value
        ]);
        return $pay_data;
    }
}
