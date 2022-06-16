<?php


namespace App\Http\Controllers\Api\Orders;

use Braintree\Gateway;
use Illuminate\Http\Request;
use App\Models\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;
use App\Models\Professionist\Sponsorship;

class OrderController extends Controller
{
    public function generate(Request $request, Gateway $gateway)
    {
        $token = $gateway->clientToken()->generate();

        $data = [
            'success' => true,
            'token' => $token
        ];

        return response()->json($data, 200);
    }

    public function makePayment(OrderRequest $request, Gateway $gateway)
    {

        $product = Sponsorship::find(1);

        $result = $gateway->transaction()->sale([
            'amount' => '10.00',
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $data = [
                'success' => true,
                'message' => "Transazione eseguita con Successo!"
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'success' => false,
                'message' => "Transazione Fallita!!"
            ];
            return response()->json($data, 401);
        }
    }
}
