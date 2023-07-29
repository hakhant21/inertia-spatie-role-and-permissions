<?php

namespace App\Http\Controllers\Billings;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hak\GatewayMyanmar\Facades\Gateway;

class CheckoutController extends Controller
{
    public function index()
    {
        $data = Gateway::process([
            'amount' => 10000,
            'description' => 'test payment test',
            'invoice_no' => time(),
            'name' => 'Htet Aung Khant',
            'email' => 'htet@gmail.com'
        ]);

        $session = request()->session()->get('hak_session');

        return redirect()->away($data['webPaymentUrl'])->with('session', $session);
    }
}
