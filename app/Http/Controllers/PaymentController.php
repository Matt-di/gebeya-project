<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function update(Payment $payment, Request $request){
        $payment->update(['status'=>$request->status]);
    }
}
