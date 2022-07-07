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
