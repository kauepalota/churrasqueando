<?php

namespace App\Http\Controllers;

use App\Mail\PaymentRequestMail;
use App\Models\Barbecue;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\InvalidArgumentException;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use function MongoDB\BSON\toJSON;

class PaymentController extends Controller
{
    /**
     * @throws InvalidArgumentException
     */
    public function create(Request $request, $id)
    {
        $barbecue = Barbecue::findOrFail($id);

        if ($barbecue->user_id !== Auth::id()) {
            Log::warning('Unauthorized update attempt for barbecue ID ' . $barbecue->id);
            abort(403);
        }

        MercadoPagoConfig::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));

        $request->validate([
            'total_cost' => 'numeric|min:0'
        ]);

        Log::info('Creating payment link for barbecue ID ' . $barbecue->id);

        $barbecue->updateOrFail([
            'total_cost' => $request->input('total_cost'),
            'payment_link_sent' => true
        ]);

        $barbecue->refresh();

        Log::debug('Barbecue data: ' . $barbecue);

        $guests = $barbecue->guests;
        $costPerGuest = doubleval($request->input('total_cost')) / ($guests->count() + 1);

        Log::debug('Cost per guest: ' . $costPerGuest);

        $client = new PreferenceClient();

        foreach ($guests as $guest) {
            $request = $this->createPreferenceRequest(
                $barbecue->id,
                $costPerGuest,
                [
                    'name' => $guest->name,
                    'email' => $guest->email
                ]
            );

            Log::debug('Payment request data: ' . json_encode($request));

            try {
               $preference = $client->create($request);
            } catch (MPApiException $e) {
                Log::error('Error creating payment preference: ' . $e->getMessage());
                Log::error($e->getApiResponse()->getContent());

                return redirect()->route('barbecues.edit', $barbecue->id)->with('error', 'Erro ao criar solicitação de pagamento.');
            }

            Log::info('Payment preference created successfully: ' . $preference->id);

            // Enviar e-mail para o convidado com link de pagamento
            Mail::to($guest->email)->send(new PaymentRequestMail($preference->init_point));
        }

        return redirect()->route('barbecues.edit', $barbecue->id)->with('success', 'Solicitações de pagamento enviadas com sucesso.');
    }

    private function createPreferenceRequest($id, $costPerGuest, $payer): array
    {
        $paymentMethods = [
            "excluded_payment_methods" => [],
            "installments" => 12,
            "default_installments" => 1
        ];

        $backUrls = array(
            'success' => route('payment.success')
        );

        $request = [
            "items" => [
                [
                    'title' => 'Pagamento Churrasco',
                    'quantity' => 1,
                    'unit_price' => $costPerGuest
                ]
            ],
            "payer" => $payer,
            "payment_methods" => $paymentMethods,
            "back_urls" => $backUrls,
            "statement_descriptor" => 'Churrasqueando',
            "external_reference" => $id,
            "expires" => false,
            "auto_return" => 'approved'
        ];

        return $request;
    }

    public function paymentSuccess(Request $request)
    {
        MercadoPagoConfig::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));

        $payment_id = $request->input('payment_id');

        $client = new PaymentClient();
        $payment = $client->get($request->input('payment_id'));

        $status = $payment->status;
        if ($status !== 'approved') {
            Log::error('Payment failed for payment ID ' . $payment_id);
            return redirect()->route('/');
        }
        $external_reference = $payment->external_reference;

        $guest = Guest::findOrFail($external_reference);
        $guest->has_paid = true;
        $guest->paid_value += $payment->transaction_amount;
        $guest->save();

        return redirect()->route('/');
    }
}
