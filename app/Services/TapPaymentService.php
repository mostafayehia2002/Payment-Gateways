<?php

namespace App\Services;
use App\Interfaces\PaymentGatewayInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TapPaymentService extends BasePaymentService implements PaymentGatewayInterface
{
    protected $api_key;
    public function __construct()
    {
        $this->base_url =env("TAP_BASE_URL");
        $this->api_key =env("TAP_API_KEY");
        $this->header = [
            'accept' => 'application/json',
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . $this->api_key,
        ];
    }

    public function sendPayment(Request $request)
    {
        //validate data before sending it
        $data = $request->all();
        $data['source'] = ['id' => 'src_all'];
        $data['redirect'] = ['url' => $request->getSchemeAndHttpHost() . '/api/payment/callback'];

        $response=$this->buildRequest('POST', '/v2/charges/', $data);
        //handel payment response data and return it
        if($response->getData(true)['success']){

            return['success'=>true,'url'=>$response->getData(true)['data']['transaction']['url']];
        }
        return['success'=>false,'url'=>route('payment.failed')];

    }
    public function callBack(Request $request): bool
    {
        $chargeId = $request->input('tap_id');

        $response = $this->buildRequest('GET', "/v2/charges/$chargeId");
        $response_data = $response->getData(true);

        Storage::put('tap_response.json',json_encode([
            'callback_response' => $request->all(),
            'response' => $response_data
        ]));

        if($response_data['success'] && $response_data['data']['status'] == 'CAPTURED') {
            //save order data and return true
            return true;
        }
        return false;
    }
}
