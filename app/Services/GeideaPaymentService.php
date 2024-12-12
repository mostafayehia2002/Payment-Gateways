<?php

namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GeideaPaymentService extends BasePaymentService implements PaymentGatewayInterface
{
    private mixed $api_password;
    private mixed $api_key;

    protected $data;

    public function __construct()
    {
        $this->base_url =env("GEIDEA_BASE_URL");
        $this->api_key =env("GEIDEA_API_KEY");
        $this->api_password =env("GEIDEA_API_PASSWORD");
        $this->header = [
            'accept' => 'application/json',
            "Content-Type" => "application/json",
            "Authorization" => "Basic " . base64_encode("$this->api_key:$this->api_password"),
        ];
    }

    public function sendPayment(Request $request): array
    {
        $data = $request->all();
        $data["eInvoiceDetails"] = [
            "extraChargesType" => "Amount",
            "invoiceDiscountType" => "Amount"
        ];
        $response = $this->buildRequest('POST', '/payment-intent/api/v1/direct/eInvoice', $data);
        //handel payment response data and return it
        if ($response->getData(true)['success']) {

            return ['success' => true, 'url' => $response->getData(true)['data']['paymentIntent']['link']];


        }
        return ['success' => false, 'url' => $response];
    }

    public function callBack(Request $request): bool
    {
        $response = $request->all();
        Storage::put('geidea_response.json', json_encode($response));
        if (isset($response['order']['status']) && $response['order']['status'] === 'Success'&& $response['order']['detailedStatus'] === 'Paid' ) {
            //save order and return true
            return true;
        }
        return false;
    }
}
