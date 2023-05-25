<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ferdous\OtpValidator\Object\OtpRequestObject;
use Ferdous\OtpValidator\Object\OtpValidateRequestObject;
use Ferdous\OtpValidator\OtpValidator;
class OtpController extends Controller
{ 
    /**
    * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    */
    public function confirmationPage()
    {
        return view('product.checkout-page');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function requestForOtp(Request $request)
    {
        $client_req = '007';
        $number=$request->input('number');
        $purchase_type=$request->input('purchase_type');
        $email=$request->input('email');

        $otp_req = OtpValidator::requestOtp(
            new OtpRequestObject($client_req, $purchase_type, $number, $email)
        );

        if($otp_req['code'] === 201){
            return view('product.otp-page')->with($otp_req);
        }else{
            dd($otp_req);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function validateOtp(Request $request)
    {
        $uniqId = $request->input('uniqueId');
        $otp = $request->input('otp');
        $data['resp'] = [
            200 => 'Order Confirmed !!!',
            204 => 'Too Many Try, are you human !!!',
            203 => 'Invalid OTP given',
            404 => 'Request not found'
        ];
        $data['validate'] =  OtpValidator::validateOtp(
            new OtpValidateRequestObject($uniqId,$otp)
        );

        if($data['validate']['code'] === 200){
            //TODO: OTP is correct and with return the transaction ID, proceed with next step
        }

        return view('product.otp-success-fail-page')->with($data);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resendOtp(Request $request)
    {
        $uniqueId = $request->input('uniqueId');
        $otp_req = OtpValidator::resendOtp($uniqueId);

        if(isset($otp_req['code']) && $otp_req['code'] === 201){
            return view('product.otp-page')->with($otp_req);
        }else{
            dd($otp_req);
        }
    }
}
