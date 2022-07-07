<?php

namespace App\Http\Controllers;

use App\Models\PaymentTransaction;
use Illuminate\Http\Request;
use App\Service\MyFathoorahService;
use App\Traits\GeneralTrait;

class MyFatoorahController extends Controller
{
    use GeneralTrait;
    private $fathoorahService;
    public function __construct(MyFathoorahService $myFathoorahService)
    {
        $this->fathoorahService = $myFathoorahService;
    }
    public function pay()
    {

        // $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        $paymentData = [
            'NotificationOption' => 'ALL', //'SMS', 'EML', or 'ALL'
            'InvoiceValue'       => '50',
            'CustomerName'       => 'eslllaaaam',
            'DisplayCurrencyIso' => 'KWD',
            // 'MobileCountryCode'  => '+20',
            'CustomerMobile'     => '01210732005',
            'CustomerEmail'      => 'solombana2000@gmail.com',
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
            'user_id' => 25
        ]);
        return $pay_data;
    }


    public function successPay(Request $request)
    {
        $data = [];
        $data['key'] = $request->paymentId;
        $data['keyType'] = 'paymentId';
        $check_status =  $this->fathoorahService->getPaymentStatus($data);
        if (!$check_status) {
            return $this->returnError('206', 'fail');
        }
        return $this->returnSuccessMessage('success');
    }

    public function errorPay()
    {
        return $this->returnError('205', 'fail');
    }
}
