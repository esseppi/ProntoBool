<?php


namespace App\Http\Controllers\Api\Orders;

use Braintree\Gateway;
use Illuminate\Http\Request;
use App\Models\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Professionist\Profile;
use App\Models\Professionist\Sponsorship;
use App\Http\Requests\Orders\OrderRequest;

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

        $product = Sponsorship::find($request->product);

        $result = $gateway->transaction()->sale([
            'amount' => $product->price,
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
            $endDate = date_add(now(), date_interval_create_from_date_string($product->duration));
            Profile::find(Auth::user()->id)->sponsorships()->attach($product->id, ['startDate' => now(), 'endDate' => $endDate, 'isActive' => 1]);
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
